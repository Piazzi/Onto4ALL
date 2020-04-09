@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div id="preloader"><strong>WAIT UNTIL ONTO4ALL IS READY! </strong></div>

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

    <script type="text/javascript" src="js/OpenDiagram.js"></script>

    <!-- Tooltips -->
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@5"></script>
    <!-- MxGraph -->
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
    <script type="text/javascript" src="js/NightMode.js"></script>
    <!-- Search Script <script defer type="text/javascript" src="js/SearchTip.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>


@stop

@section('content')

    <body onload="searchTip()" class="geEditor">
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
            <li class=""><a class="menu-title" href="#control-sidebar-theme-demo-options-tab" data-toggle="tab" aria-expanded="false"><i
                            class="fa fa-fw fa-info-circle"></i> Methodology</a></li>
            <li class="active"><a class="menu-title" href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i
                            class="fa fa-search"></i> Tips</a></li>
            <li><a class="menu-title" href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-object-group"></i> Ontologies</a></li>
        </ul>

        <div class="tab-content">

            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <a style="margin-bottom: 5px" class="btn btn-default img-max-width" data-toggle="modal" data-target="#modal" aria-expanded="false"><i class="fa fa-fw fa-compass"></i>External Ontology Databases</a>
                <div id="searchBar" class="input-group input-group-sm">
                    <input value="" id="search-tip-input" type="text" class="form-control"
                           placeholder="Search for tips">
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
                                    <div id="tipSearch" class="box box-default collapsed-box box-solid relation-box">
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
                                                @if($ontologyRelation->formal_definition)
                                                <dt>Formal Definition</dt>
                                                <dd>{{$ontologyRelation->formal_definition}}</dd>
                                                @endif
                                                <dt>Domain</dt>
                                                <dd>{{$ontologyRelation->domain}}</dd>
                                                <dt>Range</dt>
                                                <dd>{{$ontologyRelation->range}}</dd>
                                                <dt>Example Of Usage</dt>
                                                <dd>{{$ontologyRelation->example_of_usage}}</dd>
                                                @if($ontologyRelation->imported_from)
                                                <dt>Imported From</dt>
                                                <dd>
                                                    <a target="_blank" href="{{$ontologyRelation->imported_from}}">{{$ontologyRelation->imported_from}}</a>
                                                </dd>
                                                @endif
                                                <dt>ID</dt>
                                                <dd>{{$ontologyRelation->relation_id}}</dd>
                                                <dt>Label</dt>
                                                <dd>{{$ontologyRelation->label}}</dd>
                                                @if($ontologyRelation->synonyms)
                                                    <dt>Synonyms</dt>
                                                    <dd>{{$ontologyRelation->synonyms}}</dd>
                                                @endif
                                                @if($ontologyRelation->is_defined_by)
                                                    <dt>Is Defined By</dt>
                                                    <dd>{{$ontologyRelation->is_defined_by}}</dd>
                                                @endif
                                                @if($ontologyRelation->comments)
                                                        <dt>Editor Note (comments)</dt>
                                                    <dd>{{$ontologyRelation->comments}}</dd>
                                                @endif
                                                @if($ontologyRelation->inverse_of)
                                                    <dt>Inverse Of</dt>
                                                    <dd>{{$ontologyRelation->inverse_of}}</dd>
                                                @endif
                                                @if($ontologyRelation->subproperty_of)
                                                    <dt>Subproperty Of</dt>
                                                    <dd>{{$ontologyRelation->subproperty_of}}</dd>
                                                @endif
                                                @if($ontologyRelation->superproperty_of)
                                                    <dt>Superproperty Of</dt>
                                                    <dd>{{$ontologyRelation->superproperty_of}}</dd>
                                                @endif
                                                <dt>Ontology</dt>
                                                <dd>{{strtoupper($ontologyRelation->ontology)}}</dd>
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
                                                <dt>Formal Definition (has_associated_axiom)</dt>
                                                @if($class->formal_definition)
                                                <dd>{{$class->formal_definition}}</dd>
                                                @endif
                                                <dt>ID</dt>
                                                <dd>{{$class->class_id}}</dd>
                                                @if($class->subclass)
                                                    <dt>SubClassOf</dt>
                                                    <dd>{{$class->subclass}}</dd>
                                                @endif
                                                @if($class->synonyms)
                                                <dt>Synonyms (has_synonym)</dt>
                                                <dd>{{$class->synonyms}}</dd>
                                                @endif
                                                <dt>Example Of Usage</dt>
                                                <dd>{{$class->example_of_usage}}</dd>
                                                @if($class->imported_from)
                                                <dt>Imported From</dt>
                                                <dd>
                                                    <a target="_blank" href="{{$class->imported_from}}">{{$class->imported_from}}</a>
                                                </dd>
                                                @endif
                                                <dt>Label</dt>
                                                <dd>{{$class->label}}</dd>
                                                @if($class->elucidation)
                                                    <dt>Elucidation</dt>
                                                    <dd>{{$class->elucidation}}</dd>
                                                @endif
                                                @if($class->is_defined_by)
                                                    <dt>Is Defined By</dt>
                                                    <dd>{{$class->is_defined_by}}</dd>
                                                @endif
                                                @if($class->disjoint_with)
                                                    <dt>Disjoint With</dt>
                                                    <dd>{{$class->disjoint_with}}</dd>
                                                @endif
                                                @if($class->comments)
                                                    <dt>Editor Note (comments)</dt>
                                                    <dd>{{$class->comments}}</dd>
                                                @endif
                                                <dt>Ontology</dt>
                                                <dd>{{strtoupper($class->ontology)}}</dd>
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
                    <div class="box box-success methodology-box">
                        <div class="box-header with-border">
                            <i class="fa fa-text-width"></i>

                            <h3 class="box-title methodology-title">Methodology</h3>  <a href="#" data-toggle="modal" data-target="#methodologyDefinition" aria-expanded="false"><i style="float: right;" class="fa fa-question-circle"></i></a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="todo-list ui-sortable">
                                <li>
                                    <!-- checkbox -->
                                    <input type="checkbox" value="">
                                    <!-- todo text -->
                                    <span class="text"><a  href="#" data-toggle="modal" data-target="#specification" aria-expanded="false">1. Specification of the ontology</a></span>
                                    <!-- Emphasis label -->
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#specification" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#acquisitionExtractionKnowledge" aria-expanded="false">2. Acquisition and extraction of knowledge</a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#acquisitionExtractionKnowledge" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a  href="#" data-toggle="modal" data-target="#conceptualization" aria-expanded="false"> 3. Conceptualization</a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#conceptualization" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a  href="#" data-toggle="modal" data-target="#ontologicalGrounding" aria-expanded="false"> 4. Ontological grounding </a></span>
                                    <div class="tools">
                                        <a href="#"  data-toggle="modal" data-target="#ontologicalGrounding" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li class="">
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#formalization" aria-expanded="false"> 5. Formalization of the ontology </a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#formalization" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#evaluation" aria-expanded="false"> 6. Evaluation of the ontology </a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#evaluation" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#documentation" aria-expanded="false"> 7. Documentation </a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#documentation" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#publication" aria-expanded="false"> 8. Publication of the ontology. </a></span>
                                    <div  class="tools">
                                        <a href="#" data-toggle="modal" data-target="#publication" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix no-border methodology-footer">
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

                            <p>
                                <a id="{{$ontology->id}}"  class="btn btn-default editor-timeline-item openOntology"  href="#"><i class="fa fa-fw fa-object-group"></i> Open in the editor</a>
                                <a  target="_blank" class="btn btn-default editor-timeline-item"  href="ontologies/{{$ontology->id}}/edit"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                            </p>

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



    <!-- Warning Console -->
    <div id="warnings-console" class="box box-default box-solid direct-chat direct-chat-danger collapsed-box">
        <div id="warnings-console-header" class="box-header">
            <h3 class="box-title">Warnings Console</h3>

            <a  href="#" data-target="#warningsConsole" data-toggle="modal" aria-expanded="false"><i class="fa fa-fw fa-question-circle"></i></a>
            <div class="box-tools pull-right">

                <a download="ontology-errors.txt" href="#" id="download-errors-txt"><span data-toggle="tooltip" title="" class="badge bg-info">
                    <i class="fa fa-download"></i>
                    </span>
                </a>

                <!--
                <span id="errors" data-widget="collapse"  class="badge bg-red" data-original-title="Errors">
                    <i class="fa fa-close"></i>
                    <span id="error-count"> 0</span>
                </span>-->

                <span id="warnings" data-widget="collapse" class="badge bg-yellow" data-original-title="Warnings">
                    <i class="fa fa-warning"> </i>
                    <span id="warnings-count">  0</span>
                </span>

                <button id="open-error-console" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
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
                        Here you can see all the warnings
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

    <!-- METHODOLOGY MODALS  -->
    <div class="tab modal fade" id="specification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Specification of the ontology</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>In this phase, the developer performs the specification of the ontology through a
                        template, which has to contain at least information about: the domain and scope of the
                        ontology, its general purpose, its audience, scenarios for its application and the
                        required degree of formality. In addition, the developer establishes the coverage of the
                        ontology by describing its starting point, its limits within the domain and competency
                        questions.
                    </p>
                    <p>
                        Once you have saved your ontology, you will have the option to edit your information in the ontology management area which can be found at the top of the page or by <a href="{{route('ontologies.index')}}">clicking here</a></p>
                    <img alt="superior-menu" src="css/images/Methodology/menu-superior.png">
                    <hr>
                    <p>After clicking on the 'My Ontologies' button you will be redirected to a page containing all your ontologies made and you can edit each one. Click the button below to access all information on that ontology.</p>
                    <img alt="ontology-info" src="css/images/Methodology/edit-ontology.png">
                    <hr>
                    <p>After clicking the button you will be redirected to the ontology page and can make the necessary changes. </p>
                    <img style="width: 90%" alt="ontology-info" src="css/images/Methodology/info.png">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="methodologyDefinition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Definition</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>OntoForInfoScience is a detailed methodology for construction of
                        ontologies that details each step of the ontology development cycle. The goal of such
                        methodology is to enable experts in Knowledge Organization to overcome the technical
                        jargon difficulties, as well as logical and philosophical issues that involve the ontology
                        development (Mendonça, 2016).
                        The methodology OntoForInfoScience consists of nine phases:
                       </p>
                    <ul>
                        <li>
                            1) Specification of the ontology
                        </li>
                        <li>
                            2) Acquisition and extraction of knowledge
                        </li>
                        <li>
                            3) Conceptualization
                        </li>
                        <li>
                            4) Ontological grounding
                        </li>
                        <li>
                            5) Formalization of the ontology
                        </li>
                        <li>
                            6) Evaluation of the ontology
                        </li>
                        <li>
                            7) Documentation
                        </li>
                        <li>
                            8) Publication of the ontology.
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="acquisitionExtractionKnowledge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Acquisition and extraction of knowledge</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Phase 2 consists of the knowledge acquisition, which encompasses the selection of
                        materials to be approached (about the subject of the domain) and the selection of
                        methods for extracting knowledge. Within OntoForInfoScience, these activities are
                        conducted in a way that mixes different methods, like: textual analysis of books and
                        papers, automatic terminological extraction, semi-automatic methods for identification
                        of concepts, to mention a few.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="conceptualization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Conceptualization</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Phase 3 concerns conceptualization, when the developer performs activities of
                        identification and analysis of the concepts that are candidates to classes in the
                        ontology. In addition, the developer promotes the knowledge organization so that one
                        is able to obtain relations, properties and constraints of the ontology. The more
                        appropriate way to represent the conceptualization of ontology it is through of a
                        graphical conceptual model, representing conceptual relations between identified
                        concepts through graphs or similar structures.
                        In the Onto4AllEditor, the Phase 3 must be performed in <strong>this page using the graphical editor</strong>. You can access this page again by clicking in the “Ontology drawing” on the menu.
                    </p>
                    <img class="img-max-width" alt="editor" src="css/images/Methodology/editor.png">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="ontologicalGrounding" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Ontological Grounding</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Phase 4 corresponds to the activity of ontological grounding in which the developer
                        surveys top-levels ontologies to be used as starting points. Developers choose the top-
                        level ontology more suitable to their aims in considering the underlying philosophical
                        approach that will justify modeling decisions. From the operational point of view, the
                        developer imports selected top-level ontology to an ontology editor tool for successful
                        implementation.
                    </p>
                    <p>
                        <strong>You can edit your previous saved ontologies using the button "open in the editor" on the right sidebar</strong>
                    </p>
                    <img class="img-max-width" alt="import" src="css/images/Methodology/importFromSidebar.png">

                    <p>
                        <strong>You can import other ontologies to this editor if they have been created using the Onto4AllEditor and have a .XML extension. All ontologies exported by this editor can be imported in later projects. </strong>. Using the menu editor, click on the "file" button and then on the "import" as showed below:
                    </p>
                    <img class="img-max-width" alt="import" src="css/images/Methodology/import.png">
                    <p>Select a valid file from your computer using the "choose file" button or drag a file direct to the box and then click in "import"</p>
                    <img class="img-max-width" alt="select-file" src="css/images/Methodology/select-file.png">
                    <p>After that, your imported ontology will be showing on the editor</p>
                    <img class="img-max-width" alt="pizza ontology" src="css/images/Methodology/pizza.png">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="formalization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Formalization of the ontology</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>In this phase, the developer produces a formal description of the domain from the
                        conceptualization of the prior phase 3. Activities of phase 5 are:
                    </p>
                        <ul>
                            <li>
                                5.1) to construct general taxonomy of the ontology based on previously selected top-
                                level taxonomy (in the Onto4AllEditor, this activity must be performed in the menu
                                “Ontology drawing”, the page you are right now)
                                <img class="img-max-width" alt="properties" src="css/images/Methodology/editor.png">
                            </li>
                            <li>
                                5.2) to define descriptive properties of the classes involving textual attributes as
                                names, synonyms, definitions and annotations (in the Onto4AllEditor, this activity must
                                be performed in the editor, clicking under a class or relation with the
                                right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the class and pressing CTRL + M));
                                <img alt="properties" src="css/images/Methodology/propriedades.png">
                            </li>
                            <li>
                                5.3) to create formal definitions for each class using a logical language, so that the
                                formal definition is able to be derived from the textual definitions created previously;
                            </li>
                            <li>
                                5.4) to define properties of classes, involving attributes as data types, cardinality,
                                existential and universal quantifiers (in the Onto4AllEditor, this activity must be
                                performed in the menu “Ontology drawing”, clicking under a class or relation with the
                                right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the class and pressing CTRL + M));
                                <img alt="properties" src="css/images/Methodology/propriedades.png">
                                <img class="img-max-width" alt="properties" src="css/images/Methodology/class-properties.png">
                            </li>
                            <li>
                                5.5) to create instances for ontological classes (in the Onto4AllEditor, this activity must
                                be performed in the menu “Ontology drawing”, adding the symbol “Instance” (rectangle)
                                to the ontology in the drawing area, this symbol can be find on the ontology palette, in the left of the editor);
                            </li>
                            <li>
                                5.6) to specify ontological relations, consisting of the application of a defined set of
                                rules and principles carrying out the transformation of conceptual relations into formal
                                relations (in the Onto4AllEditor, this activity must be performed in the editor
                                ”, clicking under a class or relation with the right button of the mouse and
                                choosing the function Edit Properties in the submenu (or selecting the relation and pressing CTRL + M)).
                                <img class="img-max-width" alt="properties" src="css/images/Methodology/relation.png">
                                <img class="img-max-width" alt="properties" src="css/images/Methodology/relation-properties.png">
                            </li>
                        </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="evaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Evaluation of the ontology</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The evaluation of the ontology correspond to the application of a set of criteria allowing
                        one to perform both the ontological validation (validation of the correspondence
                        between ontology and the real world) and the ontological verification (analysis of the
                        ontology with respect to the correctness of its construction). Examples of validation
                        criteria are: non-recursivity in definitions, the specification of different types of part_of
                        relations, the definition of inverse relations, and the creation of the cardinalities.
                        In the Onto4AllEditor, the Phase 6 is performed automatically by the editor
                        through of the functionality Warnings Console, that suggests good modeling practices for the current
                        drawn ontology.
                    </p>
                    <img class="img-max-width" alt="console" src="css/images/Methodology/console.png">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="documentation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Documentation</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>In phase 7, documentation of all activities performed along the ontology development
                        cycle is organized. The production of documentation occurs during all the time the
                        ontology has been constructed. The content of the documentation encompasses the
                        document of specification (from phase 1), documents of reference about the domain
                        (from phase 2), the set of conceptual models (from phase 3), reused ontologies
                        (phases 4 and 5), ontological and formal content (phase 5), and other useful
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="publication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Publication of the ontology</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>In phase 8 the developer makes the ontological artifact available in a way that be
                        downloaded and properly visualized by a community of users.
                        You can download the ontology you just draw by clicking in the "file" menu and then in the "export" submenu
                    </p>
                    <img class="img-max-width" alt="export" src="css/images/Methodology/export.png">
                    <p>You can export your ontology in XML, OWL or SVG (image).
                        When you do that your ontology is also saved in your account,
                        you can look all the ontologies you made by clicking on the "My Ontologies" menu on the top of the page.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ METHODOLOGY MODALS  -->

    <!-- Error Console Info modal -->
    <div class="tab modal fade" id="warningsConsole"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Warnings Console</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The warnings console is the way our editor tells you good modeling practices you should implement when building a ontology.
                        This console will show you warnings that will help you build a better ontology. <a target="_blank" href="/warningIndex">Click here</a>
                        to see all the warnings our console track. We will be updating this console with more warnings in the future, <a href="/help">contact us</a> if you
                        want some rule be implemented here.
                    </p>
                    <img class="img-max-width" alt="export" src="css/images/errorConsole.png">
                    <p>Here you can see that the pizza ontology have several warnings that need to be solved.
                        <strong>Always remember to fully connect all of your relations, otherwise the warnings console might not work correctly.</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--./Error Console Info modal -->



    <!-- Tracker spans  -->
    <span id="classes" data-widget="collapse"  class="badge bg-green tracker" >
                    <i class="fa fa-fw fa-circle-thin"></i>
                    <span id="classes-count"> 0</span>
                </span>

    <span id="relations" data-widget="collapse"  class="badge bg-green tracker" >
                    <i class="fa fa-fw fa-long-arrow-right"></i>
                    <span id="relations-count"> 0</span>
                </span>

    <span id="instances" data-widget="collapse"  class="badge bg-green tracker" >
                    <i class="fa fa-fw fa-diamond"></i>
                    <span id="instances-count"> 0</span>
                </span>

    <span id="night-mode" class="badge bg-info tracker">
        <a style="color: white;"   href="#"><i class="fa fa-fw fa-moon-o"></i></a>
    </span>
    <!-- ./Tracker spans  -->


    </body>


@stop

@section('footer')
    .
@stop

<!-- THIS FUNCTION NEEDS TO BE LOADED AFTER THE MXGRAPH COMPONENTS -->
<script type="text/javascript">

    function searchTip(){
        // Build the menu
        $(".geToolbar").append('<div class="geSeparator"> </div>');
        $(".geToolbar").append($('#night-mode'));
        $(".geToolbar").append($('#classes'));
        $(".geToolbar").append($('#relations'));
        $(".geToolbar").append($('#instances'));

        $(".geSidebar .geItem").click(function () {
        let name =  $(this).attr('class');
        name = name.replace("geItem", "").trim();
        if(name != 'Class' && name != 'Callout' && name != 'Textbox' && name != 'Text' && name != 'Instance' && name != 'new_relation')
        {
            $('#search-tip-input').attr('value', name);
            $("#menu-scroll .collapsed-box").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
            });
        }
    });

    $("#search-tip-input").on("keyup", function () {
        let value = $(this).val().toLowerCase();

        $("#menu-scroll .collapsed-box").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

    });}
</script>