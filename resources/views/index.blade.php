@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div id="loading"><strong>{{__('WAIT UNTIL ONTO4ALL IS READY!')}} </strong></div>
@stop

@section('content')

    <!--tips menu-->
    <aside class="control-sidebar control-sidebar-light control-sidebar-open">
        <!-- Warning Console -->
        <div id="warnings-console" class="box box-default box-solid direct-chat direct-chat-warning no-warnings ">
            <div id="warnings-console-header" class="box-header">
                <h3 class="box-title">{{__('Warnings Console')}}</h3>

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

                    <span id="warnings" data-widget="collapse" class="badge bg-green" data-original-title="Warnings">
                    <i class="fa fa-warning"> </i>
                    <span id="warnings-count">  0</span>
                </span>

                    <button id="open-error-console" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">

                    <!-- Message to the right -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">{{__('Welcome')}}</span>
                            <span class="direct-chat-timestamp pull-left"></span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img id="no-warning-img" class="direct-chat-img" src="{{asset('css/images/LogoMini.png')}}" alt="Message User Image"><!-- /.direct-chat-img -->
                        <div id="no-warning-text" class="direct-chat-text">
                            {{__('You dont have any warnings.')}}
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
        <!--  ./Warning Console -->
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class=""><a class="menu-title" href="#control-sidebar-theme-demo-options-tab" data-toggle="tab" aria-expanded="false"><i
                            class="fa fa-fw fa-info-circle"></i> {{__('Methodology')}}</a></li>
            <li class="active"><a class="menu-title" href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i
                            class="fa fa-search"></i> {{__('Tips')}}</a></li>
            <li><a class="menu-title" data-toggle="modal" data-target="#ontology-manager" ><i class="fa fa-object-group"></i> {{__('Ontologies')}}</a></li>
        </ul>

        <div class="tab-content">

            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <a style="margin-bottom: 5px" class="btn btn-default img-max-width" data-toggle="modal" data-target="#modal" aria-expanded="false"><i class="fa fa-fw fa-compass"></i>{{__('External Ontology Databases')}}</a>
                <div id="searchBar" class="input-group input-group-sm">
                    <input value="" id="search-tip-input" type="text" class="form-control"
                           placeholder="{{__('Search for tips')}}">
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

                            <h3 class="box-title methodology-title">{{__('Methodology')}}</h3>  <a href="#" data-toggle="modal" data-target="#methodologyDefinition" aria-expanded="false"><i style="float: right;" class="fa fa-question-circle"></i></a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="todo-list ui-sortable">
                                <li>
                                    <!-- checkbox -->
                                    <input type="checkbox" value="">
                                    <!-- todo text -->
                                    <span class="text"><a  href="#" data-toggle="modal" data-target="#specification" aria-expanded="false">1. {{__('Specification of the ontology')}}</a></span>
                                    <!-- Emphasis label -->
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#specification" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#acquisitionExtractionKnowledge" aria-expanded="false">2. {{__('Acquisition and extraction of knowledge')}}</a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#acquisitionExtractionKnowledge" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a  href="#" data-toggle="modal" data-target="#conceptualization" aria-expanded="false"> 3. {{__('Conceptualization')}}</a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#conceptualization" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a  href="#" data-toggle="modal" data-target="#ontologicalGrounding" aria-expanded="false"> 4. {{__('Ontological grounding')}} </a></span>
                                    <div class="tools">
                                        <a href="#"  data-toggle="modal" data-target="#ontologicalGrounding" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li class="">
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#formalization" aria-expanded="false"> 5. {{__('Formalization of the ontology')}} </a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#formalization" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#evaluation" aria-expanded="false"> 6. {{__('Evaluation of the ontology')}} </a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#evaluation" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#documentation" aria-expanded="false"> 7. {{__('Documentation')}} </a></span>
                                    <div class="tools">
                                        <a href="#" data-toggle="modal" data-target="#documentation" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" value="">
                                    <span class="text"><a href="#" data-toggle="modal" data-target="#publication" aria-expanded="false"> 8. {{__('Publication of the ontology')}} </a></span>
                                    <div  class="tools">
                                        <a href="#" data-toggle="modal" data-target="#publication" aria-expanded="false"><i class="fa fa-info fa-2x"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix no-border methodology-footer">
                            <h4>{{__('Your progress')}}: </h4>
                            <div class="progress progress active">
                                <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 0">
                                    <span id="progress-text" class="">0% {{__('Complete')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.tips menu -->

    <div class="tab modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('External Ontology Databases')}}</strong>
                    </h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Specification of the ontology')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{__('In this phase, the developer performs the specification of the ontology through a template, which has to contain at least information about: the domain and scope of the ontology, its general purpose, its audience, scenarios for its application and the required degree of formality. In addition, the developer establishes the coverage of the  ontology by describing its starting point, its limits within the domain and competency questions.')}}
                    </p>
                    <p>
                        {{__('Once you have saved your ontology, you will have the option to edit your information in the ontology management area which can be found at the top of the page or by')}} <a href="{{route('ontologies.index', app()->getLocale())}}">{{__('clicking here')}}</a></p>
                    <img alt="superior-menu" src="{{asset('css/images/Methodology/menu-superior.png')}}">
                    <hr>
                    <p>{{__('After clicking on the My Ontologies button you will be redirected to a page containing all your ontologies made and you can edit each one. Click the button below to access all information on that ontology.')}}</p>
                    <img alt="ontology-info" src="{{asset('css/images/Methodology/edit-ontology.png')}}">
                    <hr>
                    <p>{{__('After clicking the button you will be redirected to the ontology page and can make the necessary changes.')}}</p>
                    <img style="width: 90%" alt="ontology-info" src="{{asset('css/images/Methodology/info.png')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="methodologyDefinition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Definition')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{__('OntoForInfoScience is a detailed methodology for construction of ontologies that details each step of the ontology development cycle. The goal of such methodology is to enable experts in Knowledge Organization to overcome the technical jargon difficulties, as well as logical and philosophical issues that involve the ontology development (Mendonça, 2016).The methodology OntoForInfoScience consists of nine phases:')}}
                    </p>
                    <ul>
                        <li>
                            1) {{__('Specification of the ontology')}}
                        </li>
                        <li>
                            2) {{__('Acquisition and extraction of knowledge')}}
                        </li>
                        <li>
                            3) {{__('Conceptualization')}}
                        </li>
                        <li>
                            4) {{__('Ontological grounding')}}
                        </li>
                        <li>
                            5) {{__('Formalization of the ontology')}}
                        </li>
                        <li>
                            6) {{__('Evaluation of the ontology')}}
                        </li>
                        <li>
                            7) {{__('Documentation')}}
                        </li>
                        <li>
                            8) {{__('Publication of the ontology')}}
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="acquisitionExtractionKnowledge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Acquisition and extraction of knowledge')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{__('Phase 2 consists of the knowledge acquisition, which encompasses the selection of materials to be approached (about the subject of the domain) and the selection of methods for extracting knowledge. Within OntoForInfoScience, these activities are conducted in a way that mixes different methods, like: textual analysis of books and papers, automatic terminological extraction, semi-automatic methods for identification of concepts, to mention a few.')}}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="conceptualization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Conceptualization')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('Phase 3 concerns conceptualization, when the developer performs activities of identification and analysis of the concepts that are candidates to classes in the ontology. In addition, the developer promotes the knowledge organization so that one is able to obtain relations, properties and constraints of the ontology. The more appropriate way to represent the conceptualization of ontology it is through of a graphical conceptual model, representing conceptual relations between identified concepts through graphs or similar structures.In the Onto4AllEditor, the Phase 3 must be performed in ')}}
                        <strong>{{__('this page using the graphical editor')}}</strong>.
                        {{__('You can access this page again by clicking in the “Ontology Editor” on the menu')}}
                    </p>
                    <img class="img-max-width" alt="editor" src="{{asset('css/images/Methodology/editor.png')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="ontologicalGrounding" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Ontological grounding')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{__('Phase 4 corresponds to the activity of ontological grounding in which the developer surveys top-levels ontologies to be used as starting points. Developers choose the top-level ontology more suitable to their aims in considering the underlying philosophical approach that will justify modeling decisions. From the operational point of view, the developer imports selected top-level ontology to an ontology editor tool for successful implementation.')}}
                    </p>
                    <p>
                        <strong>{{__('You can edit your previous saved ontologies using the button open in the editor on the right sidebar')}}</strong>
                    </p>
                    <img class="img-max-width" alt="import" src="{{asset('css/images/Methodology/importFromSidebar.png')}}">
                    <p>
                        <strong>
                            {{__('You can import other ontologies to this editor if they have been created using the Onto4AllEditor and have a .XML extension. You can also import OWL files made by other editors (Beware that this function only works for valid OWL files with right syntax. If you have any issues with this feature, please, contact us). All ontologies exported by this editor can be imported in later projects.Using the editor menu, click on the file button and then on the import as showed below:')}}
                        </strong>
                    </p>
                    <img class="img-max-width" alt="import" src="{{asset('css/images/Methodology/import.png')}}">
                    <p>{{__('Select a valid file from your computer using the choose file button or drag a file direct to the box and then click in import')}}</p>
                    <img class="img-max-width" alt="select-file" src="{{asset('css/images/Methodology/select-file.png')}}">
                    <p>{{__('After that, your imported ontology will be showing on the editor')}}</p>
                    <img class="img-max-width" alt="pizza ontology" src="{{asset('css/images/Methodology/pizza.png')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="formalization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Formalization of the ontology')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{__('In this phase, the developer produces a formal description of the domain from the conceptualization of the prior phase 3. Activities of phase 5 are:')}}
                    </p>
                        <ul>
                            <li>
                                5.1){{__('to construct general taxonomy of the ontology based on previously selected top-level taxonomy (in the Onto4AllEditor, this activity must be performed in the Ontology Editor, the page you are right now)')}}
                                <img class="img-max-width" alt="properties" src="{{asset('css/images/Methodology/editor.png')}}">
                            </li>
                            <li>
                                5.2) {{__('to define descriptive properties of the classes involving textual attributes as names, synonyms, definitions and annotations (in the Onto4AllEditor, this activity must be performed in the editor, clicking under a class or relation with the right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the class/relation and pressing CTRL + M))')}}
                                <img alt="properties" src="{{asset('css/images/Methodology/propriedades.png')}}">
                            </li>
                            <li>
                                5.3) {{__('to create formal definitions for each class using a logical language, so that the formal definition is able to be derived from the textual definitions created previously')}}
                            </li>
                            <li>
                                5.4) {{__('to define properties of classes, involving attributes as data types, cardinality, existential and universal quantifiers (in the Onto4AllEditor, this activity must be performed in the menu “Ontology Editor”, clicking under a class or relation with the right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the class/relation and pressing CTRL + M))')}}
                                <img alt="properties" src="{{asset('css/images/Methodology/propriedades.png')}}">
                                <img class="img-max-width" alt="properties" src="{{asset('css/images/Methodology/class-properties.png')}}">
                            </li>
                            <li>
                                5.5) {{__('to create instances for ontological classes (in the Onto4AllEditor, this activity must be performed in the Ontology Editor, adding the symbol “Instance” (rectangle) to the ontology in the drawing area, this symbol can be find on the ontology palette, in the left of the editor)')}}
                            </li>
                            <li>
                                5.6) {{__('to specify ontological relations, consisting of the application of a defined set of rules and principles carrying out the transformation of conceptual relations into formal relations (in the Onto4AllEditor, this activity must be performed in the editor, clicking under a class or relation with the right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the relation and pressing CTRL + M)).')}}
                                <img class="img-max-width" alt="properties" src="{{asset('css/images/Methodology/relation.png')}}">
                                <img class="img-max-width" alt="properties" src="{{asset('css/images/Methodology/relation-properties.png')}}">
                            </li>
                        </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="evaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Evaluation of the ontology')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{__('The evaluation of the ontology correspond to the application of a set of criteria allowing one to perform both the ontological validation (validation of the correspondence between ontology and the real world) and the ontological verification (analysis of the ontology with respect to the correctness of its construction). Examples of validation criteria are: non-recursivity in definitions, the specification of different types of part_of relations, the definition of inverse relations, and the creation of the cardinalities.In the Onto4AllEditor, the Phase 6 is performed automatically by the editor through of the functionality Warnings Console, that suggests good modeling practices for the current drawn ontology.')}}
                    </p>
                    <img class="img-max-width" alt="console" src="{{asset('css/images/Methodology/console.png')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="documentation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Documentation')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{__('In phase 7, documentation of all activities performed along the ontology development cycle is organized. The production of documentation occurs during all the time the ontology has been constructed. The content of the documentation encompasses the document of specification (from phase 1), documents of reference about the domain (from phase 2), the set of conceptual models (from phase 3), reused ontologies (phases 4 and 5), ontological and formal content (phase 5), and other useful')}}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab modal fade" id="publication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Publication of the ontology')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('In phase 8 the developer makes the ontological artifact available in a way that be downloaded and properly visualized by a community of users.You can download the ontology you just draw by clicking in the file menu and then in the export submenu')}}
                    </p>
                    <img class="img-max-width" alt="export" src="{{asset('css/images/Methodology/export.png')}}">
                    <p>{{__('You can export your ontology in XML, OWL or SVG (image).When you do that your ontology is also saved in your account, you can look all the ontologies you made by clicking on the File Manager menu on the top of the page.')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">
                        <strong>{{__('Warnings Console')}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('The warnings console is the way our editor tells you good modeling practices you should implement when building a ontology.This console will show you warnings that will help you build a better ontology.')}}
                        <a target="_blank" href="{{route('warningIndex', app()->getLocale())}}">{{__('Click here')}}</a>
                        {{__('to see all the warnings our console track. We will be updating this console with more warnings in the future,')}}
                        <a href="{{route('help', app()->getLocale())}}">{{__('contact us')}}</a>
                        {{__('if you had any problem with this feature.')}}
                    </p>
                    <img class="img-max-width" alt="export" src="{{asset('css/images/warningConsole.png')}}">
                    <p>
                        {{__('Here you can see that the pizza ontology have several warnings that need to be solved.')}}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!--./Warning Console Info modal -->



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
    <!--
    <span id="night-mode" class="badge bg-green-gradient tracker">
        <a style="color: white;"   href="#"><i class="fa fa-fw fa-moon-o"></i></a>
    </span>-->

    <a download="ontology-report.txt" class="tracker"  href="#" id="download-ontology-report">
        <span data-toggle="tooltip" title="" class="badge bg-green tracker">
                    <i class="fa fa-fw fa-file-text-o"></i>
        </span>
    </a>

    <a class="tracker" id="control-sidebar" href="#" data-toggle="control-sidebar">
        <i class="fa fa-1.5x fa-fw fa-exchange "></i>
    </a>
    <!-- ./Tracker spans  -->

    <a id="open-ontology"  class="geItem geStatus btn btn-default editor-timeline-item" data-toggle="modal" data-target="#ontology-manager" ><i class="fa fa-fw fa-folder-open"></i> {{__('Open Ontology Manager')}}</a>
    <a id="edit-ontology"  class="geItem geStatus btn btn-default editor-timeline-item" data-toggle="modal" data-target="#edit-ontology-modal" ><i class="fa fa-fw fa-edit"></i> {{__('Edit Ontology Info')}}</a>
    <a id="save-ontology"  class="geItem geStatus btn btn-default editor-timeline-item unsaved" ><i class="fa fa-fw fa-save"></i> {{__('Unsaved changes. Click here to save')}}</a>
    <a id="ontology-name"  class="geItem geStatus btn btn-default editor-timeline-item " data-toggle="modal" data-target="#edit-ontology-modal"><i class="fa fa-fw fa-object-group"></i>{{__('Current Ontology: None')}}</a>

    <!-- Edit Ontology -->
    <div class="modal fade" id="edit-ontology-modal" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{__('Edit Current Ontology')}}</h4>
                </div>
                <div class="modal-body">
                        <input id="id" name="id" type="hidden">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>{{__('Name')}}</label>
                                    <input id="name" required value="{{__('New_Ontology')}}" name="name" type="text" class="form-control"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Created By')}}</label>
                                    <input disabled value="{{auth()->user()->name}}" name="created_by" type="text"
                                           class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div  class="form-group">
                                    <label>Publication Date</label>
                                    <input id="publication-date" value="" name="publication_date" type="date"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Last Uploaded</label>
                                    <input id="last-uploaded" value="" name="last_uploaded" type="date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3"
                                      placeholder="Enter ..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input id="link" value="" name="link" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Domain</label>
                                    <input id="domain" value="" name="domain" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>General Purpose</label>
                            <input id="general-purpose" value="" name="general_purpose" type="text" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Profile Users</label>
                                    <input id="profile-users"  value="" name="profile_users" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Intended Use</label>
                                    <input id="intended-use"  value="" name="intended_use" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type of Ontology</label>
                                    <input id="type-of-ontology"  value="" name="type_of_ontology" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Degree of Formality</label>
                                    <input id="degree-of-formality"  value="" name="degree_of_formality" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Scope</label>
                                    <input id="scope"  value="" name="scope" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Competence Questions</label>
                            <input id="competence-questions"  value="" name="competence_questions" type="text" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{__('Close')}}</button>
                    <button onclick="$('#save-ontology').click()" type="button" class="btn btn-success pull-right" data-dismiss="modal">{{__('Save Changes')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- Ontology Manager -->
    <div class="modal fade" id="ontology-manager" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{__('Ontology Manager')}}</h4>

                </div>
                <div class="modal-body">
                    @if($ontologies->count() == 0)
                        <p>{{__('You dont have any ontologies saved in our ontology manager yet')}}</p>
                    @else
                    <ul class="timeline">
                            @foreach($ontologies as $ontology)
                            <li>
                                <i class="fa fa-object-group bg-green"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{__('Created at')}}: {{date("d-m-Y | H:i e", strtotime($ontology->created_at))}}</span>
                                    <span class="time"><i class="fa fa-clock-o"></i> {{__('Last update')}}: {{date("d-m-Y | H:i e", strtotime($ontology->updated_at))}}</span>
                                    @if($ontology->favourite == 1)
                                        <span class="time"><i style="color: #ffe70a" class="fa fa-fw fa-star"></i></span>
                                    @endif

                                    <h3 class="timeline-header">
                                        <a href="{{route('ontologies.show', ['locale' => app()->getLocale(), 'ontology' => $ontology->id])}}">{{$ontology->name}}</a>
                                        @if($ontology->created_at !== $ontology->updated_at)
                                            {{__('was updated')}}
                                        @else
                                            {{__('was created')}}
                                        @endif
                                    </h3>

                                    <div class="timeline-body">
                                        @if($ontology->description)
                                        <strong><i class="fa fa-book margin-r-5"></i>{{__('Description')}}</strong>
                                        <p class="text-muted">
                                            {{$ontology->description}}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="timeline-footer">
                                        <a data-dismiss="modal" id="{{$ontology->id}}"  class="btn btn-default editor-timeline-item openOntology"  href="#"><i class="fa fa-fw fa-object-group"></i> {{__('Open in the editor')}}</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                         @endif
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <!-- LOADS MXGRAPH GRAPHEDITOR AND ITS FUNCTIONS -->

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

    <script type="text/javascript" src="{{asset('js/OpenDiagram.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/SaveOntology.js')}}"></script>

    <!-- Tooltips -->
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@5"></script>
    <!-- MxGraph -->
    <script type="text/javascript" src="{{asset('grapheditor/js/Init.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/deflate/pako.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/deflate/base64.js')}}"></script>

    <script type="text/javascript" src="{{asset('grapheditor/jscolor/jscolor.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/sanitizer/sanitizer.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/mxClient.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/EditorUi.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Editor.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/SidebarO4A.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Graph.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Format.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Shapes.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Actions.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Menus.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Toolbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Dialogs.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/HomeFunctions.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Compiler.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/NightMode.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Tooltips.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Report.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Converter.js')}}"></script>
    <script defer type="text/javascript" src="{{asset('js/SearchTip.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/BuildMenu.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>

    <script type="text/javascript">
        // Extends EditorUi to update I/O action states based on availability of backend
        (function()
        {
            var editorUiInit = EditorUi.prototype.init;

            EditorUi.prototype.init = function()
            {
                editorUiInit.apply(this, arguments);
                this.actions.get('export').setEnabled(false);

                // Updates action states which require a backend
                if (!Editor.useLocalStorage)
                {
                    mxUtils.post(OPEN_URL, '', mxUtils.bind(this, function(req)
                    {
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
            mxUtils.getAll([bundle, STYLE_PATH + '/default.xml'], function(xhr)
            {
                // Adds bundle text to resources
                mxResources.parse(xhr[0].getText());

                // Configures the default graph theme
                var themes = new Object();
                themes[Graph.prototype.defaultThemeName] = xhr[1].getDocumentElement();

                // Main
                new EditorUi(new Editor(urlParams['chrome'] == '0', themes));
            }, function()
            {
                document.body.innerHTML = '<center style="margin-top:10%;">Error loading resource files. Please check browser console.</center>';
            });
        })();
    </script>

@stop

