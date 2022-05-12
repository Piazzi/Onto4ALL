@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        {{__('Profile')}}
        <small>{{__('Your Onto4ALL profile')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">{{__('Profile')}}</li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-success">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/img/profile/' . Auth::user()->avatar_url) }}"
                         alt="User profile picture">

                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">{{$user->email}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>{{__('Member since')}}</b> <a class="pull-right">{{$user->created_at}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('Saved Ontologies')}}</b> <a class="pull-right">{{$count}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('Category')}}</b> <a class="pull-right">{{$user->categoria}}</a>
                        </li>
                    </ul>

                    <a href="{{route('user.edit', ['locale'=> app()->getLocale(), 'user'=> auth()->user()->id])}}" class="btn btn-success btn-block"><b>{{__('Account Settings')}}</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Your recent Ontologies')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @foreach($ontologies as $ontology)
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> {{$ontology->name}}</strong>

                        <p>{{$ontology->created_at}}</p>
                    @endforeach
                </div>
                <a href="{{route('ontologies.index', app()->getLocale())}}" class="btn btn-success btn-block"><b>{{__('All my Ontologies')}}</b></a>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="callout callout-success">
                <h4><strong>{{__('Your favourite ontologies')}}</strong></h4>
            </div>
            <ul class="timeline">
                <!-- timeline time label -->
                @foreach($favouriteOntologies as $ontology)
                <li class="time-label">
                  <span class="bg-blue">
                    {{$ontology->created_at}}
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-fw fa-object-group bg-green "></i>

                    <div class="timeline-item">
                        <span class="time"><strong>{{__('Publication Date:  ')}}<i class="fa fa-clock-o"></i> {{$ontology->publication_date}}</strong></span>
                        <span class="time"><strong>{{__('Last Upload:  ')}}<i class="fa fa-clock-o"></i> {{$ontology->last_uploaded}}</strong></span>

                        <h3 class="timeline-header"><a href="#">{{$ontology->name}}</a> </h3>

                        <div class="timeline-body">
                            {{$ontology->description}}
                        </div>
                        <div class="timeline-footer">
                            <a  class="btn btn-success btn-sm">{{$ontology->created_by}}</a>
                            <a href="/ontologies/download/{{$user->id}}/{{$ontology->id}}" class="btn btn-info btn-file btn-sm ">
                                <i class="fa fa-fw fa-file-code-o"></i> {{__('Download')}}
                            </a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                @endforeach
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>
@stop

@section('footer')
    .
@stop