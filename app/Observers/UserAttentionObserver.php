<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserAttention;

class UserAttentionObserver
{
    /**
     * 新模型被创建
     *
     * @param UserAttention $userAttention
     */
    public function creating(UserAttention $userAttention)
    {
        //关注者的 关注人数+1
        User::where('id', $userAttention->a_uid)->increment('follow_count');
        //被关注者的  粉丝人数+1
        User::where('id', $userAttention->f_uid)->increment('fans_count');
    }

    /**
     * 一个模型被销毁
     *
     * @param UserAttention $userAttention
     */
    public function deleting(UserAttention $userAttention)
    {
        //关注者的 关注人数-1
        User::where('id', $userAttention->a_uid)->where('follow_count', '>', 0)->decrement('follow_count');
        //被关注者的  粉丝人数-1
        User::where('id', $userAttention->f_uid)->where('fans_count', '>', 0)->decrement('fans_count');
    }
}
