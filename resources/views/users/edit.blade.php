@extends('layouts.app')
@section('title', '修改资料')

@section('content')
    <div class="ui centered grid container stackable">
        @include('users._edit_user_left', ['_left'=> ['active'=> 'edit']])

        <div class="twelve wide column">
            @include('shared._error')

            <div class="ui stacked segment">
                <div class="content px-3 py-3">
                    <h1>
                        <i class="icon edit" aria-hidden="true"></i> 修改资料
                    </h1>
                    <div class="ui divider"></div>
                    <form class="ui form" method="POST" action="{{ route('users.update', $user->id) }}"
                          accept-charset="UTF-8" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        {{-- 错误消息 --}}
                        @include('shared._error')

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">用户名</label>
                                <input name="name" type="text" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：富贵
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">邮 箱</label>
                                <input name="email" type="text" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：name@website.com
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">真实姓名</label>
                                <input name="real_name" type="text" value="{{ old('real_name', $user->real_name) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：王富贵
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">性别</label>
                                <select name="sex" class="ui dropdown">
                                    <option value="0" {{ $user->sex == 0 ? 'selected' : '' }}>保密</option>
                                    <option value="1" {{ $user->sex == 1 ? 'selected' : '' }}>男</option>
                                    <option value="2" {{ $user->sex == 2 ? 'selected' : '' }}>女</option>
                                </select>
                            </div>
                            <div class="six wide field pt-3 mt-4">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">GitHub 地址</label>
                                <input name="github_site" type="text"
                                       value="{{ old('github_site', $user->github_site) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                请跟 GitHub 上保持一致
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">微 博</label>
                                <input name="weibo_site" type="text" value="{{ old('weibo_site', $user->weibo_site) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：name@website.com
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">爱好</label>
                                <input name="hobby" type="text" value="{{ old('hobby', $user->hobby) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：足球，登山
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">城市</label>
                                <input name="city" type="text" value="{{ old('city', $user->city) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：苏州、南京
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">公司或组织名称</label>
                                <input name="company" type="text" value="{{ old('company', $user->company) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：杰威尔
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">职位头衔</label>
                                <input name="job_title" type="text" value="{{ old('job_title', $user->job_title) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：技术小组长
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">个人网站</label>
                                <input name="per_web" type="text" value="{{ old('per_web', $user->per_web) }}">
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                如：example.com，不需要加前缀 https://
                            </div>
                        </div>

{{--                        <div class="two fields">--}}
{{--                            <div class="ten wide field ">--}}
{{--                                <label for="wc_qrcode">微信账号二维码</label>--}}
{{--                                <input type="file" name="wc_qrcode" class="image-upload-input"--}}
{{--                                       value="{{ old('wc_qrcode', $user->wc_qrcode) }}">--}}
{{--                                @if($user->wc_qrcode)--}}
{{--                                    <img class="payment-qrcode" src="" alt="">--}}
{{--                                    <span class="close clear-image">x</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="six wide field pt-3 mt-4">--}}
{{--                                你的微信个人账号，或者订阅号--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="two fields">--}}
{{--                            <div class="ten wide field ">--}}
{{--                                <label for="pay_qrcode">支付二维码</label>--}}
{{--                                <input type="file" name="pay_qrcode" class="image-upload-input"--}}
{{--                                       value="{{ old('pay_qrcode', $user->pay_qrcode) }}">--}}
{{--                                @if($user->pay_qrcode)--}}
{{--                                    <img class="payment-qrcode" src="" alt="">--}}
{{--                                    <span class="close clear-image">x</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="six wide field pt-3 mt-4">--}}
{{--                                文章打赏时使用，微信支付二维码--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">个人简介</label>
                                <textarea rows="3" name="introduction" cols="50" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 94.9886px;">{{ old('introduction', $user->introduction) }}</textarea>
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                请一句话优雅的介绍你自己，大部分情况下会在你的头像和名字旁边显示
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="ten wide field ">
                                <label for="">署名</label>
                                <textarea rows="3" name="signature" cols="50" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 94.9886px;">{{ old('signature', $user->signature) }}</textarea>
                            </div>
                            <div class="six wide field pt-3 mt-4">
                                文章署名，会拼接在每一个你发表过的帖子内容后面。支持 Markdown。
                            </div>
                        </div>

                        <div class="field">
                            <div class="col-sm-offset-2 col-sm-6">
                                <input class="positive ui button " id="user-edit-submit" type="submit" value="修改">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
