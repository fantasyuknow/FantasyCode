@extends('layouts.app')
@section('title', '首页')
@section('content')
    <div style="background-color: #fff">
        <div class="ui vertical stripe segment">
            <div class="ui centered grid container main stackable blog" style="">
                <div class="twelve wide column pull-right main" style="margin-bottom: 3rem;">
                    <div class="ui segment article-content">
                        <div class="extra-padding">
                            <h2 class="ui block header">
                                <img class="ui image" src="{{ asset('/images/public/school.png') }}">
                                <div class="content">优质文章</div>
                            </h2>

{{--                            @include('pages.blog_articles._article_list')--}}

                            {{-- 分页 --}}
{{--                            {{ $blog_articles->links() }}--}}
                        </div>
                    </div>
                </div>

{{--                @include('pages.blog_articles._sidebar', ['isArticleList'=> true])--}}
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('/ext/swiper4/js/swiper.min.js') }}"></script>
    <script type="text/javascript">
        new Swiper('.swiper-container', {
            autoplay:true,
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endsection
