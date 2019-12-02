<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicTag extends Model
{
    protected $table = 'topic_tags';

    protected $fillable = ['topic_id', 'tag_id'];


    public function deleteTopicLink($topic_id)
    {
        $this->where('topic_id', $topic_id)->delete();
    }

    /**
     * 更新文章与标签关系
     *
     * @param $topic_id
     * @param $tag_id_arr
     * @return bool
     */
    public function updateTopicTagLinks($topic_id, $tag_id_arr)
    {
        if (!$topic_id || !$tag_id_arr) return false;
        $this->deleteTopicLink($topic_id);
        $data = [];
        foreach ($tag_id_arr as $item) {
            $data[] = [
                'topic_id'   => $topic_id,
                'tag_id'     => $item,
                'user_id'    => Auth::id(),
                'created_at' => now(),
            ];
        }

        if (empty($data)) return false;
        return DB::table('topic_tags')->insert($data);
    }

}
