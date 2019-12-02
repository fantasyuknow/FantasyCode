<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTopicOperate extends Model
{
    protected $table = 'user_topic_operate';


    public function scopeTypeTopics($query, $type)
    {
        return $query->where('o_type', $type);
    }



}
