<?php

namespace App\Observers;

use App\Models\Topic;
use App\Models\User;
use App\Models\UserTopicOperate;

class UserTopicOperateObserver
{
    /**
     * 创建一个模型
     * @param UserTopicOperate $userTopicOperate
     */
    public function creating(UserTopicOperate $userTopicOperate)
    {
        //被用户点赞或收藏文章 的  点赞数 收藏数+1
        if ($userTopicOperate->o_type == 0) {
            Topic::where('id', $userTopicOperate->topic_id)->increment('vote_count');
        } elseif ($userTopicOperate->o_type == 1) {
            Topic::where('id', $userTopicOperate->topic_id)->increment('collect_count');
        }
    }

    /**
     * 销毁一个模型
     * @param UserTopicOperate $userTopicOperate
     */
    public function deleting(UserTopicOperate $userTopicOperate)
    {
        //被用户取消点赞或取消收藏文章 的  点赞数 收藏数-1
        if ($userTopicOperate->o_type == 0) {
            Topic::where('id', $userTopicOperate->topic_id)->where('vote_count', '>', 0)->decrement('vote_count');
        } elseif ($userTopicOperate->o_type == 1) {
            Topic::where('id', $userTopicOperate->topic_id)->where('collect_count', '>', 0)->decrement('collect_count');
        }
    }
}
