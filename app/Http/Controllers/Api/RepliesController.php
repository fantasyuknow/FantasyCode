<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RepliesController extends ApiController
{
    public function __construct()
    {

    }

    /**
     * 存储评论
     *
     * @param ReplyRequest $request
     * @param Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->body     = $request->body;
        $reply->user_id  = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->type     = 1;

        $topic = Topic::where('id', $request->topic_id)->first();
        if ($topic->is_reply == 0) {
            $reply->verify = 1;
        } elseif ($topic->is_reply == 1) {
            $reply->verify = 0;
        } else {
            $this->error('该文章不允许评论哦');
        }
        $reply->save();
        return $this->default(['msg' => '评论成功']);
    }


    public function destroy(Reply $reply)
    {
        $this->authorize('destroy',$reply);
        $topic_id = $reply->topic_id;
        $reply->delete();
        return $this->default(['msg'=>'评论删除成功','data'=>['url'=>route('topics.show',$topic_id)]]);
    }
}
