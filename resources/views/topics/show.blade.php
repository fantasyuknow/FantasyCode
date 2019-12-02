@extends('layouts.app')
@section('title', isset($topic->title) ? $topic->title : '文章')

@section('style')
    <style type="text/css">
        .blog.grid.container.main {
            display: block;
        }

        .blog.grid.container.main .sidebar {
            font-size: 14px;
            padding-right: 6px;
        }

        .ui.top.menu {
            margin-bottom: 30px;
        }

        .tocify-header {
            padding: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="ui centered grid container main stackable blog">
        <div class="js-computed-height-right twelve wide column pull-right main main-column">
            {{-- 文章 --}}
            <div class="ui segment article-content">
                {{-- 右侧工具条 --}}
                <div class="right ui rail hide-on-mobile">

                    <div class="ui sticky topic-operation">
                        <div class="ui vertical icon menu border-0">
                            <a class="item text-mute ui action topic-vote popover rm-link-color text-mute"
                               data-position="left center"
                               id="article-vote"
                               href="javascript:;"
                               data-html="点赞">
                                <i class="thumbs up icon fs-large {{ $user_upvote ? 'active':'' }}"
                                   topic_id="{{ $topic->id }}"></i>
                                <span
                                    class="count vote-count fs-small mt-2 display-inline-block">{{ $topic->vote_count }}</span>
                            </a>

                            <a class="item text-mute ui action collect popover rm-link-color text-mute"
                               data-position="left center"
                               id="article-collection"
                               href="javascript:;"
                               data-html="收藏">
                                <i class="heart icon fs-large {{ $user_collect ? 'active' :'' }}"
                                   topic_id="{{ $topic->id }}"></i>
                                <span
                                    class="count vote-count fs-small mt-2 display-inline-block">{{ $topic->collect_count }}</span>
                            </a>

                            <a class="item text-mute ui action  popover rm-link-color text-mute"
                               data-position="left center"
                               href="#replies"
                               onclick="scrollToAnchor('replies')" title="评论">
                                <i class="comments icon fs-large"></i>
                                <span class="fs-small mt-2 display-inline-block">{{ $topic->reply_count }}</span>
                            </a>

                            <a class="item ui   popover rm-link-color text-mute"
                               data-position="left center" href="#topnav"
                               onclick="scrollToAnchor('topnav')" title="返回顶部">
                                <i class="angle double up icon fs-large fw-bold"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 博文 --}}
                <div class="extra-padding" style="padding-bottom:4px">
                    {{-- 标题 --}}
                    <h1 style="margin-bottom: 15px;">
                        <span style="line-height: 34px;">{{ $topic->title }}</span>
                    </h1>

                    {{-- 信息工具条 --}}
                    <div class="book-article-meta" style="margin-bottom: 10px;">
                        <i class="icon folder outline"></i>
                        <a class="" data-inverted="" data-tooltip="分类:{{ $topic->category->name }}">
                            {{ $topic->category->name }}
                        </a>
                        <span class="divider">/</span>
                        <i class="icon time outline"></i>
                        <a class="" data-inverted="" data-tooltip="{{ $topic->created_at }}">
                            创建于 <span title="{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
                        </a>

                        <span class="divider">/</span>
                        <i class="icon eye open"></i>
                        <a>阅读数 {{ $topic->view_count }}</a>

                        <span class="divider">/</span>
                        <i class="icon comments outline"></i>
                        <a>评论数 {{ $topic->reply_count }}</a>
                        <span class="divider">/</span>
                        @can('update', $topic)
                            <span style="font-size: 13px;color: #adb1af;">
                            （
                            <a href="{{ route('topics.edit', $topic->id) }}"><i class="icon edit"></i>编辑</a>
                            <span class="divider">|</span>
                            <a class="top-admin-operation ml-0"
                               href="javascript:;"
                               data-method="delete"
                               data-url="" style="cursor: pointer;">
                                <i class=" trash icon"></i>删除
                                <form action="{{ route('topics.destroy', $topic->id) }}" method="POST"
                                      style="display:none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </a>
                            ）
                        </span>
                        @endcan
                    </div>

                    {{-- 分割线 --}}
                    <div class="ui divider"></div>

                    {{-- 文章详情 --}}
                    <div class="ui readme markdown-body content-body fluidbox-content">
                        {!! $topic->body !!}
                    </div>
                </div>
            </div>

            {{-- 回复 --}}
            @include('topics._reply_list')
            @includeWhen(\Illuminate\Support\Facades\Auth::check(), 'topics._reply_box')
        </div>
        @include('topics._sidebar', ['sidebar_data'=> $sidebar_data])
    </div>
@endsection


