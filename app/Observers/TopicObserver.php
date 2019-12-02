<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TopicJob;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;

class TopicObserver
{

    public function saving(Topic $topic)
    {
        $topic->excerpt = make_excerpt($topic->body);

        if (!$topic->slug) {
            //推送到任务队列
            dispatch(new TopicJob($topic));
        }
    }

    /**
     * 当一个新模型被初次保存
     * @param Topic $topic
     */
    public function creating(Topic $topic)
    {
        //增加文章所属分类下文章数
        Category::where('id', $topic->category_id)->increment('topic_count');
        //增加文章作者发布文章数
        User::where('id', $topic->user_id)->increment('topic_count');
        //更新个人积分
        User::updateUserScore('create_topic');
    }

    public function deleted(Topic $topic)
    {
        //删除该文章的评论
        $topic->replies()->delete();
        //改文章作者的 发布文章数量 -1
        $topic->user()->decrement('topic_count');
        //该文章的标签删除
        $topic->tags()->delete();
        $topic->topicTags()->delete();
        //该文章的 分类 文章数量 -1
        $topic->category()->decrement('topic_count');
    }
}
