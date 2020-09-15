@extends('layouts.default')

@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('statuses._status_form')
                </section>
            </div>
            <div class="col-md-4">
                <section class="user_info">
                    @include('users._user_info', ['user' => Auth::user()])
                </section>
            </div>
        </div>
    @else
        <div class="jumbotron">
            <h1>Hello Laravel</h1>
            <p class="lead">
                What you see is what you want - 你看到的就是你想象到的
            </p>
            <p>
                begin start - 开始吧。
            </p>
            <p>
                <a href="{{ route('signup') }}" class="btn btn-lg btn-success" role="button">现在注册</a>
            </p>
        </div>

    @endif
@stop

