<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['f_type', 'path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
