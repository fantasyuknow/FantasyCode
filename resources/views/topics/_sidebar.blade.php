<div class="js-computed-height-left four wide column pull-left sidebar clear" style="padding-right: 0px;">
    <div class="item header blog-article sidebar" style="height:auto !important;">
        @if(if_route('topics.show'))
            <div class="ui link cards" id="user_info">
                <div class="card">
                    <div class="image">
                        <img src="{{ $topic->user->userAvatar }}">
                    </div>
                    <div class="content">
                        <div class="header">
                            {{ $topic->user->name }}
                        </div>
                        <div class="meta">
                            {{ $topic->user->created_at->diffForHumans() }}
                        </div>
                        <div class="description">
                            简介： {!!  $topic->user->introduction ?: 'Ta很神秘哦~暂无简介' !!}
                        </div>
                    </div>

                    <div class="extra content">
                        @if(!$attention)
                            <button class="ui red basic button follow fluid user_attention" data-act="follow"
                                    data-id="{{ $topic->user_id }}" type="0">
                                <i class="icon plus"></i> <span class="state">关注</span>
                            </button>
                        @else
                            <button class="ui red basic button follow fluid user_attention" data-act="follow"
                                    data-id="{{ $topic->user_id }}" type="1">
                                <i class="icon checkmark"></i> <span class="state">已关注</span>
                            </button>
                        @endif
                    </div>

                    <div class="extra content">
                        <a href="{{ route('users.show',$topic->user_id) }}" target="_blank">
                            <button class="ui green basic button follow fluid">
                                <i class="icon angle double right"></i> <span class="state">Ta 的主页</span>
                            </button>
                        </a>
                    </div>

                </div>


            </div>


        @else
            <div class="ui segment orange text-center" style="padding: 25px;">
                无与伦比，八度空间。
            </div>
        @endif

        {{-- 文章归档 --}}
        <div class="ui card link tag-active-user-card popular-card responsive">
            <div class="content">
                <span class="">文章归档</span>

                <a href="" class="rm-link-color pull-right ui popover" style="font-size: 15px;margin-right: 8px;"
                   data-content="所有文章">
                    <i class="icon newspaper"></i>
                </a>
            </div>
            <div class="extra content ">
                <div class="ui list readmore" style="padding: 8px; max-height: none;">
                    @foreach($sidebar_data['topic_groups'] as $key=>$item)
                        <a class="item" href="" style="line-height: 22px;">
                            <span class=" pull-right" style="color:inherit">{{ $item['num'] }} 篇</span>
                            {{ $key }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 个人分类 --}}
        <div class="ui card link tag-active-user-card blog-tags responsive">
            <div class="content">
                <span class="">个人分类</span>
            </div>
            <div class="ui large vertical fluid pointing menu"
                 style="border-left: 0;border-right: 0;border-bottom: 0;margin-top: 0;">
                @foreach($sidebar_data['categories'] as $item)
                    <a class="item" href="{{ route('categories.show',$item['id']) }}">
                        {{ $item['name'] }}
                        <div class="ui small label">{{ $item['topic_count'] }}</div>
                    </a>
                @endforeach
            </div>
        </div>


        {{-- 博客标签 --}}
        <div class="ui card link tag-active-user-card blog-tags responsive">
            <div class="content">
                <span class="">博客标签</span>
            </div>
            <div class="extra content readmore" style="padding-bottom: 18px; max-height: none;">
                @foreach($sidebar_data['tags_list'] as $item)
                    <a class="ui label basic" href="{{ route('tags.show',$item->id) }}">
                        {{ $item->name }}
                        <div class="detail">{{ $item->count_num }}</div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- 最新 热门文章 --}}
        {{--        <div class="ui card tag-active-user-card popular-card responsive" style="font-size: 13px;">--}}
        {{--            <div class="ui secondary pointing menu"--}}
        {{--                 style="margin-bottom: 5px;border-bottom: 2px solid rgba(34, 36, 38, 0.1);">--}}
        {{--                <a class="item active" data-tab="first">最新文章</a>--}}
        {{--                <a class="item" data-tab="second">最受欢迎</a>--}}
        {{--            </div>--}}
        {{--            <div class="ui bottom attached tab active" data-tab="first">--}}

        {{--                <div class="ui middle aligned divided  list"--}}
        {{--                     style="padding: 0px 15px;margin-top: 0px;margin-bottom: 5px;">--}}
        {{--                    @foreach( $sidebar_data['articles_news'] as $item )--}}
        {{--                        <a class="item" href="{{ route('topics.show', $item['id']) }}">--}}
        {{--                            {{ $item['title'] }}--}}
        {{--                        </a>--}}
        {{--                    @endforeach--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="ui bottom attached tab" data-tab="second">--}}
        {{--                <div class="ui middle aligned divided  list" style="padding: 0px 15px;margin-top: 0px;">--}}
        {{--                    @foreach( $sidebar_data['articles_hots'] as $item )--}}
        {{--                        <a class="item" href="{{ route('topics.show', $item['id']) }}">--}}
        {{--                            {{ $item['title'] }}--}}
        {{--                        </a>--}}
        {{--                    @endforeach--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        {{-- 文章导航 --}}
        @if(1)
            <div class="ui sticky doc toc">
                <div class="ui card column author-box grid  tocify" id="markdown-tocify"
                     style="max-height: 100%;padding: 22px 4px;"></div>
            </div>
        @endif
    </div>
</div>
