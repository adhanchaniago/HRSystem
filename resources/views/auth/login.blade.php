@extends('layout.auth_app')
@section('content-form')
    <form id="login-form" action="{{url('/login')}}" method="post">
        {{csrf_field()}}
        <h2 class="login-title">Log in</h2>
        @if (session('loginError'))
            <div class="form-group">
                <div class="alert alert-danger">
                    {{ session('loginError') }}
                </div>
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group d-flex justify-content-between">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox">
                <span class="input-span"></span>Remember me</label>
            <a href="{{url('/forgot-password')}}">Forgot password?</a>
        </div>
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Login</button>
        </div>

        <div class="text-center">Not a member?
            <a class="color-blue" href="{{url('/register')}}">Create an account</a>
        </div>
    </form>
@endsection