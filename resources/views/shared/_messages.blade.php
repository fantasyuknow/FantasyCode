
@foreach (['danger', 'warning', 'success', 'info', 'error', 'status', 'message'] as $msg)
  @if(session()->has($msg))
    @php
      $flag_class = '';
      switch ($msg){
          case 'danger':
              $flag_class = 'error';
              break;
          case 'status':
          case 'message':
              $flag_class = 'success';
              break;
      }
    @endphp
    <div class="ui container {{ $msg }} message {{ $flag_class }}">
      <i class="close icon"></i>
      <div class="header">
        提示:
      </div>
      <p>{{ session()->get($msg) }}</p>
    </div>
  @endif
@endforeach
