@extends('layouts.app')
@section('title', '搜索查询')

@section('content')
    <div class="ui centered grid container main stackable blog" style="">
        <div class="twelve wide column pull-right main" style="margin-bottom: 3rem;">
            <div class="ui segment article-content">
                <div class="extra-padding">
{{--                    <h1>--}}
{{--                        <i class="icon newspaper"></i>--}}
                        {{--                        @if (isset($category))--}}
                        {{--                            分类：<code class="search-keyword">{{ $category->name }} </code>--}}
                        {{--                            --}}{{--                                {{ $category->description }}--}}
                        {{--                        @elseif (isset($tag))--}}
                        {{--                            标签：<code class="search-keyword">{{ $tag->name }} </code>--}}
                        {{--                        @else--}}
                        {{--                            所有文章--}}
                        {{--                        @endif--}}
{{--                        <div class="ui secondary menu pull-right small" style="margin-top: -4px;">--}}
{{--                            <div class="ui item" style="font-size:13px;padding: 0px 4px;color: #777;">--}}
{{--                                文章排序：--}}
{{--                            </div>--}}
                            {{--                            <a class="ui item popover {{ active_class( ! if_query('order', 'vote')) }}"--}}
                            {{--                               data-content="按照时间排序"--}}
                            {{--                               href="{{ Request::url() }}?order=recent" role="button">时间</a>--}}
                            {{--                            <a class="ui item  popover {{ active_class(if_query('order', 'vote')) }}"--}}
                            {{--                               data-content="按照投票排序"--}}
                            {{--                               href="{{ Request::url() }}?order=vote" role="button">投票</a>--}}
{{--                        </div>--}}
{{--                    </h1>--}}

{{--                    <div class="ui divider"></div>--}}

                    @if(if_query('search_type','is_topic'))
                        @include('search._topics_list',['topics'=>$topics])
                    @elseif(if_query('search_type','is_user'))
                        @include('search._users_list',['users'=>$users])
                    @endif


                </div>

                {{-- 分页 --}}
                @if(if_query('search_type','is_topic'))
                    {{ $topics->appends(Request::except('page', '_pjax'))->render() }}
                @elseif(if_query('search_type','is_user'))
                    {{ $users->appends(Request::except('page', '_pjax'))->render() }}
                @endif

            </div>
        </div>
        <div class="clearfix"></div>
    </div>



@endsection

@section('script')

    <script>
        $('.special.cards .image').dimmer({
            on: 'hover'
        }).click(function () {

            var self= $(this).find('.user_attention');
            window.FantasyCodeNew.userAttention(self);
        });
    </script>
@endsection

