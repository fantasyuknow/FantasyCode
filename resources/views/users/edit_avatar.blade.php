@extends('layouts.app')

@section('title', '修改头像')

@section('content')
    <div class="ui centered grid container stackable">
        @include('users._edit_user_left', ['_left'=> ['active'=> 'edit_avatar']])

        <div class="twelve wide column">
            <div class="ui stacked segment">
                <div class="content px-3 py-3">
                    <h1>
                        <i class="icon image" aria-hidden="true"></i> 修改头像
                    </h1>

                    <div class="ui divider"></div>
                    <div class="ui message warning my-3">
                        <b><i class="icon info"></i> 请注意：</b>
                        <p>请上传正常的人物头像，真人或卡通皆可。</p>
                        <p>上传闪烁、奇异、违法、色情头像，情节严重者将会被禁言处理。</p>
                    </div>

                    <form class="ui form"
                          method="POST"
                          action="{{ route('users.update_avatar',$user->id) }}"
                          enctype="multipart/form-data"
                          accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="image_id" value="{{ $user->image_id }}">
                        <div>
                            <img id="upload-img"
                                 class="upload-img image-border ui popover"
                                 data-variation="inverted"
                                 data-content="【点击我】上传图片吧"
                                 src="{{ $user->userAvatar}}" width="320">
                        </div>
                        <div class="filed mt-3">
                            <button class="ui button green" id="upload-button" type="submit">更新头像资料</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $("#upload-img").click(function () {
            let self = this;
            new MyUploadOne({
                'f_type': 'avatar',
                'url': "{{ route('api.image_upload') }}",
                success: function (res) {
                    let path = res.data.path;
                    $(self).attr('src', path);
                    $(self).closest('form').find("input[name='image_id']").val(res.data.id);
                }
            });
        });
    </script>
@endsection
