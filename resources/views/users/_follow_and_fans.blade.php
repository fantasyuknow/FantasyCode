<div class="nine wide column">
    <div class="ui segment px-3 py-3">
        <h1 class="mb-4 fw-bold">
            <i class="icon pr-1 nofloat comment outline"></i>
             {{ $user->name }}
            @if(if_query('type','follows'))
                关注用户
            @else
                粉丝用户
            @endif
            （{{ $follow_fans->total() }}）
        </h1>
        <div class="ui divider"></div>
        <div class="ui divided items">
            @foreach($follow_fans as $item)
                <div class="item">
                    <div class="ui image image-55 ">
                        <a href="{{ route('users.show',$item->id) }}" target="_blank" class="">
                            <img class="image-border" src="{{ $user->userAvatar }}">
                        </a>
                    </div>
                    <div class="middle aligned content">
                        <h4><a href="{{ route('users.show',$item->id) }}" target="_blank">{{ $item->name }}</a></h4>
                        <div>
                            {{ $user->introduction }}
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $follow_fans->render() }}
        </div>
    </div>
</div>
