@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Messages
        <small>See all the messages you received from users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Messages</li>
    </ol>

    @if (session()->has('Success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <strong>{{ session('Success') }}</strong>
        </div>
    @endif

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Inbox</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <form style="float: right;" method="post" action="{{route('messages.search', ['search' => 'search', 'locale' => app()->getLocale()])}}">
                        @csrf
                        @method('POST')
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input  id="table-search-input" type="text" name="search"
                                        class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="mailbox-controls">

                <a href="{{route('messages.index', app()->getLocale())}}" ><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
                <div class="pull-right">
                    <div class="btn-group">

                    </div>
                    <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
            </div>
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">

                    <thead>
                    <tr>
                        <td></td>
                        <td>Seen</td>
                        <td>From</td>
                        <td>Message</td>
                        <td>View</td>
                        <td>Date</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                    <tr id="table-search tr">
                        <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                        <td class="mailbox-star">
                            @if($message->read)
                            <i class="fa fa-eye"></i>
                            @endif
                        </td>
                        <td class="mailbox-name"><a href="{{route('messages.show', ['message' => $message->id, 'locale' => app()->getLocale()])}}">{{$message->name}}</a></td>
                        <td class="mailbox-subject">
                            @if($message->category == 'bug')
                            <b>Onto4ALL Bug Report

                            </b> - " {{str_limit($message->message, 30)}} "
                            @elseif($message->category == 'suggestion')
                                <b>Onto4ALL Suggestion

                                </b> - " {{str_limit($message->message, 30)}} "
                            @elseif($message->category == 'question')
                                <b>Onto4ALL Question

                                </b> - " {{str_limit($message->message, 30)}} "
                            @else
                                <b>Onto4ALL Other

                                </b> - " {{str_limit($message->message, 30)}} "
                            @endif
                        </td>
                        <td class="mailbox-attachment"><a href="{{route('messages.show', ['message' => $message->id, 'locale' => app()->getLocale()])}}"><i class="fa fa-envelope-o"></i></a></td>
                        <td class="mailbox-date">{{date("d-m-Y | H:i e", strtotime($message->created_at))}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
            <div class="mailbox-controls">

                <a href="{{route('messages.index', app()->getLocale())}}" ><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
                <div class="pull-right">

                    <div class="btn-group">
                        <ul class="pagination pagination-sm no-margin ">
                            {{ $messages->links() }}
                        </ul>
                    </div>
                    <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
            </div>
        </div>
    </div>

    <!-- Filter -->
    <script type="text/javascript" src="{{asset('js/SearchBar.js')}}"></script>

@stop

@section('footer')
    .
@stop