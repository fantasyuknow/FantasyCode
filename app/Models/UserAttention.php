<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAttention extends Model
{
    protected $table = 'user_attentions';

    public $fillable = ['f_uid','a_uid'];
}
