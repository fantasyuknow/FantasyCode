



<div class="content px-3 py-3">

    <h1 class="fs-large lh-3">
        <i class="icon search"></i> 关键词 <code class="search-keyword">{{ $search['q'] }}</code>
        的用户搜索结果（{{ $users->total() }}）
    </h1>

    <div class="ui divider mb-1 topic-index-divider"></div>
    <div class="ui feed mt-0 pt-0 rm-link-color">
        <div class="ui divided items">
            @if($users)
                <div class="ui three special cards">
                    @foreach($users  as $user)
                        <div class="card">
                            <div class="blurring dimmable image">
                                <div class="ui dimmer">
                                    <div class="content">
                                        <div class="center">
                                            @if($user->attention)
                                                <button class="ui inverted button user_attention" id="user_attention_{{ $user->id }}" data-id="{{ $user->id }}" type="1">
                                                    <i class="icon checkmark red"></i> <span class="state">已关注</span>
                                                </button>
                                            @else
                                                <button class="ui inverted button user_attention" id="user_attention_{{ $user->id }}" data-id="{{ $user->id }}" type="0">
                                                    <i class="icon plus"></i> <span class="state">关注</span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ $user->userAvatar }}">
                            </div>
                            <div class="content">
                                <a class="header popover" href="{{ route('users.show',$user->id) }}"
                                   title="点击进入Ta的主页">{{ $user->name }}</a>
                                <div class="meta">
                                    <span class="date popover" title="{{ $user->created_at }}">注册于：{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="extra content">
                                <p>简介：{!! $user->introduction ?: 'Ta很神秘哦~' !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


