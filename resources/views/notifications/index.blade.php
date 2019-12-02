@extends('layouts.app')

@section('title', '我的通知')

@section('content')
    <div class="ui centered grid container stackable">
        <div class="twelve wide column">
            <div class="ui stacked segment">
                <div class="content px-3 py-3">
                    <h1>
                        <i class="bell outline icon"></i> 我的提醒
                    </h1>

                    <div class="ui divider mb-0"></div>

                    <div class="ui feed notifications mt-0 rm-link-color text-decoration-underline">
                        @if($notifications->count())
                            @foreach($notifications as $notification)

                                <div class="event  pt-4 pb-3 px-0 mb-0 " style="border-radius: 4px;">
                                    <a class="label" href="{{ route('users.show',$notification->data['user_id']) }}">
                                        <img class="media-object img-thumbnail avatar" alt="QueuingAnt"
                                             src="{{ $notification->data['user_avatar'] }}"
                                             style="width:38px;height:38px;"></a>

                                    <div class="content">
                                        <div class="summary">
                                            <a href="{{ route('users.show',$notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>

                                            @if($notification->data['type'] == 'reply')
                                                • 回复了你的文章:

                                            @elseif($notification->data['type'] == 'attention')
                                                • 关注了你:
                                            @endif
                                            <a href="{{ $notification->data['topic_link'] }}">{{ $notification->data['topic_title'] }}</a>
                                            <span class="date pull-right">
                                                 <i class="icon time"></i>
                                                <span title="{{ $notification->created_at }}">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </span>
                                            <span class="date pull-right">
                                                @if($notification->read_at)
                                                    <span class="ui circular label notification" title="{{ $notification->read_at }}">已读</span>
                                                @else
                                                    <span class="red ui circular label notification" title="未读">未读</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div
                                            class=" markdown-reply mt-2">{!! markdownToHtml($notification->data['reply_content']) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $notifications->render() }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
