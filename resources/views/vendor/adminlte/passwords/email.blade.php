@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <img class="img-responsive img" id="login-image" src="{{asset('css/images/LogoGreen.png')}}" alt="onto4all-logo" srcset="">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ __('Reset Password') }}</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ url(config('adminlte.password_email_url', 'password/email')) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ isset($email) ? $email : old('email') }}"
                           placeholder="{{ __('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-success btn-block btn-flat">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop