<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable= [
        'title',
        'body',
        'excerpt',
        'slug',
        'category_id'
    ];


    public static function getTopicsInfo($user_id = 0, $topic_id = 0)
    {
        $result = [];
        //文章分类
        $result['categories'] = Category::select('id', 'name', 'topic_count')->get()->toArray();
        //文章归档
        $result['topic_groups'] = [];
        $builderTopics          = Topic::select('id', 'title', 'created_at', 'view_count', 'category_id');
        if ($user_id) {
            $builderTopics->where('user_id', $user_id);
        }
        $topics = $builderTopics->get()->toArray();
        if (!empty($topics)) {
            foreach ($topics as $topic) {
                $key = date('Y年m月', strtotime($topic['created_at']));
                if (array_key_exists($key, $result['topic_groups'])) {
                    $result['topic_groups'][$key]['num']++;
                } else {
                    $result['topic_groups'][$key]['num'] = 1;
                }
            }
        }
        //列表展示所有标签，详情展示该文章的标签
        if ($topic_id) {
            $result['tags_list'] = DB::select(DB::raw("SELECT tags.id,tags.name,COUNT(tt.id) AS count_num FROM tags LEFT JOIN topic_tags AS tt ON tags.id = tt.tag_id where tt.topic_id = {$topic_id} GROUP BY tags.id"));
        } else {
            $result['tags_list'] = DB::select(DB::raw("SELECT tags.id,tags.name,COUNT(tt.id) AS count_num FROM tags LEFT JOIN topic_tags AS tt ON tags.id = tt.tag_id GROUP BY tags.id"));
        }

        //如果是列表则从所有文章里面取最新和最受欢迎文章，如果是详情页 则取该文章作者的最新和最受欢迎文章

        // 最新文章
        $created_at_array = array_column($topics, 'created_at');
        array_multisort($created_at_array, SORT_DESC, $topics);
        $result['articles_news'] = array_slice($topics, 0, 5);

        // 最受欢迎
        $view_count_array = array_column($topics, 'view_count');
        array_multisort($view_count_array, SORT_DESC, $topics);
        $result['articles_hots'] = array_slice($topics, 0, 5);

        return $result;
    }

    /**
     * ----------------------------------------------------------------------
     *
     *  表关系
     * ----------------------------------------------------------------------
     */
    //获取文章分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //获取文章作者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 获取文章回复
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // 获取文章标签
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'topic_tags', 'topic_id', 'tag_id');
    }

    //文章标签关联
    public function topicTags()
    {
        return $this->hasMany(TopicTag::class);
    }

    //文章封面
    public function image()
    {
        return $this->hasOne(Image::class, 'image_id', 'id');
    }


    public function scopeWithOrder($query, $order)
    {
        switch ($order) {

            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentHot();
                break;
        }
        return $query->with('user', 'category');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeRecentHot($query)
    {
        return $query->orderBy('view_count', 'DESC');
    }

    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}
