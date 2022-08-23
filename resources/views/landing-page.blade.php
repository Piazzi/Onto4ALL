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
        
        <!-- AdminLTE CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
	    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">

        
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
        <link rel="shortcut icon" href="css/images/favicon.ico" />

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
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#credits">{{__('Credits')}}</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('login', app()->getLocale())}}">Login</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('register', app()->getLocale())}}">{{__('Register')}}</a></li>
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
                    <hr class="divider light my-4"/>
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
                    <img class="img-fluid" src="css/images/LogoGreen.png">
                    <hr class="divider light my-4"/>
                    <h2 class="text-white mt-0">{{__('What is the Onto4ALL Editor?')}}</h2>
                    <hr class="divider light my-4"/>
                    <p class="text-white mb-4">{{__('Is a free graphical editor capable of creating, editing and exporting ontologies being guided by an warnings console, an ontological building rules tab and an extensive palette of ontological classes and relationships.')}}</p>
                    <a href="{{route('register', app()->getLocale())}}" class="btn btn-light btn-xl js-scroll-trigger">{{__('Start Now')}}</a>
                    <a style="margin-left: 10px" class="btn btn-light btn-xl js-scroll-trigger" href="#features"
                    >{{__('See More')}}</a>
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
                        <p class="text-muted mb-0">{{__('Draw any ontology you want, the way you want')}}</p>
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

            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-tasks text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{__('Class Expression Editor')}}</h3>
                        <p class="text-muted mb-0">{{__('Write correct axioms for classes with the help of this feature')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-user-friends text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{__('User Friendly')}}</h3>
                        <p class="text-muted mb-0">{{__('We aim to make the Onto4ALL a platform for everyone to learn ontology, from begginers to researchers in the area')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-book text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{__('Thesaurus Editor')}}</h3>
                        <p class="text-muted mb-0">{{__('Onto4ALL have a simple thesaurus editor as well')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-info text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{__('Tips Menu')}}</h3>
                        <p class="text-muted mb-0">{{__('Get the information you need about BFO, IAO and IOF ontologies')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio section -->
    <section id="portfolio">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="css/images/Landing-Page/OurEditor.PNG"
                    ><img class="img-fluid" src="css/images/Landing-Page/OurEditor.PNG" alt=""/>
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50"></div>
                            <div class="project-name">{{__('Our Editor')}}</div>
                        </div>
                    </a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="css/images/Landing-Page/OntologyManager.PNG"
                    ><img class="img-fluid" src="css/images/Landing-Page/OntologyManager.PNG" alt=""/>
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50"></div>
                            <div class="project-name">{{__('The Ontology Manager')}}</div>
                        </div>
                    </a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="css/images/Landing-Page/OpenWithOneClick.PNG"
                    ><img class="img-fluid" src="css/images/Landing-Page/OpenWithOneClick.PNG" alt=""/>
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50"></div>
                            <div class="project-name">{{__('Open your ontologies with one click')}}</div>
                        </div>
                    </a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="css/images/Landing-Page/WarningsConsole.PNG"
                    ><img class="img-fluid" src="css/images/Landing-Page/WarningsConsole.PNG" alt=""/>
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50"></div>
                            <div class="project-name">{{__('Our warning console will help you out')}}</div>
                        </div>
                    </a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="css/images/Landing-Page/TipsMenu.PNG"
                    ><img class="img-fluid" src="css/images/Landing-Page/TipsMenu.PNG" alt=""/>
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50"></div>
                            <div class="project-name">{{__('Get the information you need with the tips menu')}}</div>
                        </div>
                    </a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="css/images/Landing-Page/MethodologyMenu.PNG"
                    ><img class="img-fluid" src="css/images/Landing-Page/MethodologyMenu.PNG" alt=""/>
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
        <section style="background-color: #064c72 !important;" class="page-section bg-dark text-white">
            <div class="container text-center">
                <h2 class="mb-4"><i class="fa fa-fw fa-graduation-cap"></i>
                    {{ __('Papers we published so far') }} </h2>
                <div class="row" style="text-align: left;     text-align-last: center;            ">
                    <div class="col-md-3">
                        <p class="text-white mb-4">MENDONÇA, F. M.; CASTRO, L. P. . OntoForInfoScience e
                            Onto4ALLEditor: metodologia e editor de ontologias como facilitadores na construção de
                            ontologias por especialistas do domínio e cientistas da informação. Fronteiras da
                            Representação do Conhecimento (online), v. 1, p. 145-173, 2021.
                        </p><br />
                        <a class="btn btn-light btn-xl js-scroll-trigger" href="#">{{ __('Read More') }}</a>
                    </div>
                    <div class="col-md-3">
                        <p class="text-white mb-4"> MENDONÇA, F. M.; EMYGDIO, J. L. ; CASTRO, L. P. ; FELIPE, E. R. .
                            Onto4ALLEditor: a Graphic Web Ontology Editor for Information Science. Fronteiras da
                            Representação do Conhecimento (online), v. 1, p. 70-94, 2021.
                        </p><br />
                        <a class="btn btn-light btn-xl js-scroll-trigger" href="#">{{ __('Read More') }}</a>
                    </div>
                    <div class="col-md-3">
                        <p class="text-white mb-4"> MENDONÇA, F. M.; CASTRO, L. P. ; SOUZA, J. F. ; ALMEIDA, M. B. ;
                            FELIPE, E. R. . Onto4AllEditor: um editor web gráfico para construção de ontologias por
                            todos os tipos de usuários da informação. EM QUESTÃO, v. 27, p. 401-430, 2021.
                        </p> <br />
                        <a class="btn btn-light btn-xl js-scroll-trigger" href="#">{{ __('Read More') }}</a>
                    </div>
                    <div class="col-md-3">
                        <p class="text-white mb-4"> MENDONÇA, F. M.; CASTRO, L. P. ; SOUZA, JAIRO ; ALMEIDA, M. B. ;
                            FELIPE, E. R. . (Onto4AllEditor: A Graphical Web Ontology Editor
                            Oriented Different Types of Ontology Developers). In: XIII Seminar on Ontology Research in
                            Brazil (ONTOBRAS 2020), 2020, Vitória - ES. Proceedings of the XIII Seminar on Ontology
                            Research in Brazil, 2020. v. 1. p. 104-119.
                            <br />
                        </p> <a class="btn btn-light btn-xl js-scroll-trigger" href="#">{{ __('Read More') }}</a>
                    </div>

                </div>


            </div>
        </section>

         <!-- Map section -->
         <section class="page-section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0"><i class="fa fa-fw fa-university"></i> {{ __('Universities using our editor') }}</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">

                        <iframe style="width: 100%" src="https://www.google.com/maps/d/u/0/embed?mid=1TX4eDRAqpiIvprZjS_k1y0Xz3oFdGj-y&ehbc=2E312F" width="640" height="480"></iframe>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            <h3 class="box-title">{{__('We have many users across the globe, mainly in universities. In special:')}} </h3>
                            </div>

                            <div class="box-body">
                            <ul>
                            <li>{{__("Master's classes at Universidade Federal de Juiz de Fora (UFJF)")}}</li>
                            <li>{{__("Master's classes at Universidade Federal do Paraná (UFPR)")}}</li>
                            <li>{{__("Master's classes at Universidade Federal do Espirito Santo (UFES)")}}</li>
                            <li>{{__("Master's classes at Universidade Federal de Minas Gerais (UFMG)")}}</li>
                            </ul>
                            </div>

                            </div>
                    </div>

                </div>
            </div>
        </section>

    <!-- Call to action section-->
    <section style="background-color: #064c72 !important;" class="page-section bg-dark text-white">
        <div class="container text-center">
            <h2 class="mb-4">{{__('Start Drawing Your Ontologies')}}</h2>
            <a style="color: black" class="btn btn-light btn-xl" href="{{route('login', app()->getLocale())}}">{{__('Register Now!')}}</a>
        </div>
    </section>

    <!-- Contact section -->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">{{__('Have Any Question?')}}</h2>
                    <hr class="divider my-4"/>
                    <p class=" mb-5">{{__('Contact Us')}}</p>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6 mr-auto text-center">
                    <i style="color:#064c72"class="fas fa-envelope fa-3x mb-3 "></i>
                    <a class="d-block">info@onto4alleditor.com</a>
                </div>
                
                <div class="col-lg-6 mr-auto text-center">
                    <div class="col-lg-12 mr-auto text-center">
                        <i style="color:#064c72" class="fab fa-linkedin fa-3x mb-3"></i>
                        <a style="color:#000000" href="https://www.linkedin.com/company/onto4all/" class="d-block" target="_blank"> Onto4ALL </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Credits section-->
    <section id="credits" class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{__('Onto4ALL was built with')}}</h2>
            <hr class="divider my-4"/>
            <div class="row">
                <div class="col-lg-4  text-center">
                    <div class="mt-5">
                        <img style="width: 90%" alt="laravel" src="css/images/Landing-Page/laravel.png">

                    </div>
                </div>
                <div class="col-lg-4  text-center">
                    <div class="mt-5">
                        <img alt="mxgraph" src="css/images/Landing-Page/mxgraph.png">
                    </div>
                </div>
                <div class="col-lg-4  text-center">
                    <div class="mt-5">
                        <img style="width: 90%" alt="jquery" src="css/images/Landing-Page/adminlte.png">

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
                <div class="col-md-6 text-center">
                    <div class="mt-5">
                    <img style="width: 70%" alt="logo-ufjf" src="css/images/Landing-Page/ufjf.png">
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="mt-5">
                    <img style="width: 80%" alt="logo-recol" src="css/images/Landing-Page/logo-recol.png">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="mt-5">
                    <img alt="logo-lapic" src="css/images/Landing-Page/logo-lapic.jpg">
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="mt-5">
                    <img style="width: 90%" alt="logo-repesq" src="css/images/Landing-Page/logo-repesq.png">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright © 2022 - Onto4ALL Editor</div>
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
