@extends('layout.auth_app')
@section('content-form')
    <form id="register-form" action="{{url('/register')}}" method="post">
        {{csrf_field()}}
        <h2 class="login-title">Sign Up</h2>
        @if ($errors->any())
            <div class="form-group">
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="first_name" placeholder="First Name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                </div>
            </div>
        </div>
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
        </div>
        <div class="form-group">
            <input class="form-control" id="password" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="confirm-password" placeholder="Confirm Password">
        </div>
        <div class="form-group text-left">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox" name="agree">
                <span class="input-span"></span>I agree the terms and policy</label>
        </div>
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Sign up</button>
        </div>

        <div class="text-center">Already a member?
            <a class="color-blue" href="{{url('/login')}}">Login here</a>
        </div>
    </form>
@endsection