@section('script')
    @if(\Illuminate\Support\Facades\Auth::check())
        <script src="{{ asset('ext/Simplemde_Markdown/init.js') }}"></script>
    @endif
    <script type="text/javascript">

        var auth = Boolean("{{ \Illuminate\Support\Facades\Auth::check() }}");
        if (auth) {
            // 发表回复
            var markdown = new MyMarkdown();
            markdown.init({
                'textarea': {
                    'id': 'markdown-editor'
                },
                'interval': false,
                'markdown': {
                    status: false,
                    toolbar: false,
                },
                'events': {
                    change: function (html) {
                        if ($.trim(html) !== '') {
                            $("#preview-box").html(html).fadeIn();
                        } else {
                            $("#preview-box").fadeOut();
                        }
                    }
                }
            });

            // 删除评论
            FantasyCodeNew.axiosDeleteForm(function (btn) {
                $(btn).closest('.comment').remove();
            })


            // 发表评论
            $("#comment-composing-form").submit(function () {
                if (auth) {
                    axios({
                        method: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                    }).then((res) => {
                        Swal.fire({
                            type: 'success',
                            confirmButtonColor: '#21BA45',
                            title: '评论发表成功~',
                        });
                        // 重置 markdown
                        window['markdown_markdown-editor'].value('');
                        window.location.reload();
                    }).catch(function (error) {
                        window.public.axios_catch(error);
                    });
                } else {
                    window.location.href = "{{ route('login') }}";
                }
            });
        }

        /**
         * 点赞
         */
        $('#article-vote').click(function () {
            if (auth === false) {
                Swal.fire({
                    title: '马上去登录吧~',
                    text: "您还未登录，无法为您喜欢的文章点赞哦~",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#21BA45',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '去登录',
                    cancelButtonText: '不了',
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
                return false;
            }
            var self = this;
            var icon = $(self).find('i');
            icon.addClass("spinner loading").removeClass("thumbs up");
            var op = 1;

            if (icon.hasClass('active')) {
                op = 0;
            }
            var topic_id = icon.attr('topic_id');

            axios({
                url: "{{ route('api.topics.vote_collect') }}",
                data: {topic_id: topic_id, type: 'vote', op: op},
                method: 'post',
            }).then((res) => {
                icon.addClass("thumbs up").removeClass("spinner loading");
                if (res.status) {
                    $(self).find('span').text(res.data.data.vote_count);
                    if (op == 0) {
                        $(self).find('i').removeClass('active');
                    } else {
                        $(self).find('i').addClass('active');
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '网站好像开小差了^_^~',
                        text: '什么鬼?一起来吐槽站长吧',
                        footer: '<a href>留言板</a>'
                    });
                }
            })
        });


        /**
         * 收藏
         */
        $('#article-collection').click(function () {
            if (auth === false) {
                Swal.fire({
                    title: '马上去登录吧~',
                    text: "您还未登录，无法收藏您喜爱的文章哦~",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#21BA45',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '去登录',
                    cancelButtonText: '不了',
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
                return false;
            }
            var self = this;
            var icon = $(self).find('i');
            icon.addClass("spinner loading").removeClass("heart");
            var op = 1;

            if (icon.hasClass('active')) {
                op = 0;
            }
            var topic_id = icon.attr('topic_id');

            axios({
                url: "{{ route('api.topics.vote_collect') }}",
                data: {topic_id: topic_id, type: 'collecct', op: op},
                method: 'post',
            }).then((res) => {
                icon.addClass("heart").removeClass("spinner loading");

                if (res.status) {
                    $(self).find('span').text(res.data.data.collect_count);
                    if (op == 0) {
                        $(self).find('i').removeClass('active');
                    } else {
                        Swal.fire({
                            type: 'success',
                            confirmButtonColor: '#21BA45',
                            title: '收藏成功~',
                        });
                        $(self).find('i').addClass('active');
                    }
                } else {
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: res.data.msg,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            })
        });


        /**
         * 关注作者或者取消关注
         *
         */
        $('.user_attention').click(function () {
            if (auth === false) {
                Swal.fire({
                    title: '马上去登录吧~',
                    text: "您还未登录，无法关注您喜爱的作者哦~",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#21BA45',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '去登录',
                    cancelButtonText: '不了',
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
                return false;
            }

            var self = this;
            var icon = $(self).find('i');
            var op = 1;
            if ($(self).attr('type') === '1') {
                //已关注，取消关注
                op = 0;
                icon.addClass("spinner loading").removeClass("checkmark");
            } else {
                //未关注，关注
                icon.addClass("spinner loading").removeClass("plus");
            }
            var user_id = $(self).attr('data-id');

            axios({
                url: "{{ route('api.user_attention') }}",
                data: {user_id: user_id, op: op},
                method: 'post',
            }).then((res) => {
                icon.addClass("plus").removeClass("spinner loading");

                if (res.status) {
                    $(self).find('span').text(res.data.data.collect_count);
                    if ($(self).attr('type') === '1') {
                        $(self).find('i').removeClass('spinner loading').addClass('plus');
                        $(self).attr('type', '0');
                    } else {
                        $(self).find('i').removeClass('spinner loading').addClass('checkmark');
                        $(self).attr('type', '1');
                    }
                } else {
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: res.data.msg,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            })
        });


    </script>
@endsection

