@extends('layouts.default')

@section('title', $user->name)

@section('content')
<div class="row">
    <div class="offset-md-2 col-md-8">
        <div class="offset-md-2 col-md-8">
            {{--用户信息--}}
            <section class="user_info">
                @include('users._user_info', ['user' => $user])
            </section>

            {{--博客列表--}}
            <section class="status">
                @if ($statuses->count() > 0)
                    <ul class="list-unstyled">
                        @foreach ($statuses as $status)
                            {{--单条博客--}}
                            @include('statuses._status')
                        @endforeach
                    </ul>
                @else
                    <p>没有数据！</p>
                @endif
            </section>
        </div>

    </div>
</div>
@stop
