<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $currentUser, Reply $reply)
    {
        //文章作者和评论人可以删除评论
        return $currentUser->id === $reply->user_id || $currentUser->id === $reply->topic->user_id;
    }
}
