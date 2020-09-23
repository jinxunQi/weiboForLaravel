@extends('layouts.default')

@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('statuses._status_form')
                </section>
{{--                <h4>微博列表</h4>--}}
                <h4>留言列表(friends' And Yours')</h4>
                <hr>
                @include('shared._feed')
            </div>
            {{--用户个人信息--}}
            <aside class="col-md-4">
                <section class="user_info">
                    @include('users._user_info', ['user' => Auth::user()])
                </section>
                {{--粉丝、关注、微博--}}
                <section class="stats mt-2">
                    @include('shared._stats', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Hello Laravel</h1>
            <p class="lead">
                What you see is what you want - 你看到的就是你想象到的
            </p>
            <p>
                begin start - 开始吧。注册登录后可以使用留言板功能！
            </p>
            <p>
                <a href="{{ route('signup') }}" class="btn btn-lg btn-success" role="button">现在注册</a>
            </p>
        </div>

    @endif
@stop

