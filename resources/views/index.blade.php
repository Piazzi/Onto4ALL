@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div id="preloader" style="color: #00A65A" ><strong>WAIT UNTIL ONTO4ALL IS READY! </strong></div>
    <script type="text/javascript" src="js/HomeFunctions.js"></script>
    <script type="text/javascript" src="js/SaveMessage.js"></script>
    <script defer type="text/javascript" src="js/SearchTip.js"></script>
    <link rel="stylesheet" type="text/css" href="css/mxgraph/grapheditor.css">

    <title>Grapheditor</title>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=5,IE=9"><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script type="text/javascript">
        // Parses URL parameters. Supported parameters are:
        // - lang=xy: Specifies the language of the user interface.
        // - touch=1: Enables a touch-style user interface.
        // - storage=local: Enables HTML5 local storage.
        // - chrome=0: Chromeless mode.
        var urlParams = (function (url) {
            var result = new Object();
            var idx = url.lastIndexOf('?');

            if (idx > 0) {
                var params = url.substring(idx + 1).split('&');

                for (var i = 0; i < params.length; i++) {
                    idx = params[i].indexOf('=');

                    if (idx > 0) {
                        result[params[i].substring(0, idx)] = params[i].substring(idx + 1);
                    }
                }
            }

            return result;
        })(window.location.href);

        // Default resources are included in grapheditor resources
        mxLoadResources = false;
    </script>
    <script type="text/javascript" src="js/Init.js"></script>
    <script type="text/javascript" src="js/pako.min.js"></script>
    <script type="text/javascript" src="js/base64.js"></script>
    <script type="text/javascript" src="js/jscolor.js"></script>
    <script type="text/javascript" src="js/sanitizer.min.js"></script>
    <script type="text/javascript" src="js/mxClient.js"></script>
    <script type="text/javascript" src="js/EditorUi.js"></script>
    <script type="text/javascript" src="js/Editor.js"></script>
    <script type="text/javascript" src="js/Sidebar.js"></script>
    <script type="text/javascript" src="js/Graph.js"></script>
    <script type="text/javascript" src="js/Format.js"></script>
    <script type="text/javascript" src="js/Shapes.js"></script>
    <script type="text/javascript" src="js/Actions.js"></script>
    <script type="text/javascript" src="js/Menus.js"></script>
    <script type="text/javascript" src="js/Toolbar.js"></script>
    <script type="text/javascript" src="js/Dialogs.js"></script>


@stop

