@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-default" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 15px; margin-top: 200px ">
                    <div style="text-align: center;" class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title">Alerts</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        <div class="callout ">
                            <h4>{{__('Beta')}}!</h4>
                            <p> {{__('This editor is in beta testing, bugs can happen. We are working to implement new features and fix bugs, if you have any problem please contact us through the help menu.')}}</p>
                        </div>

                        <div class="callout ">
                            <h4>Use {{__('Google Chrome')}}!</h4>
                            <p>   {{__('We strongly recommend using google chrome to run the editor, as we are not still able to run enough tests in other browsers.')}}</p>
                        </div>

                        <div class="callout callout-success" style="background-color:#62a0bb !important">
                            <h4><i class="icon fa fa-money"></i> {{__('Donate')}}</h4>
                            <h4>{{__('Hello! If the editor was helpful to you, please consider making a small donation via PayPal. Thank you!')}}</h4>
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick"/>
                                <input type="hidden" name="hosted_button_id" value="WE94D2BSERZNN"/>
                                <input class="center-image" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit"
                                       title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button"/>
                                <img alt="" border="0" src="https://www.paypal.com/en_BR/i/scr/pixel.gif" width="1" height="1"/>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="register-box">
                    <div class="login-logo">
                        <img class="img-responsive img full-width" id="login-image" src="{{asset('css/images/LogoGreen.png')}}" alt="" srcset="">
                    </div>

                    <div class="register-box-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <p class="login-box-msg">{{ __('Register') }}</p>
                        <form data-grecaptcha-action="message"  action="{{route('register', app()->getLocale()) }}" method="post">
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                       placeholder="{{ __('Name') }}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                @endif
                            </div>
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
                                       placeholder="{{ __('Senha') }}">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="{{ __('Confirm Password') }}">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                                @endif
                            </div>
                            <button style="background-color: #064c72;" type="submit"
                                    class="btn btn-primary btn-block btn-flat"
                            >{{ __('Register') }}</button>
                        </form>
                        <div class="auth-links">
                            <a href="{{route('login', app()->getLocale())}}"
                               class="text-center">{{ __('I already have a account') }}</a>
                        </div>
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.register-box -->
            </div>
        </div>
    </div>



@stop

@section('adminlte_js')
    @yield('js')
@stop
