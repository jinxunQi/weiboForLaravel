@foreach (['success', 'error', 'info', 'warning', 'danger'] as $msg)
    @if (session()->get($msg))
{{--        <div class="flash-message">--}}
{{--            <p class="alert alert-{{ $msg }}">--}}
{{--                {{ session()->get($msg) }}--}}
{{--            </p>--}}
{{--        </div>--}}
        <div class="alert alert-{{ $msg }} alert-dismissible error-massage" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div>{{ session()->get($msg) }}</div>
        </div>
    @endif
@endforeach
