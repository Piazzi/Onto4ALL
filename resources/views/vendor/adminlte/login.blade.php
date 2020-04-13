@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@if (session()->has('Success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <strong>{{ session('Success') }}</strong>
    </div>
@endif

@section('body')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="login-box">
                        <div class="login-logo">
                            <img class="img-responsive img" id="login-image" src="css/images/Onto4ALL.png" alt="onto4all-logo" srcset="">
                        </div>
                        <!-- /.login-logo -->
                        <div class="login-box-body">
                            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
                            <form data-grecaptcha-action="message" action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                                {!! csrf_field() !!}

                                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <input type="password" name="password" class="form-control"
                                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox"
                                                       name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button style="background-color: #00A65A" type="submit"
                                                class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                                    </div>
                                    <!-- /.col -->

                                </div>
                            </form>

                            <div class="social-auth-links text-center">
                                <p>- OR -</p>
                                <a href="{{url('/redirect')}}"
                                   class="btn btn-block btn-social btn-facebook btn-flat btn-info"><i
                                            class="fa fa-fw fa-facebook"></i> Sign in using
                                    Facebook</a>
                            </div>

                            <div class="auth-links">
                                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                                   class="text-center"
                                >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                                <br>
                                @if (config('adminlte.register_url', 'register'))
                                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                                       class="text-center"
                                    >Create a new account</a>
                                @endif
                            </div>

                            <hr>

                            <div class="row">
                                <h4 class="login-box-msg">Hello! If the editor was helpful to you, please consider making a small donation via PayPal. Thank you!</h4>
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick" />
                                    <input type="hidden" name="hosted_button_id" value="WE94D2BSERZNN" />
                                    <input class="center-image" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                                    <img alt="" border="0" src="https://www.paypal.com/en_BR/i/scr/pixel.gif" width="1" height="1" />
                                </form>
                            </div>
                        </div>
                        <!-- /.login-box-body -->
                    </div><!-- /.login-box -->
                </div>
            </div>
        </div>
    </div>

@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
