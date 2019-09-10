@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div id="preloader"><strong>WAIT UNTIL ONTO4ALL IS READY! </strong></div>
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
    <script type="text/javascript" src="js/HomeFunctions.js"></script>
    <script type="text/javascript" src="js/Compiler.js"></script>


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


    <!-- ONTO4ALL MODIFICATIONS -->

    <!--tips menu-->
    <aside class="control-sidebar control-sidebar-light control-sidebar-open">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class=""><a class="btn btn-default" data-toggle="modal" data-target="#modal" aria-expanded="false"><i
                            class="fa fa-fw fa-compass"></i>External Ontologies Databases</a>
            </li>
        </ul>
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class=""><a class="btn btn-default" data-toggle="modal" data-target="#exampleModal"
                            aria-expanded="false"><i
                            class="fa fa-fw fa-object-group "></i>Your ontologies</a>
        </ul>
        <div id="searchBar" class="input-group input-group-sm">
            <input value="" id="search-tip-input" type="text" class="form-control"
                   placeholder="Search for rules">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div id="menu-wrapper">
            <div class="tab-content">
                <div id="menu-scroll">
                    <div id="control-sidebar-theme-demo-options-tab table-search" class="tab-pane active table-search">
                        @foreach($relations as $ontologyRelation)
                            <div id="tipSearch" class="box box-primary collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title title">{{$ontologyRelation->name}} <i
                                                class="fa fa-fw fa-long-arrow-right"></i></h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <dl>
                                        <dt>Definition</dt>
                                        <dd>{{$ontologyRelation->definition}}</dd>
                                        <dt>Formal Definition</dt>
                                        <dd>{{$ontologyRelation->formal_definition}}</dd>
                                        <dt>Domain</dt>
                                        <dd>{{$ontologyRelation->domain}}</dd>
                                        <dt>Range</dt>
                                        <dd>{{$ontologyRelation->range}}</dd>
                                        <dt>Example Of Usage</dt>
                                        <dd>{{$ontologyRelation->example_of_usage}}</dd>
                                        <dt>Imported From</dt>
                                        <dd>
                                            <a href="{{$ontologyRelation->imported_from}}">{{$ontologyRelation->imported_from}}</a>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($classes as $class)
                            <div id="tipSearch" class="box box-success collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title title">{{$class->name}} <i class="fa fa-fw fa-circle-thin"></i>
                                    </h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <dl>
                                        <dt>Definition</dt>
                                        <dd>{{$class->definition}}</dd>
                                        <dt>Formal Definition</dt>
                                        <dd>{{$class->formal_definition}}</dd>
                                        <dt>SuperClass</dt>
                                        <dd>{{$class->superclass}}</dd>
                                        <dt>Synonyms</dt>
                                        <dd>{{$class->synonyms}}</dd>
                                        <dt>Example Of Usage</dt>
                                        <dd>{{$class->example_of_usage}}</dd>
                                        <dt>Imported From</dt>
                                        <dd>
                                            <a href="{{$class->imported_from}}">{{$class->imported_from}}</a>
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
                                            <i class="fa fa-fw fa-file-code-o"></i> Download XML
                                        </a>
                                        <a href="/ontologies/downloadOWL/{{Auth::user()->id}}/{{$ontology->id}}"
                                           class="btn btn-info btn-file btn-sm ">
                                            <i class="fa fa-fw fa-file-code-o"></i> Download OWL
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


    <div class="tab modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>External ontologies databases</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>
                            <a href="http://www.ontobee.org/" target="_blank"><i class="fa fa-external-link"></i> OntoBee</a>
                        </li>
                        <li>
                            <a href="https://bioportal.bioontology.org/" target="_blank"><i class="fa fa-external-link"></i> BioPortal</a>
                        </li>
                        <li>
                            <a href="https://www.ebi.ac.uk/ols/index" target="_blank"><i class="fa fa-external-link"></i> Ontology Lookup Service (OLS)</a>
                        </li>
                        <li>
                            <a href="http://swoogle.umbc.edu/2006/" target="_blank"><i class="fa fa-external-link"></i> Swoogle</a>
                        </li>
                        <li>
                            <a href="http://resources.si.washington.edu/fma_browser1/" target="_blank"><i class="fa fa-external-link"></i> Foundational Model Anatomy Browser</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- TIPS / ERRORS / WARNINGS -->

    @component('warning')
        @slot('title')
            <strong>Important</strong>
        @endslot
        Press <strong>CTRL + S </strong> to download your ontology!
    @endcomponent

    @component('danger')
        @slot('id')
            equalClassNamesError
        @endslot
        @slot('title')
            <strong>Error</strong>
        @endslot
        Your ontology has <strong>2 Classes</strong> with the same name!
    @endcomponent

    @component('danger')
        @slot('id')
            equalRelationNamesError
        @endslot
        @slot('title')
            <strong>Error</strong>
        @endslot
        Your ontology has <strong>2 Relations</strong> with the same name!
    @endcomponent

    @component('danger')
        @slot('id')
            equalRelationsError
        @endslot
        @slot('title')
            <strong>Error</strong>
        @endslot
        You cant have <strong> 2 equal relations pointing to the same classes </strong>
    @endcomponent

    @component('danger')
        @slot('id')
            instanceOfBetweenClassesError
        @endslot
        @slot('title')
            <strong>Error</strong>
        @endslot
        You cant have a <strong> instance Of </strong> relation between two classes. It must be between one class and one instance
    @endcomponent

    @component('danger')
        @slot('id')
            wrongRelationError
        @endslot
        @slot('title')
            <strong>Error</strong>
        @endslot
        You can <strong> only have a instance_of relation </strong> between a class and a instance.
    @endcomponent

    @component('tip')
        @slot('title')
            Tip
        @endslot
        Have any question? Access our <a href="http://localhost:8000/tutorial"> <strong> Tutorial </strong></a>
    @endcomponent

    @component('tip')
        @slot('title')
            Tip
        @endslot
        Press <strong> CTRL + M </strong> to show the properties froom the selected class/relation
    @endcomponent

    @component('tip')
        @slot('title')
            Welcome to ONTO4ALL
        @endslot
        Close me to see more tips or <strong><a>CLICK HERE</a></strong> to hide the tips
    @endcomponent

    <!-- /.TIPS -->
    <a id="notification-button" class="btn btn-app">
        <i class="fa fa-bullhorn"></i>
        <div id="notification-button-text">Hide Tips</div>
    </a>

    <a id="sidebar-control" class="btn btn-app">
        <i style="margin-left: 20px;" class="fa fa-fw fa-arrows-v"></i>
        <div id="sidebar-control-text">Hide Sidebar</div>
    </a>

    <a id="error-control" class="btn btn-app">
        <i style="margin-left: 20px;" class="fa fa-fw fa-ban"></i>
        <div id="sidebar-control-text">Hide Error Messages</div>
    </a>
    </body>

    <!-- Search Script -->
    <script defer type="text/javascript" src="js/SaveMessage.js"></script>
    <script defer type="text/javascript" src="js/SearchTip.js"></script>

@stop
