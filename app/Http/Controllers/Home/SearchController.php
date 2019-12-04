<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{

    public function index(Request $request, Topic $topic, User $user)
    {
        $search = [
            'q'           => $request->q,
            'search_type' => $request->search_type
        ];

        $keyword = '%' . trim($request->q) . '%';
        switch ($request->search_type) {

            case 'is_topic':

                $topics = $topic->withOrder($request->order)->with('user')
                    ->select('topics.*', 'im.path')
                    ->leftJoin('users as u', 'u.id', '=', 'topics.user_id')
                    ->leftJoin('images as im', 'u.image_id', '=', 'im.id')
                    ->where('topics.title', 'like', $keyword)
                    ->orWhere('topics.excerpt', 'like', $keyword)
                    ->orWhere('topics.slug', 'like', $keyword)
                    ->paginate(15);
                break;
            case 'is_user':
                $users = $user->with('avatar')
                    ->where('users.name', 'like', $keyword)
                    ->orWhere('users.email', 'like', $keyword)
                    ->orWhere('users.real_name', 'like', $keyword)
                    ->paginate(15);

                //登录用户是否关注搜索用户
                if($users->total()){
                    $f_uids= $users->pluck('id')->toArray();;
                    if(!empty($f_uids)){
                        $attentions = Auth::user()->follows()->whereIn('user_attentions.f_uid',$f_uids)->pluck('f_uid');
                        foreach($users as $key=>$item){
                            if($attentions->contains($item->id)){
                                $item->attention = 1;
                            }
                        }
                    }
                }
                break;
        }

        return view('search.index', compact('topics', 'users', 'search'));
    }
}
