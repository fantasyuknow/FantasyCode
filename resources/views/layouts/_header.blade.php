<nav class="ui main borderless menu top stackable" id="topnav">

    <div class="ui container">
        <a href="{{ route('home') }}" class="item secondary">
            <h2 style="color: green;">FantasyCode</h2>
        </a>
        <a href="{{ route('topics.index') }}" class="item secondary">
            博客
        </a>
{{--        <div class="ui simple item dropdown article stackable nav-user-item  secondary">--}}
{{--            友情链接 <i class="dropdown icon"></i>--}}
{{--            <div class="ui menu stackable">--}}
{{--                <a href="" class="item">--}}
{{--                    <i class="icon home"></i> 实战教程首页--}}
{{--                </a>--}}
{{--                <a href="" class="item">--}}
{{--                    <i class="icon home"></i> 实战教程首页--}}
{{--                </a>--}}
{{--                <a href="" class="item">--}}
{{--                    <i class="icon home"></i> 实战教程首页--}}
{{--                </a>--}}

{{--            </div>--}}
{{--        </div>--}}
        <a href="{{ route('abouts.index') }}" class="item secondary">
            关于本站
        </a>

        {{-- 右侧导航 --}}
        <div class=" right menu stackable secondary">
            @guest
                <div class="item rm-link-color">
                    <a class="mr-4 no-pjax login_required" href="{{ route('login') }}"><i class="icon sign in "></i> 登录
                    </a>
                    <a class="no-pjax" href="{{ route('register') }}" style="margin-left: 10px;"><i
                            class="icon user add "></i> 注册 </a>
                </div>
            @else
                {{-- 添加博文 --}}
                <div class="ui simple item dropdown article stackable nav-user-item  secondary" tabindex="0">
                    <i class="icon paint brush"></i> <i class="dropdown icon"></i>
                    <div class="ui menu stackable" tabindex="-1">
                        <a href="{{ route('topics.create') }}" class="item no-pjax">
                            <i class="icon paint brush"></i> 新建博文
                        </a>
                    </div>
                </div>
                {{-- 消息通知 --}}
                <a class="item" href="{{ route('notifications.index') }}" title="消息通知">
                <span
                    class="{{ Auth::user()->notification_count > 0 ? 'red' : 'basic' }} ui circular label notification"
                    id="notification-count">
                    {{ Auth::user()->notification_count }}
                </span>
                </a>

                {{-- 个人中心 --}}
                <div class="ui simple item dropdown article stackable nav-user-item" tabindex="0">
                    <img class="ui avatar image lazy"
                         src="{{ Auth()->user()->userAvatar }}">
                    &nbsp;
                    {{ Auth::user()->name }}
                    <i class="dropdown icon"></i>
                    <div class="ui menu stackable" tabindex="-1">
{{--                        @can('manage_contents')--}}
{{--                            <a href="" class="item" target="_blank">--}}
{{--                                <i class="icon heart"></i> 后台管理--}}
{{--                            </a>--}}
{{--                        @endcan--}}

                        <a href="{{ route('users.show', Auth::id()) }}" class="item">
                            <i class="icon user"></i>
                            个人中心
                        </a>

                        <a href="{{ route('users.edit', Auth::id()) }}" class="item">
                            <i class="icon settings"></i>
                            编辑资料
                        </a>

                        <a class="item no-pjax" href="javascript:void(0)"
                           data-url="{{ route('logout') }}"
                           data-method="POST"
                           data-prompt="您确定要退出登录吗？"
                           title="退出登录" style="cursor: pointer;">
                            <i class="icon sign out"></i>
                            退出
                        </a>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>
