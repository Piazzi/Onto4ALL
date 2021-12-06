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
            <a class="logo" style="background-color: #222d32;">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <img  style="padding: 0px; "src="{{asset('css/images/ontoowl.png')}}">
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <b>Onto4ALL</b>
                </span>
            </a>
            @if(Route::currentRouteName() !== 'thesaurus-editor')
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <!-- <div class="navbar-custom-menu"> -->
                @if(Route::currentRouteName() == 'home')
                    <ul class="nav navbar-nav" style="font-size: 16px;">
                        <li class="ontology-name">
                            <i style="color: white;" class="fa fa-fw fa-tag"></i>
                            <input onKeyPress="saveName(event)" id="name-input" title="Rename the Ontology" placeholder="{{__('Untitled Ontology')}}"  spellcheck="false" type="text" autocomplete="off" value="{{__('Untitled Ontology')}}" tabindex="0" style="visibility: visible; width: 155px;">
                        </li>
                        
                        <li>
                            <a title="Ontology Manager" href="#" id="open-ontology" class="geItem" data-toggle="modal" data-target="#ontology-manager">
                                <i class="fa fa-fw fa-folder-open-o"></i>
                            </a>
                        </li>
                        <li>
                            <a title="Edit Ontology" href="#" id="edit-ontology" class="geItem" data-toggle="modal" data-target="#edit-ontology-modal">
                                <i class="fa fa-fw  fa-edit"></i>
                            </a>
                        </li>
                        <li class="favorite-ontology">
                            <a onclick="favoriteOntology()" value="0" title="Favorite ontology" href="#" id="favorite-ontology" class="geItem"></a>
                        </li>
                        <li>
                            <div class="autosave">
                                <input type="checkbox" id="switch" /><label for="switch"></label> <h5> {{__('Autosave')}} </h5>
                            </div>
                        </li>
                        <li>
                            <a id="save-ontology" class=" btn btn-default unsaved">
                                <i class="fa fa-fw fa-cloud-upload"></i> {{__('Unsaved changes. Click here to save')}}
                            </a>
                        </li>
                        <li style="font-size: 14px;" id="last-update"></li>
                    </ul>
                @endif
                <!-- </div> -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        @php
                            $amount = Auth::user()->unreadNotifications->count();
                        @endphp
                        <li id="notifications-menu" class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-bell-o"></i>
                                <span id="notification-counter" class="label label-warning">{{$amount > 0 ? $amount : ''}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">{{__('You have')}} {{$amount}} {{__('new notifications')}}</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="notification-menu menu" >
                                    @foreach(Auth::user()->notifications->take(5) as $notification)
                                        <li><!-- start Notification -->
                                            <a href="{{route('notifications.show', ['locale' => app()->getLocale(), 'notificationId' => $notification->id, 'notificationType' => $notification->data['type']])}}">
                                            <h5>
                                                @if($notification->data['type'] == 'Onto4All Contact')
                                                    {{__('New message: ')}}
                                                @endif        
                                                    {{__($notification->data['title'])}}
                                                <br>
                                                    <small>
                                                        <i class="fa fa-clock-o"><i> | </i></i>{{ date(" d-m-Y | H:i", strtotime($notification->created_at))}}
                                                    </small>
                                            </h5>
                                            </a>
                                        </li>
                                    @endforeach
                                    </ul>
                                </li>
                                <li class="footer"><a href="{{route('notifications.index', app()->getLocale())}}">{{__('See all notifications')}}</a></li>
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
                                    <li style="background-color: #222d32;"  class="user-header @if(Route::currentRouteName() == 'thesaurus-editor')  thesauru-box @endif">
                                        <img src="{{asset('css/images/LogoDark.png')}}" class="img-circle"
                                             alt="User Image">
                                        <p>
                                            {{Auth::user()->name}}
                                            <small>{{Auth::user()->email}}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center border-right">
                                                <a class="user-body-link" href="{{route('user.edit', ['user' => Auth::user()->id, 'locale' => app()->getLocale()])}}"> Tutorial</a>
                                            </div>
                                            <div class="col-xs-4 text-center border-right">
                                                <a class="user-body-link" href="{{route('ontologies.index', app()->getLocale())}}">{{__('Ontologies')}}</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a class="user-body-link" href="{{route('help', app()->getLocale())}}">{{__('Help')}}</a>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">

                                        <div class="pull-left">
                                            <a href="{{route('user.edit', ['user' => Auth::user()->id, 'locale' => app()->getLocale()])}}" class="btn btn-default btn-flat">
                                               <i class="fa fa-cog"></i> {{__('Account Settings')}}
                                            </a>
                                        </div>
                                        <div class="pull-right">
                                            <a class="btn btn-default btn-flat" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-fw fa-power-off"></i> {{__('Log Out') }}
                                            </a>
                                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                @csrf
                                                @if(config('adminlte.logout_method'))
                                                    {{ method_field(config('adminlte.logout_method')) }}
                                                @endif
                                            </form>
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
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar" style="height: auto">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu tree" data-widget="tree">
                        <li class="header">{{__('ONTOLOGIES')}}</li>
                        <li  @if(Route::currentRouteName() == 'home') class="active" @endif >
                            <a title="{{__('Ontology Editor')}}" href="{{route('home', app()->getLocale())}}">
                                <i class="fa fa-fw fa-object-group "></i>
                                <span>{{__('Ontology Editor')}}</span></a>
                        </li>
                        <li  @if(Route::currentRouteName() == 'ontologies.index') class="active" @endif  >
                            <a title="{{__('My Ontologies')}}" href="{{route('ontologies.index', app()->getLocale())}}">
                                <i class="fa fa-fw  fa-file-code-o "></i>
                                <span>{{__('My Ontologies')}}</span></a>
                        </li>
                        <li class="header">{{__('THESAURUS')}}</li>
                        <li @if(Route::currentRouteName() == 'thesaurus-editor') class="active" @endif>
                            <a title="{{__('Thesaurus Editor')}}" href="{{route('thesaurus-editor', app()->getLocale())}}">
                                <i class="fa fa-fw fa-book " ></i>
                                <span>{{__('Thesaurus Editor')}}</span></a>
                        </li>
                        <li @if(Route::currentRouteName() == 'thesaurus.index') class="active" @endif>
                            <a title="{{__('My Thesaurus')}}" href="{{route('thesaurus.index', app()->getLocale())}}">
                                <i class="fa fa-fw fa-bookmark"></i>
                                <span>{{__('My Thesaurus')}}</span></a>
                        </li>
                        <li class="header">{{__('INFO')}}</li>
                        <li @if(Route::currentRouteName() == 'help') class="active" @endif>
                            <a title="{{__('Help')}}" href="{{route('help', app()->getLocale())}}">
                                <i class="fa fa-fw fa-question " ></i>
                                <span>{{__('Help')}}</span></a>
                        </li>
                        <li @if(Route::currentRouteName() == 'tutorial') class="active" @endif>
                            <a title="{{__('Tutorial')}}" target="_blank" href="{{route('tutorial', app()->getLocale())}}">
                                <i class="fa fa-fw fa-info-circle "></i>
                                <span>{{__('Tutorial')}}</span></a>
                        </li>
                        @can('eAdmin')
                            <li class="header">{{__('ADMIN PANEL')}}</li>
                            <li @if(Route::currentRouteName() == 'ontology_relation.index') class="active" @endif>
                                <a title="{{__('Ontological Relations')}}" href="{{route('ontology_relation.index', app()->getLocale())}}">
                                    <i class="fa fa-fw fa-arrow-right "></i>
                                    <span>{{__('Ontological Relations')}}</span></a>
                            </li>
                            <li @if(Route::currentRouteName() == 'ontology_class.index') class="active" @endif>
                                <a title="{{__('Ontological Classes')}}" href="{{route('ontology_class.index', app()->getLocale())}}">
                                    <i class="fa fa-fw fa-circle "></i>
                                    <span>{{__('Ontological Classes')}}</span></a>
                            </li>
                            
                            <li @if(Route::currentRouteName() == 'admin.index') class="active" @endif>
                                <a title="{{__('Users')}}" href="{{route('admin.index', app()->getLocale())}}">
                                    <i class="fa fa-fw fa-users "></i>
                                    <span>{{__('Users')}}</span></a>
                            </li>
                        @endcan
                        <li class="header">{{__('OPTIONS')}}</li>
                        <li class="treeview">
                            <a title="{{__('Language')}}" style="margin-left: 3px" href="#">
                                <i class="fa fa-language"></i> <span>{{__('Language')}}</span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                    <li>
                                        <a class="nav-link"
                                           href="{{route('home', 'en')}}"
                                           @if (app()->getLocale() == 'en') style="font-weight: bold; text-decoration: underline" @endif>{{__('English')}}</a>
                                    </li>
                                <li>
                                    <a class="nav-link"
                                       href="{{route('home', 'pt')}}"
                                       @if (app()->getLocale() == 'pt') style="font-weight: bold; text-decoration: underline" @endif>{{__('Portuguese')}}</a>
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
                    <b>Version</b> Beta 4.0.1
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

