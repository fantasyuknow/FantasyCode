@extends('layouts.app')
@section('title', '首页')
@section('content')
    <div class="ui centered grid container main stackable blog">
        <div class="js-computed-height-right twelve wide column pull-right main main-column">
            <div class="ui segment article-content">
                <div class="extra-padding" style="padding-bottom:4px">
                    {{-- 标题 --}}
                    <h1 style="margin-bottom: 15px;">
                        <span style="line-height: 34px;">欢迎来到我的Blog</span>
                    </h1>

                    {{-- 分割线 --}}
                    <div class="ui divider"></div>

                    {{-- 文章详情 --}}
                    <div class="ui readme markdown-body content-body fluidbox-content">
                        <div class="ui segment">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
