<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements JWTSubject
{

//    use Notifiable;
    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
//        if ($this->uid === Auth::id()) return;
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }
        $this->laravelNotify($instance);
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sex', 'phone',
        'real_name', 'github_site', 'weibo_site',
        'hobby', 'city', 'company', 'job_title', 'per_web', 'introduction', 'signature',
        'wc_qrcode', 'pay_qrcode', 'image_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function follows()
    {
        return $this->hasMany(UserAttention::class, 'a_uid', 'id');
    }

    public function fans()
    {
        return $this->hasMany(UserAttention::class, 'f_uid', 'id');
    }

    public function avatar()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }


    public function userTopics()
    {
        return $this->hasMany(UserTopicOperate::class, 'user_id', 'id');
    }


    /**
     * 获取用户头像
     *
     * @return string
     */
    public function getUserAvatarAttribute()
    {
        if (!$this->avatar) {
            return getImageUrl();
        } else if ($this->avatar->path) {
            return asset($this->avatar->path);
        } else {
            return getImageUrl();
        }
    }

    /**
     * 获取用户登记
     * @return array
     */
    public function getScoreLevelAttribute()
    {
        /**
         * 小白 score <= 20
         * 书童 score <= 50
         * 秀才 score <= 150
         * 举人 score <= 300
         * 进士 score <= 500
         * 状元 score >= 500
         */

        if ($this->score <= 20) {
            $level = [
                'level_name'  => '小白',
                'level_color' => 'green'
            ];
        } elseif ($this->score <= 50) {
            $level = [
                'level_name'  => '书童',
                'level_color' => ''
            ];
        } elseif ($this->score <= 150) {
            $level = [
                'level_name'  => '秀才',
                'level_color' => 'olive'
            ];
        } elseif ($this->score <= 300) {
            $level = [
                'level_name'  => '举人',
                'level_color' => 'yellow'
            ];
        } elseif ($this->score <= 500) {
            $level = [
                'level_name'  => '进士',
                'level_color' => 'pink'
            ];
        } else {
            $level = [
                'level_name'  => '状元',
                'level_color' => 'red'
            ];
        }
        return $level;
    }

    /**
     * 更新个人积分
     *
     * @param $type
     */
    public static function updateUserScore($type)
    {
        switch ($type) {
            //新建文章
            case 'create_topic':
                Auth::user()->increment('score', 10);
                break;
            //发表评论
            case 'reply_topic':
                Auth::user()->increment('score', 5);
                break;
            //新建教程
            case 'create_book':
                Auth::user()->increment('score', 20);
                break;
            default:
                break;
        }
    }

    /**
     * 判断当前登录用户是否关注另一个用户
     *
     * @param $user_id
     * @return mixed
     */
    public static function AuthAttentionUser($user_id)
    {
        if (Auth::check()) {
            return Auth::user()->follows()->where('user_attentions.f_uid', $user_id)->exists();
        } else {
            return false;
        }
    }

    /**
     * 获取用户文章的点赞数
     *
     * @return mixed
     */
    public function getVoteCountAttribute()
    {
        return $this->userTopics()->typeTopics(0)->count();
    }

    /**
     * 获取用户文章的收藏数
     *
     * @return mixed
     */
    public function getCollectCountAttribute()
    {
        return $this->userTopics()->typeTopics(1)->count();
    }

    /**
     * 将消息标记为已读
     */
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }





}
