<div class="four wide column ">
    <div class="ui card link">
        <div class="card">
            <a class="ui {{  $user->scoreLevel['level_color']}} ribbon label mb-3" href=""
               target="_blank">
                <i class="icon trophy"></i> {{ $user->scoreLevel['level_name'] }}
            </a>
            <div class="image" href="">
                <a class="ui popover" style="cursor:default">
                    <img style="width:100%" src="{{ $user->userAvatar }}">
                </a>
            </div>
            <div class="statistics mt-3 mb-3"
                 style="border-top: 1px solid rgba(0, 0, 0, 0.05);border-bottom: 1px solid rgba(0, 0, 0, 0.05);padding-bottom: 15px;padding-top: 10px;">
                <div class="ui three statistics">
                    <div class="ui statistic">
                        <div class="label" style="font-size: 1em!important;font-weight: normal;">
                            文章
                        </div>
                        <div class="value" style="font-size: 1em!important;font-weight: bold;">
                    <span class="ui popover bottom" data-content="博客文章总数">
                        {{ $user->topic_count }}
                    </span>
                        </div>
                    </div>

                    <div class="ui statistic">
                        <div class="label" style="font-size: 1em!important;font-weight: normal;">
                            粉丝
                        </div>
                        <div class="value" style="font-size: 1em!important;font-weight: bold;">
                    <span class="ui popover bottom" data-content="关注作者的用户数">
                        {{ $user->fans_count }}
                    </span>
                        </div>
                    </div>

                    <div class="ui statistic">
                        <div class="label" style="font-size: 1em!important;font-weight: normal;">
                            关注
                        </div>
                        <div class="value" style="font-size: 1em!important;font-weight: bold;">
                    <span class="ui popover bottom" data-content="Ta关注的用户数">
                        {{ $user->follow_count }}
                    </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="rm-link-color">
                <h1 class="my-3 mx-2 fw-bold" title="性别">
                    {{ $user->name }}
                    &nbsp;&nbsp;
                    @if($user->sex == 1)
                        <i class="mars icon"></i>
                    @elseif($user->sex ==2)
                        <i class="venus icon"></i>
                    @endif
                </h1>
                @if($user->company)
                    <div class="my-2 mx-2" title="公司">
                        <i class="address book outline icon" style="color:#a5a5a5"></i> {{ $user->company }}
                    </div>
                @endif
                @if($user->city)
                    <div class="my-3 mx-2" title="城市">
                        <i class="icon marker" style="color:#a5a5a5"></i> {{ $user->city }}
                    </div>
                @endif

                <div class="ui divider" style="border-top: 1px solid rgba(0, 0, 0, 0.05);"></div>

                <div class="social rm-link-color my-3 mx-2">
                    <p class="fw-bold" style="font-size:0.9em;color:#a5a5a5;">社交账号：</p>
                    @if($user->github_site)
                        <a href="{{ $user->github_site }}" target="_blank">
                            <i style="color:#a5a5a5;font-size:1.2em" class="icon github alternate"></i>
                        </a>
                    @endif
                    @if($user->wc_qrcode)
                        <a href="" target="_blank">
                            <i style="color:#a5a5a5;font-size:1.2em" class="icon wechat alternate"></i>
                        </a>
                    @endif
                    @if($user->weibo_site)
                        <a href="{{ $user->weibo_site }}" target="_blank">
                            <i style="color:#a5a5a5;font-size:1.2em" class="icon weibo alternate"></i>
                        </a>
                    @endif
                </div>
                <div class="ui divider" style="border-top: 1px solid rgba(0, 0, 0, 0.05);"></div>
            </div>
            <div class="extra content">
                @if(\Illuminate\Support\Facades\Auth::id() == $user->id)
                    <a class="ui button fluid basic"
                       href="{{ route('users.edit',\Illuminate\Support\Facades\Auth::id()) }}"
                       id="user-edit-button">
                        <i class="icon edit"></i> 编辑个人资料
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
