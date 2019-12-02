<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserAttentionResource;
use App\Models\UserAttention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAttentionsController extends ApiController
{

    /**
     * 用户关注或者取消关注
     *
     * @param Request $request
     * @param UserAttention $userAttention
     * @return \Illuminate\Http\Response
     */
    public function attention(Request $request, UserAttention $userAttention)
    {
        if ($request->op == 1) {
            //关注
            $userAttention->f_uid = $request->user_id;
            $userAttention->a_uid = Auth::id();
            $userAttention->save();
        } else {
            //取消关注
            $userAttention->where('a_uid', Auth::id())->where('f_uid', $request->user_id)->delete();
        }
        return $this->default(['msg'=>'成功','code'=>200]);
    }
}
