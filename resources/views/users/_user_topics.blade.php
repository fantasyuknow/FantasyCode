<div class="nine wide column">
    <div class="ui segment px-3 py-3">
        <h1 class="mb-4 fw-bold">
            <i class="icon pr-1 nofloat file text outline"></i> {{ $user->name }} 发布的文章（{{ $user_topics->total() }}）
            <a class="fs-large rm-link-color pull-right" href="" target="_blank"><i class="icon newspaper"></i> 个人博客</a>
        </h1>
        <div class="ui divider"></div>
        <div class="ui feed blog-article-list rm-link-color">
            @foreach($user_topics as $topic)
                <div class="event">
                    <div class="content">
                        <div class="summary">
                            <a href="{{ $topic->link() }}" class="title"> {{ $topic->title }} </a>
                        </div>
                        <div class="meta" style="line-height: 34px;">
                            <div class="tags" style="margin: -2px 0px 0px;margin-bottom: -8px;">
                                @if($topic->tags)
                                    @foreach($topic->tags as $tag)
                                        <a class="ui label small" href="{{ route('tags.show',$tag->id) }}"
                                           style="margin-left: 0px !important;" target="_blank">{{ $tag->name}}</a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="date" style="font-size: 13px;margin: 7px 0em 0em;margin-left:0px">
                                <a class="item" href="{{ route('users.show',$topic->user_id)}}" target="_blank"
                                   style="" data-tooltip="{{ $topic->user->name }}">
                                    <img class="ui image display-inline-block mr-1"
                                         style="width:16px;height:16px;margin-top:-3px"
                                         src="{{ $topic->user->userAvatar }}"></a>
                                <span class="divider">|</span>
                                <a class="" data-tooltip="{{ $topic->created_at }}">创建于
                                    <span>{{ $topic->created_at->diffForHumans() }}</span></a>

                                <span class="divider">|</span>
                                <a>
                                    阅读数 {{ $topic->view_count }}
                                </a>
                                <span class="divider">|</span>
                                <a>
                                    评论数 {{ $topic->reply_count }}
                                </a>
                                <span class="divider">|</span>
                                <a>
                                    点赞数 {{ $topic->vote_count }}
                                </a>
                                <span class="divider">|</span>
                                <a>
                                    收藏数 {{ $topic->collect_count }}
                                </a>
                            </div>
                        </div>
                    </div>
                    {{--                <div class="item-meta">--}}
                    {{--                    <a class="ui label basic light grey"><i class="thumbs up icon"></i> {{ $topic->vote_count }} </a>--}}
                    {{--                    <a class="ui label basic light grey"><i class="comment icon"></i> {{ $topic->reply_count }} </a>--}}
                    {{--                </div>--}}
                </div>
            @endforeach
                {{ $user_topics->render() }}
        </div>
    </div>
</div>
