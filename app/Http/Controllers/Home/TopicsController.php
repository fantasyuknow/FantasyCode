<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Jobs\TopicJob;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\TopicTag;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests\TopicRequest;

class TopicsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * 文章列表页
     *
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Topic $topic)
    {
        $topics       = $topic->withOrder($request->order)->with('user')
            ->select('topics.*', 'im.path')
            ->leftJoin('users as u', 'u.id', '=', 'topics.user_id')
            ->leftJoin('images as im', 'u.image_id', '=', 'im.id')
            ->paginate(15);
        $sidebar_data = Topic::getTopicsInfo();
        return view('topics.index', compact('topics', 'sidebar_data'));
    }

    /**
     * 文章详情
     *
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Topic $topic)
    {
        //访问量
        topic_view($topic->id, $request->getClientIp());
        $topic->body = markDownToHtml($topic->body);
        //侧边栏数据
        $sidebar_data = Topic::getTopicsInfo($topic->user_id, $topic->id);
        //回复数据
        if ($topic->is_reply != 2) {
            $replies = $topic->replies()->with('user')
                ->where('verify', '<>', 2)
                ->orderBy('id', 'DESC')
                ->get();
        }
        //登录用户是否收藏或者点赞该文章
        $user_upvote  = false;
        $user_collect = false;
        $userTopicOp  = DB::table('user_topic_operate')
            ->where('user_id', Auth::id())
            ->where('topic_id', $topic->id)->get();
        if (!$userTopicOp->isEmpty()) {
            foreach ($userTopicOp as $op) {
                if ($op->o_type == 0) {
                    //点赞
                    $user_upvote = true;
                }
                if ($op->o_type == 1) {
                    $user_collect = true;
                }
            }
        }
        //登录用户是否关注了作者
        $attention = User::AuthAttentionUser($topic->user_id);
        return view('topics.show', compact('topic', 'sidebar_data', 'replies', 'user_upvote', 'user_collect', 'attention'));
    }

    /**
     * 文章新增页面
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Topic $topic)
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('topics.create_or_edit', compact('categories', 'tags', 'topic'));
    }

    /**
     * 文章新增
     *
     * @param TopicRequest $request
     * @param Topic $topic
     * @param Category $category
     * @param Tag $tag
     * @param TopicTag $topicTag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TopicRequest $request, Topic $topic, Category $category, Tag $tag, TopicTag $topicTag)
    {
        //更新tags表的标签数据
        $tag_ids_arr = $tag->updateTags($request->tags);
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
        //更新文章标签关联表
        $topicTag->updateTopicTagLinks($topic->id, $tag_ids_arr);
        return redirect()->to($topic->link())->with('success', '文章新建成功!');
    }

    /**
     * 文章编辑
     *
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories = Category::all();
        $tags       = Tag::all();
        //该文章已有的标签
        $collect = collect();
        $topic->tags->each(function ($item) use ($collect) {
            $collect->push($item->name);
        });
        $topicTags = $collect->implode(',');
        return view('topics.create_or_edit', compact('categories', 'tags', 'topic', 'topicTags'));
    }

    /**
     * 文章 更新
     *
     * @param TopicRequest $request
     * @param Topic $topic
     * @param Category $category
     * @param Tag $tag
     * @param TopicTag $topicTag
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TopicRequest $request, Topic $topic, Category $category, Tag $tag, TopicTag $topicTag)
    {
        $this->authorize('update', $topic);
        //更新tags表的标签数据
        $tag_ids_arr = $tag->updateTags($request->tags);
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
        //更新文章标签关联表
        $topicTag->updateTopicTagLinks($topic->id, $tag_ids_arr);
        return redirect()->to($topic->link())->with('success', '文章编辑成功!');
    }

    /**
     * 文章删除
     *
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->delete();
        return redirect()->route('topics.index')->with('success', '文章删除成功!');
    }
}
