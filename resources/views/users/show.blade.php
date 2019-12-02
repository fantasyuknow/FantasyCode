@extends('layouts.app')
@section('title', $user->name . '的个人信息')

@section('content')
    <div class="ui centered grid container stackable">
        @include('users._left', ['_left'=> ['active'=> 'show']])
        @if(if_route('users.show'))
            <div class="nine wide column">
                <div class="ui stacked segment">
                    <div class="content px-3 py-3">
                        <h1>
                            <i class="icon user" aria-hidden="true"></i> {{ $user->name }} 个人信息
                        </h1>
                        <div class="ui divider"></div>

                        <div>
                            <div class="ui segment text-center">注册于：<span class="ui popover"
                                                                          title="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</span></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @elseif(if_route('users.topics'))
            {{-- 用户发表的文章--}}
            @include('users._user_topics')
        @elseif(if_route('users.follow_fans'))
            {{-- 该用户的关注者 粉丝 --}}
            @include('users._follow_and_fans')
        @elseif(if_route('users.replies'))
            {{-- 该用户的回复--}}
            @include('users._user_replies')
        @elseif(if_route('users.vote_collect_topics'))
            {{--该用户的点赞 收藏--}}
            @include('users._user_vote_collect')
        @endif
        @include('users._right',['user'=>$user])
    </div>
@stop
