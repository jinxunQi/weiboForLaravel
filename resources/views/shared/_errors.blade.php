@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

{{--@foreach ($errors->all() as $error)--}}
{{--    <div class="alert alert-danger alert-dismissible error-massage" role="alert">--}}
{{--        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
{{--        <span>{{ $error }}</span>--}}
{{--    </div>--}}
{{--@endforeach--}}

@endif
