<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct()
    {


    }




    public function show(Request $request,Category $category)
    {
        $topics = Topic::withOrder($request->order)->where('category_id',$category->id)->paginate(15);
        $sidebar_data = Topic::getTopicsInfo();
        return view('topics.index',compact('category','topics','sidebar_data'));
    }
}
