<div class="content px-3 py-3">

    <h1 class="fs-large lh-3">
        <i class="icon search"></i> 关键词 <code class="search-keyword">{{ $search['q'] }}</code>
        的文章搜索结果（{{ $topics->total() }}）
    </h1>

    <div class="ui divider mb-1 topic-index-divider"></div>
    @if(count($topics))
        <div class="ui feed mt-0 pt-0 rm-link-color">
            @foreach($topics as $topic)
                <div class="event pt-3 pb-0 mb-0">
                    <div class="label mt-1" style="width: 3.2em;">
                        <a href="">
                            <img class="lazy" src="{{ getImageUrl($topic->path) }}" alt=""
                                 style="border: 1px solid #ddd;padding: 2px;">
                        </a>
                    </div>
                    <div class="content ml-3">
                        <div class="summary " style="color: #555;">
                            <a href="{{ $topic->link() }}" title="{{ $topic->title }}" class="title">
                                {{ $topic->title }}
                            </a>
                        </div>
                        <div class="meta mt-2 mb-2">
                            <div class="date" style="font-size: 13px;margin: 7px 0 0 0;">
                                <a href=""
                                   data-tooltip="分类"
                                   title="{{ isset($topic->category->name) ? $topic->category->name : '' }}">
                                    <i class="icon folder outline"></i> {{ isset($topic->category->name) ? $topic->category->name : '' }}
                                </a>
                                <span class="divider">|</span>
                                <a class="" data-tooltip="{{ $topic->created_at }}">
                                    发布于 <span
                                        title="{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
                                </a>
                                <span class="divider">|</span>
                                <a>
                                    阅读 {{ $topic->view_count }}
                                </a>
                                <span class="divider">|</span>
                                <a>
                                    评论 {{ $topic->reply_count }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="item-meta mt-2 text-right" style="color:#ccc;font-size: 12px;width: 150px;">
                        @if($topic->updated_at)
                            <a class="ui " href="{{ route('topics.show', $topic->id) }}"><i
                                    class="mr-1 icon thumbs up"></i> {{ $topic->vote_count }} </a>
                            <span style="margin: 0px 4px;text-align: center;font-size: 13px;">/</span>
                            <a class="ui  popover" data-content="活跃于：{{ $topic->updated_at->diffForHumans() }}" href="">
                                {{ $topic->updated_at->diffForHumans() }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div>暂无数据 ~_~</div>
@endif
