@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <aside class="control-sidebar control-sidebar-light control-sidebar-open">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class=""><a  data-toggle="tab" aria-expanded="false"><i class="fa fa-fw fa-compass"></i>Tips database</a></li>
            <li class=""><a  data-toggle="modal" data-target="#exampleModal" aria-expanded="false"><i class="fa fa-fw fa-compass"></i>Tips database</a></li>
        </ul>
        <div id="searchBar" class="input-group input-group-sm">
            <input value="" id="search-tip-input" type="text" class="form-control"
                   placeholder="Search for tips">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div id="menu-wrapper">
            <div class="tab-content">
                <div id="menu-scroll">
                    <div id="control-sidebar-theme-demo-options-tab table-search" class="tab-pane active table-search">
                        @foreach($tips_relations as $tips_relation)
                            <div id="tipSearch" class="box box-primary collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{$tips_relation->name}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <dl>
                                        <dt>Description</dt>
                                        <dd>{{$tips_relation->description}}</dd>
                                        <dt>Domain</dt>
                                        <dd>{{$tips_relation->domain}}</dd>
                                        <dt>Range</dt>
                                        <dd>{{$tips_relation->range}}</dd>
                                        <dt>Example Of Usage</dt>
                                        <dd>{{$tips_relation->example_of_usage}}</dd>
                                        <dt>Imported From</dt>
                                        <dd>
                                            <a href="{{$tips_relation->imported_from}}">{{$tips_relation->imported_from}}</a>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($tips_class as $tip_class)
                            <div id="tipSearch" class="box box-success collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{$tip_class->name}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <dl>
                                        <dt>Description</dt>
                                        <dd>{{$tip_class->description}}</dd>
                                        <dt>SuperClass</dt>
                                        <dd>{{$tip_class->superclass}}</dd>
                                        <dt>Synomyms</dt>
                                        <dd>{{$tip_class->synonyms}}</dd>
                                        <dt>Example Of Usage</dt>
                                        <dd>{{$tip_class->example_of_usage}}</dd>
                                        <dt>Imported From</dt>
                                        <dd>
                                            <a href="{{$tip_class->imported_from}}">{{$tips_relation->imported_from}}</a>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- /.tips menu -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop
