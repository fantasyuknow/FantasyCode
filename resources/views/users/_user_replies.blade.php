<div class="nine wide column">

    <div class="ui segment px-3 py-3">
        <h1 class="mb-4 fw-bold">
            <i class="icon pr-1 nofloat comment outline"></i>{{ $user->name }} 的所有回复（{{ $user_replies->total() }}）
        </h1>
        <div class="ui divider"></div>
        <div class="ui feed">
            @if($user_replies)
                @foreach($user_replies as $reply)
                    <div class="event mt-4 mb-1 display-block">
                        <div class="content">
                            <a class="ui ribbon green basic label mb-4" style="margin-left: -8px;"
                               href="{{ $reply->topic->link() }}?#reply{{ $reply->id }}" target="_blank">
                                评论于 <span title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>
                            </a>
                            <div class="summary">

                                <a href="{{ $reply->topic->link() }}?#reply{{ $reply->id }}" target="_blank"
                                   title="{{ $reply->topic->title }}"
                                   class="remove-padding-left  rm-link-color">
                                   {{ $reply->topic->title }}
                                </a>
                            </div>

                            <div class="reply-body markdown-reply content-body px-2 pt-2">
                                <p>{{ $reply->body }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $user_replies->render() }}
            @endif

        </div>
    </div>

</div>
