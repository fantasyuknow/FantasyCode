<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['userTopics', 'userReplies', 'userVoteOrCollectTopics', 'userFollowOrFans', 'show']]);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Ta的文章
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userTopics(User $user)
    {
        $user_topics = $user->topics()->paginate(15);
        return view('users.show', compact('user', 'user_topics'));
    }

    /**
     * Ta的评论
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userReplies(User $user)
    {
        $user_replies = $user->replies()->with('user', 'topic')->paginate(15);
        return view('users.show', compact('user', 'user_replies'));
    }

    /**
     * Ta的点赞或者收藏文章
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userVoteOrCollectTopics(Request $request, User $user)
    {
        $user_vote_topics = DB::table('user_topic_operate as op')
            ->select('t.id', 't.title', 'u.name', 't.user_id', 'im.path as avatar', 't.created_at', 't.view_count', 't.reply_count')
            ->leftJoin('topics as t', 't.id', '=', 'op.topic_id')
            ->leftJoin('users as u', 'u.id', '=', 't.user_id')
            ->leftJoin('images as im', 'im.id', '=', 'u.id')
            ->where('op.user_id', $user->id)
            ->where(function ($query) use ($request) {
                if ($request->type == 'vote') {
                    $query->where('op.o_type', 0);
                } else {
                    $query->where('op.o_type', 1);
                }
            })->paginate(15);
        return view('users.show', compact('user', 'user_vote_topics'));
    }

    /**
     * Ta的关注或者粉丝
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userFollowOrFans(Request $request, User $user)
    {
        $follow_fans = DB::table('user_attentions as a')
            ->select('u.id', 'u.name', 'im.path as avatar', 'u.introduction')
            ->leftJoin('users as u', 'u.id', '=', 'a.a_uid')
            ->leftJoin('images as im', 'u.image_id', '=', 'im.id')
            ->where(function ($query) use ($request, $user) {
                if ($request->type == 'follows') {
                    $query->where('a.f_uid', $user->id);
                } else {
                    $query->where('a.f_uid', $user->id);
                }
            })->paginate(15);

        return view('users.show', compact('user', 'follow_fans'));
    }


    public function create()
    {


    }

    public function store()
    {


    }


    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.edit', $user->id)->with('success', '个人信息更新成功');
    }

    /**
     * 头像修改页
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAvatar(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit_avatar', compact('user'));
    }

    /**
     * 头像修改 执行
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $data['image_id'] = $request->image_id;
        $user->update($data);
        return back()->with('success', '头像修改成功~');
    }

    /**
     * 修改密码
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function editPassword(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit_password', compact('user'));
    }

    /**
     * 密码修改
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ], [
            'password.required'  => '请输入密码',
            'password.min'       => '新密码不可小于6位',
            'password.confirmed' => '新密码与确认密码不一致'
        ]);

        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return back()->with('success', '密码修改成功~');
    }
}
