<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use http\Exception\RuntimeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Topic;

class TagsController extends Controller
{

    public function __construct()
    {

    }

    public function show(Request $request,Tag $tag)
    {
        $topics = $tag->topics()
            ->withOrder($request->order)
            ->select('topics.id','topics.title','topics.category_id','topics.user_id','topics.view_count','topics.created_at','topics.updated_at')
            ->paginate(15);
        $sidebar_data = Topic::getTopicsInfo();
        return view('topics.index', compact('tag','topics', 'sidebar_data'));
    }

}
