@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        {{__('Ontology Manager')}}
        <small>{{__('Manage all your ontologies')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">{{__('Ontology Manager')}}</li>
    </ol>
    @if (session()->has('Sucess'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <strong>{{ session('Sucess') }}</strong>
        </div>
    @endif

    @if (session()->has('Error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <strong>{{ session('Error') }}</strong>
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

    <div style="margin-bottom: 10px" class="input-group input-group-sm">
        <input id="table-search-input" type="text" name="table_search"
               class="form-control pull-right" placeholder="{{__('Search')}}">
        <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
            </button>
        </div>
    </div>

    <div class="box box-warning">
        <div class="box-header with-border">
            <h1 class="box-title"><i style="color: #62a0bb" class="fa fa-fw fa-star"></i> {{__('Your favourite ontologies:')}} </h1>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <p style="margin-top: 10px; border-radius: 10px; padding: 5px; "><i class="fa fa-fw fa-info"></i>{{__('You can mark up to 5 ontologies as favourite. They will be here')}} </p>

            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Updated At')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('XML File')}}</th>
                            <th>{{__('OWL File')}}</th>
                            <th>{{__('Details')}}</th>
                            <th>{{__('Edit')}}</th>
                            <th>{{__('Favourite')}}</th>
                            <th>{{__('Delete')}}</th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($favouriteOntologies as $ontology)
                            <tr>

                                <td style="font-size: medium">{{$ontology->name}}</td>
                                <td>{{date("d-m-Y | H:i e", strtotime($ontology->updated_at))}}</td>
                                <td>
                                    @php
                                        $Description = str_limit($ontology->description, 20);
                                    @endphp
                                    {{$Description}}
                                </td>
                                <td>
                                    <a href="{{route('ontologies.download', ['locale' => app()->getLocale() ,'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('ontologies.downloadOWL', ['locale' => app()->getLocale() , 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                                        </button>
                                    </a>
                                </td>
                                <td><a href="{{route('ontologies.show', ['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-plus"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('ontologies.edit',['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST"
                                          action="{{route('ontologies.normal', ['locale' => app()->getLocale() , 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-default"><i style="color: #f39c12"
                                                                                         class="fa fa-fw fa-star"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post"
                                          action="{{route('ontologies.destroy', ['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i
                                                    class="fa fa-fw fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box box-success">
        <div class="box-header with-border">
            <h1 class="box-title"><i style="color: #62a0bb" class="fa fa-fw fa-object-group "></i> {{__('Your ontologies:')}} </h1>


            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <p style="margin-top: 10px; border-radius: 10px; padding: 5px; "><i class="fa fa-fw fa-warning"></i> {{__('Attention: Only your last 10 ontologies were saved in our editor, if you exceed this limit, your oldest ontology will be deleted. If you want to avoid this, mark your ontology as a favorite, so that it will not be deleted. You can select up to 5 ontologies as favorites.')}}</p>

            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Updated at')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('XML File')}}</th>
                            <th>{{__('OWL File')}}</th>
                            <th>{{__('Details')}}</th>
                            <th>{{__('Edit')}}</th>
                            <th>{{__('Favourite')}}</th>
                            <th>{{__('Delete')}}</th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($ontologies as $ontology)
                            <tr>

                                <td style="font-size: medium">{{$ontology->name}}</td>
                                <td>{{date("d-m-Y | H:i e", strtotime($ontology->updated_at))}}</td>
                                <td>
                                    @php
                                        $Description = str_limit($ontology->description, 20);
                                    @endphp
                                    {{$Description}}
                                </td>
                                <td>
                                    <a href="{{route('ontologies.download', ['locale' => app()->getLocale(), 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('ontologies.downloadOWL', [ 'locale' => app()->getLocale() ,'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                                        </button>
                                    </a>
                                </td>
                                <td><a href="{{route('ontologies.show', ['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-plus"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('ontologies.edit',['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <!-- Small fix so the only the owner of the ontology can favourite -->
                                    @if($ontology->user_id == auth()->user()->id)
                                        <form method="POST"
                                              action="{{route('ontologies.favourite', ['locale' => app()->getLocale(), 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-default"><i
                                                        class="fa fa-fw fa-star-o"></i></button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if($ontology->user_id == auth()->user()->id)
                                        <form method="post"
                                              action="{{route('ontologies.destroy', [ 'ontology' => $ontology->id, 'locale' => app()->getLocale()])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i
                                                        class="fa fa-fw fa-trash-o"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><i style="color: #62a0bb" class="fa fa-fw fa-share-alt "></i> {{__('Ontologies shared with you:')}} </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <p style="margin-top: 10px; border-radius: 10px; padding: 5px; "><i class="fa fa-fw fa-info"></i>{{__('You can not delete or mark up as favourite ontologies created by other users')}} </p>

            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Created By')}}</th>
                            <th>{{__('Updated at')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('XML File')}}</th>
                            <th>{{__('OWL File')}}</th>
                            <th>{{__('Details')}}</th>
                            <th>{{__('Edit')}}</th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach (auth()->user()->ontologies as $ontology)
                            <tr>
                                <td style="font-size: medium">{{$ontology->name}}</td>
                                <td>{{$ontology->user->name}}</td>
                                <td>{{date("d-m-Y | H:i e", strtotime($ontology->updated_at))}}</td>
                                <td>
                                    @php
                                        $Description = str_limit($ontology->description, 20);
                                    @endphp
                                    {{$Description}}
                                </td>
                                <td>
                                    <a href="{{route('ontologies.download', ['locale' => app()->getLocale(), 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('ontologies.downloadOWL', [ 'locale' => app()->getLocale() ,'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                                        </button>
                                    </a>
                                </td>
                                <td><a href="{{route('ontologies.show', ['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-plus"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('ontologies.edit',['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">
                                        <button class="btn btn-default"><i class="fa fa-fw fa-edit"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--
    <ul class="pagination pagination-sm no-margin ">
         //$ontologies->links()
    </ul>-->
    <!-- Filter -->
    <script type="text/javascript" src="{{asset('js/SearchBar.js')}}"></script>

@stop

@section('footer')
    .
@stop