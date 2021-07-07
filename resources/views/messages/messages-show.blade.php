@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        {{__('Message')}}
        <small>{{__('See the message you received')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>{{__('Home')}}</a></li>
        <li class="active"><a href="{{route('notifications.index', app()->getLocale())}}"><i class="fa fa-bell"></i>{{__('Notifications')}}</a></li>
        <li class="active">{{__('Message')}}</li>
    </ol>

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Read Message')}}</h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="mailbox-read-info">
                <h3>@if($notification->data['title'] == 'bug')
                        {{__('Onto4All Bug Report')}}
                    @elseif($notification->data['title'] == 'suggestion')
                        {{__('Onto4All Suggestion')}}
                    @elseif($notification->data['title'] == 'question')
                        {{__('Onto4All Question')}}
                    @else
                       {{__('Onto4All Other')}}
                    @endif</h3>
                <h5>
                    {{__('From: ')}}
                    {{$notification->data['from']}}
                    <span class="mailbox-read-time pull-right">{{date("d-m-Y | H:i e", strtotime($notification->created_at))}}</span></h5>
            </div>
            <!-- /.mailbox-read-info -->
            <div class="mailbox-controls with-border text-center">
                <div class="btn-group">

                </div>
                <!-- /.btn-group -->

            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                <p>{{__($notification->data['message'])}}</p>
            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="{{route('notifications.index', app()->getLocale())}}"><button  type="button" class="btn btn-default"><i class="fa fa-reply"></i>{{__(' Go back')}}</button></a>
        </div>
        <!-- /.box-footer -->
    </div>

@stop

@section('footer')
    .
@stop