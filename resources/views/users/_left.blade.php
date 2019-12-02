<style>
    #user_left_a {
        color: #636b6f;
        padding: .92857143em .824285714em .92857143em .4em;
    }
</style>
<div class="three wide column ">
    <div class="ui fluid vertical pointing right menu card link" style="border: 1px solid #d3e0e9;">
        <div class="header my-2 py-1">
            <h2 class="fs-normal pl-3 text-mute">Ta 的创作</h2>
        </div>
        <a href="{{ route('users.show',$user->id) }}" class="item lh-2 {{ if_route('users.show') ? 'active' : '' }}"
           id="user_left_a">
            <i class="icon pr-1 nofloat user"></i> 基本资料
        </a>
        <a href="{{ route('users.topics',$user->id) }}" class="item lh-2 {{ if_route('users.topics') ? 'active' : '' }}"
           id="user_left_a">
            <i class="icon pr-1 nofloat file text outline"></i> Ta 的博文
            <span class="ui left  label">{{ $user->topic_count }}</span>
        </a>

        <a href="{{ route('users.replies',$user->id) }}"
           class="item lh-2 {{ if_route('users.replies') ? 'active' : '' }}" id="user_left_a">
            <i class="icon pr-1 nofloat comment"></i> Ta 的回复
            <span class="ui left  label">{{ $user->reply_count }}</span>
        </a>
        <a href="{{ route('users.vote_collect_topics',$user->id) }}?type=collect"
           class="item lh-2 {{ if_route('users.vote_collect_topics') && if_query('type','collect') ? 'active' : '' }}"
           id="user_left_a">
            <i class="icon pr-1 nofloat heart outline"></i> Ta 的收藏
            <span class="ui left  label">{{ $user->collectCount }}</span>
        </a>

        <a href="{{ route('users.vote_collect_topics',$user->id) }}?type=vote"
           class="item lh-2 {{ if_route('users.vote_collect_topics') && if_query('type','vote') ? 'active' : '' }}"
           id="user_left_a">
            <i class="icon pr-1 nofloat thumbs up"></i> Ta 的点赞
            <span class="ui left  label">{{ $user->voteCount}}</span>
        </a>
    </div>


    <div class="ui fluid vertical pointing right menu card link" style="border: 1px solid #d3e0e9;">
        <div class="header my-2 py-1">
            <h2 class="fs-normal pl-3 text-mute">Ta 的关系</h2>
        </div>
        <a href="{{ route('users.follow_fans',$user->id) }}?type=follows" class="item lh-2 " id="user_left_a">
            <i class="icon pr-1 nofloat eye"></i> Ta 的关注
            <span class="ui left  label">{{ $user->follow_count }}</span>
        </a>

        <a href="{{ route('users.follow_fans',$user->id) }}?type=fans" class="item lh-2 " id="user_left_a">
            <i class="icon pr-1 nofloat smile"></i> Ta 的粉丝
            <span class="ui left  label">{{ $user->fans_count }}</span>
        </a>

    </div>
</div>
