<?php

namespace App\Observers;

use App\Jobs\ReplyJob;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;


class ReplyObserver
{

    /**
     *当一个新模型被初次保存
     * @param Reply $reply
     */
    public function creating(Reply $reply)
    {
        //文章 回复数+1
        Topic::where('id', $reply->topic_id)->increment('reply_count');
        //回复人 回复数+1
        User::where('id', $reply->user_id)->increment('reply_count');
        //更新个人积分
        User::updateUserScore('reply_topic');
    }

    public function created(Reply $reply)
    {
        dispatch(new ReplyJob($reply));
    }


    public function deleted(Reply $reply)
    {
        //该文章的 评论数 -1
        $reply->topic()->decrement('reply_count');
        //该评论人的 回复数 -1
        $reply->user()->decrement('reply_count');
    }

}
