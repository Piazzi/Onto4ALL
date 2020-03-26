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
            @if(config('adminlte.layout') == 'top-nav')
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    @else
                        <!-- Logo -->
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                                <!-- mini logo for sidebar mini 50x50 pixels -->
                                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                                <!-- logo for regular state and mobile devices -->
                                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                            </a>

                            <!-- Header Navbar -->
                            <nav class="navbar navbar-static-top" role="navigation">
                                <!-- Sidebar toggle button-->
                                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                                </a>
                            @endif
                            <!-- Navbar Right Menu -->
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
                                                                    <a href="{{route('messages.index')}}">
                                                                        <div class="pull-left">
                                                                            <img src="css/images/profile.jpeg"
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
                                                    <li class="footer"><a href="{{route('messages.index')}}">See All
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
                                                <li class="header">Your notifications</li>
                                                <li>
                                                    <!-- inner menu: contains the actual data -->
                                                    <ul class="notification-menu menu">

                                                    </ul>
                                                </li>
                                                <li class="footer"><a href="#">View all</a></li>
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
                                                <li class="user-header">
                                                    <img src="css/images/profile.jpeg" class="img-circle"
                                                         alt="User Image">
                                                    <p>
                                                        {{Auth::user()->name}}
                                                        <small>Member since {{Auth::user()->created_at}}</small>
                                                    </p>
                                                </li>
                                                <!-- Menu Body -->
                                                <li class="user-body">
                                                    <div class="row">
                                                        <div class="col-xs-4 text-center border-right">
                                                            <a class="user-body-link" href="{{route('profile.edit', Auth::user()->id)}}">Account
                                                                Settings</a>
                                                        </div>
                                                        <div class="col-xs-4 text-center border-right">
                                                            <a class="user-body-link" href="{{route('ontologies.index')}}">Your Ontologies</a>
                                                        </div>
                                                        <div class="col-xs-4 text-center">
                                                            <a class="user-body-link" href="{{route('help')}}">Help Menu</a>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </li>
                                                <!-- Menu Footer-->
                                                <li class="user-footer">
                                                    <div class="pull-left">
                                                        <a href="{{route('profile.index')}}"
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
                                                <a id="control-sidebar" href="#" data-toggle="control-sidebar"> <i class="fa fa-th"></i></a>
                                            </li>
                                            <li>
                                                <a id="night-mode" href="#"><i class="fa fa-fw fa-moon-o"></i><span class="label label-warning">Beta</span></a>
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
                            @if(config('adminlte.layout') == 'top-nav')
                    </div>
                    @endif
                </nav>
        </header>

    @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                    <!-- /.sidebar-menu -->
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
                    <b>Version</b> 1.1
                </div>
                <strong>Copyright © 2018-2020 <a href="https://onto4alleditor.com">Onto4ALL</a>.</strong> All rights
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

