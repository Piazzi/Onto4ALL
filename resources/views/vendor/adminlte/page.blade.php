@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <img  style="padding: 0px; border-right: 1px solid #00a65a; border-bottom: 1px solid #d2d6de;"src="{{asset('css/images/LogoMini.png')}}">
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <b>Onto4ALL</b>
                </span>
            </a>
            @if(Route::currentRouteName() !== 'home' && Route::currentRouteName() !== 'thesaurus-editor')
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        @if(Auth::user()->categoria == 'administrador')
                            @php
                                $count = Auth::user()->unreadNotifications->count();
                            @endphp
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-primary">{{$count > 0 ? $count : ''}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have {{$count}} new messages</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            @foreach(Auth::user()->unreadNotifications as $notification)
                                                <li><!-- start message -->
                                                    <a href="{{route('messages.index', app()->getLocale())}}">
                                                        <div class="pull-left">
                                                            <img src="{{asset('css/images/LogoMini.png')}}"
                                                                 class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            Message:
                                                            <small>
                                                                <i class="fa fa-clock-o"></i>{{date("d-m-Y | H:i", strtotime($notification->created_at))}}
                                                            </small>
                                                        </h4>
                                                        <p>{{str_limit($notification->data['data'],20)}}</p>
                                                    </a>
                                                </li>
                                                <!-- end message -->
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="{{route('messages.index', app()->getLocale())}}">See All
                                            Messages</a></li>
                                </ul>
                            </li>
                        @endif
                            <li id="notifications-menu" class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <i class="fa fa-bell-o"></i>
                                    <span id="notification-counter" class="label label-warning"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">{{__('Your notifications')}}</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="notification-menu menu">

                                        </ul>
                                    </li>
                                    <!--<li class="footer"><a href="#">View all</a></li>-->
                                </ul>
                            </li>
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <!-- The user image in the navbar-->
                                    <i class="fa fa-user"></i>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li  class="user-header @if(Route::currentRouteName() == 'thesaurus-editor')  thesauru-box @endif">
                                        <img src="{{asset('css/images/LogoMini.png')}}" class="img-circle"
                                             alt="User Image">
                                        <p>
                                            {{Auth::user()->name}}
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center border-right">
                                                <a class="user-body-link" href="{{route('user.edit', ['user' => Auth::user()->id, 'locale' => app()->getLocale()])}}">{{__('Account Settings')}}</a>
                                            </div>
                                            <div class="col-xs-4 text-center border-right">
                                                <a class="user-body-link" href="{{route('ontologies.index', app()->getLocale())}}">{{__('My Ontologies')}}</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a class="user-body-link" href="{{route('help', app()->getLocale())}}">{{__('Help Menu')}}</a>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">

                                        <div class="pull-left">
                                            <a href="{{route('user.index', app()->getLocale())}}"
                                               class="btn btn-default btn-flat"><i
                                                        class="fa fa-user-plus"></i> Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                                <a class="btn btn-default btn-flat"
                                                   href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                </a>
                                            @else
                                                <a class="btn btn-default btn-flat" href="#"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                >
                                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                </a>
                                                <form id="logout-form"
                                                      action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"
                                                      method="POST" style="display: none;">
                                                    @if(config('adminlte.logout_method'))
                                                        {{ method_field(config('adminlte.logout_method')) }}
                                                    @endif
                                                    {{ csrf_field() }}
                                                </form>
                                            @endif
                                        </div>

                                    </li>
                                </ul>
                            </li>
                            @if(Route::currentRouteName() == 'home')
                                <li>
                                    <a id="control-sidebar" href="#" data-toggle="control-sidebar"><i class="fa fa-1.5x fa-fw fa-exchange "></i></a>
                                </li>
                            @endif
                            @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
                            <!-- Control Sidebar Toggle Button -->
                                <li>
                                    <a href="#" data-toggle="control-sidebar" @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false" @endif>
                                        <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                                    </a>
                                </li>
                            @endif
                    </ul>
                </div>
            </nav>
            @endif
        </header>

    @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar" style="border-right: 1px solid #00a65a !important;">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar" style="height: auto">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu tree" data-widget="tree">
                        <li class="header">{{__('MAIN NAVIGATION')}}</li>
                        <li>
                            <a href="{{route('home', app()->getLocale())}}">
                                <i class="fa fa-fw fa-object-group "></i>
                                <span>{{__('Ontology Editor')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('ontologies.index', app()->getLocale())}}">
                                <i class="fa fa-fw fa-folder-open "></i>
                                <span>{{__('My Ontologies')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('thesaurus-editor', app()->getLocale())}}">
                                <i class="fa fa-fw fa-book "></i>
                                <span>{{__('Thesaurus Editor')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('thesaurus.index', app()->getLocale())}}">
                                <i class="fa fa-fw fa-folder-open "></i>
                                <span>{{__('My Thesaurus')}}</span></a>
                        </li>
                        <li class="header">INFO</li>
                        <li>
                            <a href="{{route('help', app()->getLocale())}}">
                                <i class="fa fa-fw fa-question "></i>
                                <span>{{__('Help Menu')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('tutorial', app()->getLocale())}}">
                                <i class="fa fa-fw fa-info-circle "></i>
                                <span>{{__('Tutorial')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('aboutUs', app()->getLocale())}}">
                                <i class="fa fa-fw fa-institution"></i>
                                <span>{{__('About Us')}}</span></a>
                        </li>
                        @can('eAdmin')
                            <li class="header">ADMIN PANEL</li>
                            <li>
                                <a href="{{route('ontology_relation.index', app()->getLocale())}}">
                                    <i class="fa fa-fw fa-arrow-right "></i>
                                    <span>{{__('Ontological Relations')}}</span></a>
                            </li>
                            <li>
                                <a href="{{route('ontology_class.index', app()->getLocale())}}">
                                    <i class="fa fa-fw fa-circle "></i>
                                    <span>{{__('Ontological Classes')}}</span></a>
                            </li>
                            <li>
                                <a href="{{route('messages.index', app()->getLocale())}}">
                                    <i class="fa fa-fw fa-envelope "></i>
                                    <span>{{__('Messages')}}</span></a>
                            </li>
                            <li>
                                <a href="{{route('admin.index', app()->getLocale())}}">
                                    <i class="fa fa-fw fa-users "></i>
                                    <span>{{__('Users')}}</span></a>
                            </li>
                        @endcan
                        <li class="header">{{__('OPTIONS')}}</li>
                        <li class="treeview">
                            <a style="margin-left: 3px" href="#">
                                <i class="fa fa-language"></i> <span>{{__('Language')}}</span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                    <li>
                                        <a class="nav-link"
                                           href="{{route('home', 'en')}}"
                                           @if (app()->getLocale() == 'en') style="font-weight: bold; text-decoration: underline" @endif>English</a>
                                    </li>
                                <li>
                                    <a class="nav-link"
                                       href="{{route('home', 'pt')}}"
                                       @if (app()->getLocale() == 'pt') style="font-weight: bold; text-decoration: underline" @endif>Português</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a style="margin-left: 3px" href="#">
                                <i class="fa fa-gear"></i> <span>Options</span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="{{route('user.index', ['user' => Auth::user()->id, 'locale' => app()->getLocale()])}}">
                                        <i class="fa fa-user-plus"></i>
                                        <span>{{__('Profile')}}</span>
                                        <span class="pull-right-container"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('user.edit', ['user' => Auth::user()->id, 'locale' => app()->getLocale()])}}">
                                        <i class="fa fa-gears"></i>
                                        <span>{{__('Account Settings')}}</span>
                                        <span class="pull-right-container"></span>
                                    </a>
                                </li>
                                <li>
                                    <!-- Sidebar toggle button-->
                                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                                        <i class="fa fa-fw fa-bars"></i>
                                        <span>{{__('Show/Hide Left Sidebar')}}</span>
                                        <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                                    </a>
                                </li>
                                @if(Route::currentRouteName() === 'home')
                                <li>
                                    <a href="#" data-toggle="control-sidebar">
                                        <i class="fa fa-1.5x fa-fw fa-exchange "></i>
                                        <span>{{__('Show/Hide Right Sidebar')}}</span>
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a class="btn btn-default btn-flat" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                        <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                    </a>
                                    <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"  method="POST" style="display: none;">
                                        @if(config('adminlte.logout_method'))
                                            {{ method_field(config('adminlte.logout_method')) }}
                                        @endif
                                        {{ csrf_field() }}
                                    </form>
                                </li>


                            </ul>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
                @endif

                <!-- Content Header (Page header) -->
                    <section class="content-header">
                        @yield('content_header')
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        @yield('content')

                    </section>
                    <!-- /.content -->
                    @if(config('adminlte.layout') == 'top-nav')
                </div>
                <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->
        @hasSection('footer')
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> Beta 2.5.0
                </div>
                <strong>Copyright © 2018-2021 <a href="https://onto4alleditor.com">Onto4ALL</a>.</strong> All rights
                reserved
                @yield('footer')
            </footer>
        @endif

        @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
            <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        @endif
    </div>
    <!-- ./wrapper -->


@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop

