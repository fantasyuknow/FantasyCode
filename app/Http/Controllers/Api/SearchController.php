<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends ApiController
{


    public function index(Request $request)
    {
        if (!trim($request->q)) {
            $this->error('请输入搜索关键词');
        }
        $keyword = '%' . trim($request->q) . '%';
        $results = [];
        switch ($request->search_type) {
            case 'is_topic':
                $results = $this->searchTopics($keyword);
                break;
            case 'is_user':
                $results = $this->searchUsers($keyword);
                break;
        }
        return $this->default(['data' => $results,'type'=>$request->search_type]);
    }


    protected function searchTopics($keyword)
    {
        $list = DB::table('topics')
            ->select('id','title', 'excerpt')
            ->where('title', 'like', $keyword)
            ->orWhere('excerpt', 'like', $keyword)
            ->orWhere('slug', 'like', $keyword)
            ->orderBy('view_count', 'DESC')
            ->limit(10)
            ->get()->toArray();
        if(!empty($list)){
            foreach($list as $key=>$value){
                $list[$key]->href = route('topics.show',$value->id);
            }
        }
        return $list;
    }


    protected function searchUsers($keyword)
    {
        $list = DB::table('users')
            ->select('id','name','introduction')
            ->where('name', 'like', $keyword)
            ->orWhere('email', 'like', $keyword)
            ->orWhere('real_name', 'like', $keyword)
            ->orderBy('score', 'DESC')
            ->limit(10)
            ->get()->toArray();
        if(!empty($list)){
            foreach($list as $key=>$value){
                $list[$key]->href = route('users.show',$value->id);
            }
        }
        return $list;
    }
}
