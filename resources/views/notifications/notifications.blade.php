@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        {{__('Notifications')}}
        <small>{{__('See all the notifications')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>{{__('Home')}}</a></li>
        <li class="active">{{__('Notifications')}}</li>
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
            <h3 class="box-title">{{__('New Notifications')}}</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="mailbox-controls">
                <a href="{{route('notifications.index', app()->getLocale())}}" ><button title="{{__('Update notifications page')}}" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
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
                        <td>{{__('Seen')}}</td>
                        <td>{{__('Title')}}</td>
                        <td>{{__('Message')}}</td>
                        <td>{{__('Date')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notifications as $notification)
                    <tr id="table-search tr">
                        <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                        <td class="mailbox-star">
                            @if($notification->read_at)
                                <i class="fa fa-eye" style="color: #acacac"></i>
                            @else
                                <i class="fa fa-eye"></i>
                            @endif
                        </td>
                        <td class="mailbox-subject">{{__($notification->data['title'])}}</td>
                        <td class="mailbox-subject">{{__($notification->data['message'])}}</td>
                        <td class="mailbox-date">{{date("d-m-Y | H:i e", strtotime($notification->created_at))}}</td>
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
            <div class="mailbox-controls"></div>
        </div>
        </div>
    </div>

    <!-- Filter -->
    <script type="text/javascript" src="{{asset('js/SearchBar.js')}}"></script>

@stop

@section('footer')
    .
@stop