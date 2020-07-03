@foreach (['danger', 'warning', 'success', 'info'] as $msg)
 @if(session()->has($msg))
 <div class="flash-message">
 <p class="alert alert-{{ $msg }}">
 {{ session()->get($msg) }}
 </p>
 </div>
session()->flash('success', 'This is a success alert—check it out!');
session()->flash('danger', 'This is a danger alert—check it out!');
session()->flash('warning', 'This is a warning alert—check it out!');
session()->flash('info', 'This is a info alert—check it out!');

 @endif
@endforeach