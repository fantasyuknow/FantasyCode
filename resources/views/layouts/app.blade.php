<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/public/favicon.png') }}" type="image/x-icon" />
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        {{-- JWT Token --}}
        <meta name="jwt-token" content="{{ 'Bearer '.JWTAuth::fromUser(Auth::user()) }}">
    @endauth

    <title>@yield('title', 'FantasyCode') - FantasyCode 博客社区</title>
    <meta name="Description" content="@yield('Description',  'FantasyCode 程序爱好者的学习园地')">
    <meta name="Keywords" content="@yield('Keywords', 'FantasyCode 一起学习，一起进步，一起努力')">
    <meta name="author" content="GucciLee" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/ext/prism/prism.css') }}">
    @yield('style')

    <script type="text/javascript">
        window.Config = {
            'token': "{{ csrf_token() }}",
            'isApi': false,
            'url': "{{ config('app.url') }}",
            'routes': {
                'upload_image': "{{ route('api.image_upload') }}",
            }
        };
    </script>
</head>
<body class="pushable {{ route_class() }}-page">
{{-- 网页主体 --}}
{{--@yield('body')--}}

<div class="pusher">
    <div class="main container" style="min-height: 80vh;">
        @include('layouts._header')
        @include('shared._messages')
        @yield('content')
    </div>
    @include('layouts._footer')
</div>

<!-- Scripts -->
<script type="text/javascript" src="{{ mix('js/app.js')}}"></script>
@yield('script')
</body>
</html>
