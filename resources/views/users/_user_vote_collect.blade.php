<div class="nine wide column">

    <div class="ui segment px-4 py-4">

        <h1 class="mb-4 fw-bold">
            <i class="icon pr-1 nofloat list ul"></i>{{ $user->name }}

            @if(if_query('type','vote'))
                赞过的内容
            @else
                收藏的内容
             @endif
            （{{ $user_vote_topics->total() }}）
        </h1>

        <div class="ui divider"></div>

        <div class="ui feed blog-article-list rm-link-color">

            @if($user_vote_topics)
                @foreach($user_vote_topics as $topic)
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <a href="{{ route('topics.show',$topic->id) }}" class="title">{{ $topic->title }}</a>
                            </div>

                            <div class="meta" style="line-height: 34px;">
                                <div class="tags" style="margin: -2px 0px 0px;margin-bottom: -8px;">
{{--                                    @if($topic->tags)--}}
{{--                                        @foreach($topic->tags as $tag)--}}
{{--                                            <a class="ui label small" href=""--}}
{{--                                               style="margin-left: 0px !important;">{{ $tag->name }}</a>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
                                </div>

                                <div class="date" style="font-size: 13px;margin: 7px 0em 0em;margin-left:0px">
                                    <a class="item" href="{{ $topic->link() }}" style="">
                                        <img class="ui image display-inline-block mr-1"
                                             style="width:16px;height:16px;margin-top:-3px"
                                             src="{{ getImageUrl($topic->avatar) }}"></a>

                                    <span class="divider">|</span>


                                    <a class="" data-tooltip="{{ $topic->created_at }}">创建于 <span
                                            title="{{ $topic->created_at }}">{{$topic->created_at }}</span></a>

                                    <span class="divider">|</span>
                                    <a>
                                        阅读数 {{ $topic->view_count }}
                                    </a>
                                    <span class="divider">|</span>
                                    <a>
                                        评论数 {{ $topic->reply_count }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


    </div>

</div>
