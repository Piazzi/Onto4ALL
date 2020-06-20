<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Onto4ALL - Ontology Graphical Editor</title>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
          rel="stylesheet" type="text/css"/>
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
          rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/landing-page.css" rel="stylesheet"/>


</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Onto4ALL</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">{{__('About')}}</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#features">{{__('Features')}}</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">{{__('Contact')}}</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" data-toggle="modal"
                                        data-target="#loginModal">Login</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" data-toggle="modal"
                                        data-target="#registerModal">{{__('Register')}}</a></li>
                @foreach (config('app.available_locales') as $locale)
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ $locale }}"
                           @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>{{ strtoupper($locale) }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</nav>
<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-uppercase text-white font-weight-bold">{{__('Draw your own ontologies')}}</h1>
                <hr class="divider my-4"/>
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5">{{__('Build your first ontology using the many features in our editor')}}</p>
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">{{__('Find Out More')}}</a>
            </div>
        </div>
    </div>
</header>
<!-- About section-->
<section class="page-section bg-primary" id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0">{{__('What is the Onto4ALL Editor?')}}</h2>
                <hr class="divider light my-4"/>
                <p class="text-white-50 mb-4">{{__('Is a free graphical editor capable of creating, editing and exporting ontologies being guided by an warnings console, an ontological building rules tab and an extensive palette of ontological classes and relationships.')}}</p>
                <a class="btn btn-light btn-xl js-scroll-trigger"
                   data-toggle="modal"  data-target="#loginModal">{{__('Get Started!')}}</a>
            </div>
        </div>
    </div>
</section>
<!-- Services section-->
<section class="page-section" id="features">
    <div class="container">
        <h2 class="text-center mt-0">{{__('Main Features')}}</h2>
        <hr class="divider my-4"/>
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-draw-polygon text-primary mb-4"></i>
                    <h3 class="h4 mb-2">{{__('Full Graphical editor')}}</h3>
                    <p class="text-muted mb-0">{{__('Draw any ontology you want, the way you want.')}}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-file-archive text-primary mb-4"></i>
                    <h3 class="h4 mb-2">{{__('Ontology Manager')}}</h3>
                    <p class="text-muted mb-0">{{__('Save, view, edit your ontologies in our ontology manager and access them later with just one click')}}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-file-download text-primary mb-4"></i>
                    <h3 class="h4 mb-2">{{__('Export')}}</h3>
                    <p class="text-muted mb-0">{{__('Export your ontology to OWL, XML or SVG')}}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-comment-dots text-primary mb-4"></i>
                    <h3 class="h4 mb-2">{{__('Warnings Console')}}</h3>
                    <p class="text-muted mb-0">{{__('The console will help you build a better ontology by providing to you good modelling practices')}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio section-->
<section id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="css/images/Landing-Page/editor.PNG"
                ><img class="img-fluid" src="css/images/Landing-Page/editor.PNG" alt=""/>
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50"></div>
                        <div class="project-name">{{__('Our Editor')}}</div>
                    </div>
                </a
                >
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="css/images/Landing-Page/ontology-manager.PNG"
                ><img class="img-fluid" src="css/images/Landing-Page/ontology-manager.PNG" alt=""/>
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50"></div>
                        <div class="project-name">{{__('The Ontology Manager')}}</div>
                    </div>
                </a
                >
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="css/images/Landing-Page/ontologies.PNG"
                ><img class="img-fluid" src="css/images/Landing-Page/ontologies.PNG" alt=""/>
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50"></div>
                        <div class="project-name">{{__('Open your ontologies with one click')}}</div>
                    </div>
                </a
                >
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="css/images/Landing-Page/warning-console.PNG"
                ><img class="img-fluid" src="css/images/Landing-Page/warning-console.PNG" alt=""/>
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50"></div>
                        <div class="project-name">{{__('Our warning console will help you out')}}</div>
                    </div>
                </a
                >
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="css/images/Landing-Page/tips.PNG"
                ><img class="img-fluid" src="css/images/Landing-Page/tips.PNG" alt=""/>
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50"></div>
                        <div class="project-name">{{__('Get the information you need with the tips menu')}}</div>
                    </div>
                </a
                >
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="css/images/Landing-Page/methodology.PNG"
                ><img class="img-fluid" src="css/images/Landing-Page/methodology.PNG" alt=""/>
                    <div class="portfolio-box-caption p-3">
                        <div class="project-category text-white-50"></div>
                        <div class="project-name">{{__('Mark your progress with our methodology menu')}}</div>
                    </div>
                </a
                >
            </div>
        </div>
    </div>
</section>
<!-- Call to action section-->
<section style="background-color: #00a65a !important;" class="page-section bg-dark text-white">
    <div class="container text-center">
        <h2 class="mb-4">{{__('Start Drawing Your Ontologies')}}</h2>
        <a style="color: black" class="btn btn-light btn-xl" data-target="#registerModal" data-toggle="modal">{{__('Register Now!')}}</a>
    </div>
</section>

<!-- Contact section-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mt-0">{{__('Have Any Question?')}}</h2>
                <hr class="divider my-4"/>
                <p class="text-muted mb-5">{{__('Contact Us')}}</p>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 text-muted"></i
                ><a class="d-block">lpiazzi26@gmail.com</a>
            </div>
        </div>
    </div>
</section>

<!-- Credits section-->
<section class="page-section">
    <div class="container">
        <h2 class="text-center mt-0">{{__('Onto4ALL was built with')}}</h2>
        <hr class="divider my-4"/>
        <div class="row">
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                    <img alt="laravel" src="css/images/Landing-Page/laravel.png">

                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                    <img alt="mxgraph" src="css/images/Landing-Page/mxgraph.png">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                    <img alt="jquery" src="css/images/Landing-Page/jquery.png">

                </div>
            </div>
        </div>
    </div>
</section>
<section class="page-section">
    <div class="container">
        <h2 class="text-center mt-0">{{__('Supported By')}}</h2>
        <hr class="divider my-4"/>
        <div class="row">
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                    <img alt="jquery" src="css/images/Landing-Page/ufjf.png">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                </div>
            </div>
        </div>
    </div>
</section>

<!--  LOGIN MODAL  -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header border-bottom-0">
                <div class="row">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <img style="width: 100%" class="img-responsive" id="login-image"
                     src="{{asset('css/images/Onto4ALL.png')}}" alt="onto4all-logo" srcset="">
            </div>
            <div class="modal-body">
                <div class="login-box">
                    <!-- /.login-logo -->
                    <div class="login-box-body">
                        <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>
                        <form data-grecaptcha-action="message" action="{{ route('login', app()->getLocale()) }}"
                              method="post">
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                       placeholder="{{ __('E-Mail Address') }}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input type="password" name="password" class="form-control"
                                       placeholder="{{ __('Password') }}">
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
                                                   name="remember"> {{ __('Remember Me')}}
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div style="margin-left: 60px" class="col-xs-4">
                                    <button style="background-color: #00A65A; " type="submit"
                                            class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="social-auth-links text-center">
                            <p>- OR -</p>
                            <a href="/redirect"
                               class="btn btn-block btn-social btn-facebook btn-flat btn-info">
                                <i class="fab fa-facebook-f"></i>
                                {{__('Sign in using Facebook')}}
                            </a>
                        </div>

                        <div class="auth-links">
                            <a href="{{ route('password.request', app()->getLocale()) }}"
                               class="text-center"
                            >{{ __('Forgot Your Password?')}}</a>
                            <br>
                        </div>
                    </div>
                    <!-- /.login-box-body -->
                </div><!-- /.login-box -->
            </div>
        </div>
    </div>
</div>
    <!--  /.LOGIN MODAL  -->

    <!-- REGISTER MODAL -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header border-bottom-0">
                    <div class="row">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <img style="width: 100%" class="img-responsive" id="login-image"
                         src="{{asset('css/images/Onto4ALL.png')}}" alt="onto4all-logo" srcset="">
                </div>
                <div class="modal-body">
                    <div class="register-box">
                        <div class="register-box-body">
                            <p class="login-box-msg">{{ __('Register') }}</p>
                            <form data-grecaptcha-action="message"
                                  action="{{route('register', app()->getLocale())}}" method="post">
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
                                <button style="background-color: #00A65A;" type="submit"
                                        class="btn btn-primary btn-block btn-flat"
                                >{{ __('Register') }}</button>
                            </form>
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.register-box -->

                </div>
            </div>
        </div>
    </div>

        <!-- /.REGISTER MODAL -->


        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container">
                <div class="small text-center text-muted">Copyright © 2020 - Onto4ALL Editor</div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>
</html>
