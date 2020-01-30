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
            <div class="col-md-7">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">See how it works...</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <video class="full-width" loop autoplay>
                                        <source src="css/images/Slide1.mp4" type="video/mp4">
                                    </video>
                                    <div class="carousel-caption">
                                        Create your own ontologies!
                                    </div>
                                </div>
                                <div class="item">
                                    <video class="full-width" loop autoplay>
                                        <source src="css/images/Slide2.mp4" type="video/mp4">
                                    </video>
                                    <div class="carousel-caption">
                                        The error console will help you out!
                                    </div>
                                </div>
                                <div class="item">
                                    <video class="full-width" loop autoplay>
                                        <source src="css/images/Slide3.mp4" type="video/mp4">
                                    </video>
                                    <div class="carousel-caption">
                                        Use our ontology manager to organize your own ontologies
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">FAQ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                <div class="panel box box-success">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                What is the Onto4ALL Editor?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="box-body">
                                            Onto4All is a free graphical editor capable of creating, editing and exporting
                                            ontologies being guided by an error console, a ontological building rules tab and an extensive
                                            palette of ontological classes and relationships.
                                            Export formats are: OWL, XML, SVG.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box box-success">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                It's been updated?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="box-body">
                                            Yes, we've been updating the editor for the past months and developing new
                                            functionalities. Contact us via e-mail if you have any suggestion.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box box-success">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                What is the main public of the editor?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="box-body">
                                            We aim to reach all types of audiences. From students learning what an ontology
                                            is to professionals in the field.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="login-box">
                        <div class="login-logo">
                            <img class="img-responsive img" id="login-image" src="css/images/Onto4ALL.png" alt="" srcset="">
                        </div>
                        <!-- /.login-logo -->
                        <div class="login-box-body">
                            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
                            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
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
                            <div class="auth-links">
                                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                                   class="text-center"
                                >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                                <br>
                                @if (config('adminlte.register_url', 'register'))
                                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                                       class="text-center"
                                    >{{ trans('adminlte::adminlte.register_a_new_membership') }} (It's free!)</a>
                                @endif
                            </div>
                            <!--
                            <div class="social-auth-links text-center">
                                <p>- OR -</p>
                                <a href="redirect/google" style=".btn-google: background-color: #ffffff !important"
                                   class="btn btn-block btn-social btn-google btn-flat btn-info"><i
                                            class="fa fa-fw fa-google"></i> Sign in using
                                    Google</a>
                            </div> -->
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <i class="fa fa-fw fa-github fa-2x"></i>
                                    <a href="https://github.com/Piazzi/ontologyFramework">See us on github </a>
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <i class="fa fa-fw fa-envelope fa-2x"></i>
                                    <a href="#" data-toggle="modal" data-target="#contact" aria-expanded="false">Contact us</a>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.login-box-body -->
                    </div><!-- /.login-box -->
                    <div class="row">
                        <div class="login-box">
                            <div class="login-box-body">
                                    <h4 class="login-box-msg">Hello! If the editor was helpful to you, please consider making a small donation via PayPal. Thank you!</h4>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                        <input type="hidden" name="cmd" value="_s-xclick" />
                                        <input type="hidden" name="hosted_button_id" value="WE94D2BSERZNN" />
                                        <input class="center-image" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                                        <img alt="" border="0" src="https://www.paypal.com/en_BR/i/scr/pixel.gif" width="1" height="1" />
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Having some issues with the editor? Have any
                            idea you'd like to be implemented? Fill the form below:</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>
                            <a><i class="fa fa-mail-forward"></i> Lucas Piazzi - Developer - lpiazzi@ice.ufjf.br</a>
                        </li>
                        <li>
                            <a><i class="fa fa-mail-forward"></i> Fabrício Mendonça - Professor - fabricio.mendonca@ice.ufjf.br</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
