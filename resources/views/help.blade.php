@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        {{__('Help Menu')}}
        <small>{{__('Find all the information you need')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">{{__('Help Menu')}}</li>
    </ol>

    @if (session()->has('Success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <strong>{{ session('Success') }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Tutorial</h3>
                    <p>{{__('Learn how to use our editor')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                <a href="{{route('tutorial', app()->getLocale())}}" class="small-box-footer">
                    {{__('More Info')}} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{__('Contact Us')}}</h3>

                    <p>{{__('Report a bug, make a suggestion or ask a question.')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>
                <a data-target="#contactUs" data-toggle="modal" aria-expanded="false" href="#" class="small-box-footer">
                    {{__('More Info')}} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{__('Account Settings')}}</h3>

                    <p>{{__('Manage your account.')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-settings"></i>
                </div>
                <a href="/profile/{{Auth::user()->id}}/edit" class="small-box-footer">
                    {{__('More info')}} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{__('About Us')}}</h3>

                    <p>{{__('Who is behind the project')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{route('aboutUs', app()->getLocale())}}" class="small-box-footer">
                    {{__('More info')}} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{__('Warnings Index')}}</h3>

                    <p>{{__('See all the warnings tracked by our console on the editor')}} </p>
                </div>
                <div class="icon">
                    <i class="ion ion-gear-a"></i>
                </div>
                <a href="{{route('warningIndex', app()->getLocale())}}" class="small-box-footer">
                    {{__('More info')}} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{__('Donate')}}</h3>

                    <p>{{__('Help this project by donating a small amount via paypal')}}  </p>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a class="small-box-footer">
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="WE94D2BSERZNN" />
                        <input style="display: block;margin-left: auto;margin-right: auto;" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                        <img alt="" border="0" src="https://www.paypal.com/en_BR/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                </a>
            </div>
        </div>
    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">FAQ</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-success">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                {{__('What is the Onto4ALL Editor?')}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="box-body">
                           {{__('Is a free graphical editor capable of creating, editing and exporting ontologies being guided by an warnings console, an ontological building rules tab and an extensive palette of ontological classes and relationships.')}}
                        </div>
                    </div>
                </div>
                <div class="panel box box-success">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                {{__('Is it being updated?')}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">
                            {{__('Yes, we are updating the editor frequently and developing new features. Please contact us by email if you have any suggestions.')}}
                        </div>
                    </div>
                </div>
                <div class="panel box box-success">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                {{__('What is the main public of the editor?')}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
                            {{__('We aim to reach all types of audiences. From students learning what an ontology is to professionals in the field.')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="tab modal fade" id="contactUs"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>{{__('Contact Form')}}</strong></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('messages.store', app()->getLocale())}}">
                    <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label>{{__('Why are you contacting us for? Select a option.')}}</label>
                                <select name="category" class="form-control">
                                    <option value="suggestion">{{__('Make a Suggestion')}}</option>
                                    <option value="bug">{{__('Report a Bug')}}</option>
                                    <option value="question">{{__('Ask a Question')}}</option>
                                    <option value="other">{{__('Other')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{__('Message')}}</label>
                                <textarea name="message" class="form-control" rows="3" placeholder="{{__('Enter your message here. We will answer as soon as possible')}}"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop

@section('footer')
    .
@stop