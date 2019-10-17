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
    <!-- Search Script -->
    <script defer type="text/javascript" src="js/SearchTip.js"></script>

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
            <li class=""><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab" aria-expanded="false"><i
                            class="fa fa-fw fa-info-circle"></i></a></li>
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i
                            class="fa fa-search"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-object-group"></i></a></li>
        </ul>

        <div class="tab-content">

            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <a style="margin-bottom: 5px" class="btn btn-default" data-toggle="modal" data-target="#modal" aria-expanded="false"><i class="fa fa-fw fa-compass"></i>External Ontology Databases</a>
                <div id="searchBar" class="input-group input-group-sm">
                    <input value="" id="search-tip-input" type="text" class="form-control"
                           placeholder="Search for rules">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search-plus"></i></button>
                    </div>
                </div>
                <div id="menu-wrapper">
                    <div class="tab-content">
                        <div id="menu-scroll">
                            <div id="control-sidebar-theme-demo-options-tab table-search"
                                 class="tab-pane active table-search">
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
                                            <h3 class="box-title title">{{$class->name}} <i
                                                        class="fa fa-fw fa-circle-thin"></i>
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
                <!-- /.control-sidebar-menu -->

            </div>
            <div id="control-sidebar-theme-demo-options-tab" class="tab-pane">
                <div id="menu-scroll">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <i class="fa fa-text-width"></i>

                            <h3 class="box-title">Methodology</h3>  <i style="float: right;" class="fa fa-question-circle"></i>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="todo-list ui-sortable">
                                <li>
                                    <!-- checkbox -->
                                    <input type="checkbox" value="">
                                    <!-- todo text -->
                                    <span class="text"><a  href="#" data-toggle="modal" data-target="#methodology1" aria-expanded="false">1. Especificação da ontologia</a></span>
                                    <!-- Emphasis label -->
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#methodology1" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text">2. Aquisição e extração de conhecimento</span>
                                    <div class="tools">
                                        <a href="#"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text">3. Conceitualização</span>
                                    <div class="tools">
                                        <a href="#"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text">4. Fundamentação ontológica</span>
                                    <div class="tools">
                                        <a href="#"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li class="">
                                    <input type="checkbox" value="">
                                    <span class="text">5. Formalização da ontologia</span>
                                    <div class="tools">
                                        <a href="#"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text">6. Avaliação da ontologia</span>
                                    <div class="tools">
                                        <a href="#"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text">7. Documentação da ontologia</span>
                                    <div class="tools">
                                        <a href="#"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text">8. Disponibilização da ontologia</span>
                                    <div  class="tools">
                                        <a href="#"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix no-border">
                            <h4>Your progress: </h4>
                            <div class="progress progress active">
                                <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 0">
                                    <span id="progress-text" class="">0% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <h4 class="control-sidebar-heading">Your recent ontologies</h4>
                <div id="menu-scroll">
                    @foreach($ontologies as $ontology)
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{str_replace(".xml", " ", $ontology->name)}}</h3>
                            @if($ontology->favourite == 1)
                                <i style="color: #ffe70a" class="fa fa-fw fa-star"></i>
                            @else
                                <i class="fa fa-fw fa-object-group  "></i>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i>Description</strong>

                            <p class="text-muted">
                                {{$ontology->description}}
                            </p>

                            <hr>

                            <strong><i class="fa fa-clock-o margin-r-5"></i>Created at</strong>

                            <p>{{date("d-m-Y | H:i e", strtotime($ontology->created_at))}}</p>
                            <strong><i class="fa fa-clock-o margin-r-5"></i>Updated at</strong>
                            <p>{{date("d-m-Y | H:i e", strtotime($ontology->updated_at))}}</p>

                            <strong><i class="fa fa-files-o margin-r-5"></i>Download as</strong>

                                <a href="/ontologies/download/{{Auth::user()->id}}/{{$ontology->id}}"
                                   class="btn btn-default  btn-sm ">
                                    <i class="fa fa-fw fa-file-code-o"></i> XML
                                </a>
                                <a  href="/ontologies/downloadOWL/{{Auth::user()->id}}/{{$ontology->id}}"
                                   class="btn btn-default  btn-sm ">
                                    <i class="fa fa-fw fa-file-code-o"></i> OWL
                                </a>

                            @if($ontology->link != null)
                                <hr>
                                <strong><i  class="fa fa-external-link margin-r-5 "></i>Link</strong>

                                <p><a href="{{$ontology->link}}">{{$ontology->link}}</a></p>
                            @endif
                            <hr>
                            <p><a  class="btn btn-default editor-timeline-item"  href="ontologies/{{$ontology->id}}/edit"><i class="fa fa-fw fa-pencil"></i> Edit Ontology</a></p>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    @endforeach
                </div>

            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.tips menu -->

    <!-- Error Console -->
    <div id="error-console"  class="box box-default box-solid direct-chat direct-chat-danger collapsed-box">
        <div id="error-console-header" class="box-header">
            <h3 class="box-title">Error Console</h3>

            <div class="box-tools pull-right">
                Current Errors: <span id="error-count" data-toggle="tooltip" title="" class="badge bg-red" data-original-title="Errors">0</span>
             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">

                <!-- Message to the right -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right">Welcome</span>
                        <span class="direct-chat-timestamp pull-left"></span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="css/images/profile.jpeg" alt="Message User Image"><!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        Here you can see all the errors you've made
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
            </div>
            <!--/.direct-chat-messages-->
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
    </div>
    <!--  ./Error Console -->

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
                            <a href="http://www.ontobee.org/" target="_blank"><i class="fa fa-external-link"></i>
                                OntoBee</a>
                        </li>
                        <li>
                            <a href="https://bioportal.bioontology.org/" target="_blank"><i
                                        class="fa fa-external-link"></i> BioPortal</a>
                        </li>
                        <li>
                            <a href="https://www.ebi.ac.uk/ols/index" target="_blank"><i
                                        class="fa fa-external-link"></i> Ontology Lookup Service (OLS)</a>
                        </li>
                        <li>
                            <a href="http://swoogle.umbc.edu/2006/" target="_blank"><i class="fa fa-external-link"></i>
                                Swoogle</a>
                        </li>
                        <li>
                            <a href="http://resources.si.washington.edu/fma_browser1/" target="_blank"><i
                                        class="fa fa-external-link"></i> Foundational Model Anatomy Browser</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="methodology1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Especificação da ontologia</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Após salvar sua ontologia você tera a opção de editar suas informações no área de gerenciamento de ontologias que pode ser encontrada na parte superior da página ou <a href="{{route('ontologies.index')}}">Clicando Aqui</a></p>
                    <img alt="superior-menu" src="css/images/Methodology/menu-superior.png">
                    <hr>
                    <p>Após clicar no botão 'My Ontologies' você será redirecionado para uma página que contém todas suas ontologias feitas e você podera editar cada uma delas. Clique no botão abaixo para ascessar todas às informações daquela ontologia</p>
                    <img alt="ontology-info" src="css/images/Methodology/edit-ontology.png">
                    <hr>
                    <p>Após clicar no botão você será redirecionado para página da ontologia e podera fazer as alterações necessárias </p>
                    <img style="width: 90%" alt="ontology-info" src="css/images/Methodology/info.png">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </body>

@stop




