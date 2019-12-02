<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Topic;
use App\Models\UserTopicOperate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicsController extends ApiController
{


    /**
     * 点赞或取消 收藏或取消 文章
     *
     * @param Request $request
     * @param UserTopicOperate $userTopicOperate
     * @return \Illuminate\Http\Response|void
     */
    public function VoteCollect(Request $request, UserTopicOperate $userTopicOperate)
    {
        if (!$request->topic_id) {
            return $this->error('请选择您要点赞的文章哦~');
        }
        if ($request->type == 'vote') {
            //点赞
            if ($request->op == 0) {
                //取消点赞
                $userTopicOperate->where([
                    'topic_id' => $request->topic_id,
                    'user_id'  => Auth::id(),
                    'o_type'   => 0
                ])->delete();
            } else {
                //点赞
                $userTopicOperate->topic_id = $request->topic_id;
                $userTopicOperate->user_id  = Auth::id();
                $userTopicOperate->o_type   = 0;
                $userTopicOperate->save();
            }
        } else {
            //收藏
            if ($request->op == 0) {
                //取消收藏
                $userTopicOperate->where([
                    'topic_id' => $request->topic_id,
                    'user_id'  => Auth::id(),
                    'o_type'   => 1
                ])->delete();
            } else {
                //收藏
                $userTopicOperate->topic_id = $request->topic_id;
                $userTopicOperate->user_id  = Auth::id();
                $userTopicOperate->o_type   = 1;
                $userTopicOperate->save();
            }
        }
        $topic = DB::table('topics')->select('vote_count', 'collect_count')->where('id', $request->topic_id)->first();
        return $this->default(['msg' => '操作成功', 'data' => ['vote_count' => $topic->vote_count, 'collect_count' => $topic->collect_count]]);
    }


}
