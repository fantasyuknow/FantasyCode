<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class,'topic_id','id');
    }

    public function getReplyStatusAttribute()
    {
        switch ($this->verify) {
            case 0:
                $status = '待审核';
                break;
            case 1:
                $status = '通过';
                break;
            default:
                $status = '不通过';
                break;
        }
        return $status;
    }
}