@section('content')

    <body class="geEditor">
    <script type="text/javascript">
        // Extends EditorUi to update I/O action states based on availability of backend
        (function () {
            var editorUiInit = EditorUi.prototype.init;

            EditorUi.prototype.init = function () {
                editorUiInit.apply(this, arguments);
                this.actions.get('export').setEnabled(false);

                // Updates action states which require a backend
                if (!Editor.useLocalStorage) {
                    mxUtils.post(OPEN_URL, '', mxUtils.bind(this, function (req) {
                        var enabled = req.getStatus() != 404;
                        this.actions.get('open').setEnabled(enabled || Graph.fileSupport);
                        this.actions.get('import').setEnabled(enabled || Graph.fileSupport);
                        this.actions.get('save').setEnabled(enabled);
                        this.actions.get('saveAs').setEnabled(enabled);
                        this.actions.get('export').setEnabled(enabled);
                    }));
                }
            };

            // Adds required resources (disables loading of fallback properties, this can only
            // be used if we know that all keys are defined in the language specific file)
            mxResources.loadDefaultBundle = false;
            var bundle = mxResources.getDefaultBundle(RESOURCE_BASE, mxLanguage) ||
                mxResources.getSpecialBundle(RESOURCE_BASE, mxLanguage);

            // Fixes possible asynchronous requests
            mxUtils.getAll([bundle, STYLE_PATH + '/default.xml'], function (xhr) {
                // Adds bundle text to resources
                mxResources.parse(xhr[0].getText());

                // Configures the default graph theme
                var themes = new Object();
                themes[Graph.prototype.defaultThemeName] = xhr[1].getDocumentElement();

                // Main
                new EditorUi(new Editor(urlParams['chrome'] == '0', themes));
            }, function () {
                document.body.innerHTML = '<center style="margin-top:10%;">Error loading resource files. Please check browser console.</center>';
            });
        })();
    </script>

    <!-- MODIFICAÇÕES PARA O SISTEMA -->

    <!--tips menu-->
    <aside class="control-sidebar control-sidebar-light control-sidebar-open">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class=""><a data-toggle="tab" aria-expanded="false"><i class="fa fa-fw fa-compass"></i>Tips database</a>
            </li>
            <li class=""><a data-toggle="modal" data-target="#exampleModal" aria-expanded="false"><i
                            class="fa fa-fw fa-object-group "></i>Your ontologies</a></li>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Your Ontologies</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="timeline">
                        <!-- timeline time label -->
                        @foreach($ontologies as $ontology)
                            <li class="time-label">
                              <span class="bg-blue">
                                {{$ontology->created_at}}
                              </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                @if($ontology->favourite == 1)
                                    <i style="color: #ffe70a; background-color: #00A65A" class="fa fa-fw fa-star"></i>
                                @else
                                    <i class="fa fa-fw fa-object-group bg-green "></i>
                                @endif
                                <div class="timeline-item">
                                    <span class="time"><strong>Publication Date:  <i class="fa fa-clock-o"></i> {{$ontology->publication_date}}</strong></span>
                                    <span class="time"><strong>Last Upload:  <i class="fa fa-clock-o"></i> {{$ontology->last_uploaded}}</strong></span>

                                    <h3 class="timeline-header"><a href="#">{{$ontology->name}}</a></h3>

                                    <div class="timeline-body">
                                        {{$ontology->description}}
                                    </div>
                                    <div class="timeline-footer">
                                        @if($ontology->link != null)
                                            <a href="{{$ontology->link}}"
                                               class="btn btn-primary btn-sm">{{$ontology->link}}</a>
                                        @endif
                                        <a class="btn btn-success btn-sm">{{$ontology->created_by}}</a>
                                        <a href="/ontologies/download/{{Auth::user()->id}}/{{$ontology->id}}"
                                           class="btn btn-info btn-file btn-sm ">
                                            <i class="fa fa-fw fa-file-code-o"></i> Download
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DICAS -->

    @component('warning')
        @slot('title')
            <strong>Importante</strong>
        @endslot
        Aperte <strong>CTRL + S </strong> para baixar sua ontologia!
    @endcomponent

    @component('tip')
        @slot('title')
            Dica
        @endslot
        Tem alguma dúvida? Acesse nosso <a href="http://localhost:8000/tutorial"> <strong> Tutorial </strong></a>
    @endcomponent

    @component('tip')
        @slot('title')
            Dica
        @endslot
        Selecione e Aperte <strong> CTRL + M </strong> para mostrar as propriedades da classe
    @endcomponent

    @component('tip')
        @slot('title')
            Dica
        @endslot
        Clique em uma célula para adicioná-la mais rápido ao diagrama
    @endcomponent

    @component('tip')
        @slot('title')
            Bem-vindo ao Onto4ALL
        @endslot
        Me feche para ver mais dicas ou <strong><a>CLIQUE AQUI</a></strong> para esconder as dicas
    @endcomponent

    <!-- /.DICAS -->

    <a id="notification-button" class="btn btn-app">
        <span class="badge bg-yellow">Clique Aqui</span>
        <i class="fa fa-bullhorn"></i> Tips
    </a>

    <a id="sidebar-control" class="btn btn-app">
        <span class="badge bg-green">Clique aqui</span>
        <i style="margin-left: 20px;" class="fa fa-fw fa-arrows-v"></i> Sidebar
    </a>
    </body>

@stop
