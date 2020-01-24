@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Message
        <small>See the message you received</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Messages</li>
    </ol>

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Read Message</h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="mailbox-read-info">
                <h3>@if($message->category == 'bug')
                        Onto4ALL Bug Report
                    @elseif($message->category == 'suggestion')
                        Onto4ALL Suggestion
                    @elseif($message->category == 'question')
                        Onto4ALL Question
                    @else
                       Onto4ALL Other
                    @endif</h3>
                <h5>From: {{$message->email}}
                    <span class="mailbox-read-time pull-right">{{date("d-m-Y | H:i e", strtotime($message->created_at))}}</span></h5>
            </div>
            <!-- /.mailbox-read-info -->
            <div class="mailbox-controls with-border text-center">
                <div class="btn-group">

                </div>
                <!-- /.btn-group -->

            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                <p>{{$message->message}}</p>
            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <form action="{{route('messages.destroy', $message->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                </form>
            </div>
            <a href="{{route('messages.index')}}"><button  type="button" class="btn btn-default"><i class="fa fa-reply"></i> Go back</button></a>
        </div>
        <!-- /.box-footer -->
    </div>

@stop

@section('footer')
    .
@stop