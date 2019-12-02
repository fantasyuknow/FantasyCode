<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutsController extends Controller
{


    public function About()
    {
        return view('abouts.index');
    }
}
