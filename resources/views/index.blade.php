@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<div id="loading"></div>
@stop

@section('content')

<script>
    const Warnings_Console = '{{__('Warnings Console')}}';
    const Welcome = '{{__('Welcome')}}';
    const Click_to_see_more_information = '{{__('Click to see more information!')}}';
    const Downloads_a_txt_file_containing_all_the_current_warnings_in_the_ontology = '{{__('Downloads a .txt file containing all the current warnings in the ontology')}}'
    const Download_a_report_with_all_the_information_of_your_current_ontology = '{{__('Download a report with all the information of your current ontology')}}';
    const Methodology_OntoForInfoScience = '{{__('Methodology OntoForInfoScience')}}';
    const Tips = '{{__('Tips')}}';
    const The_number_of_classes_in_your_current_ontology = '{{__('The number of classes in your current ontology')}}';
    const The_number_of_relations_in_your_current_ontology = '{{__('The number of relations in your current ontology')}}';
    const The_number_of_instances_in_your_current_ontology = '{{__('The number of instances in your current ontology')}}';
    const The_number_of_errors_in_your_current_ontology = '{{__('The number of errors in your current ontology')}}';
    const The_number_of_warnings_in_your_current_ontology = '{{__('The number of warnings in your current ontology')}}';
    const LogoMini = '{{asset("css/images/LogoMini.png")}}';
    const You_dont_have_any_warnings = '{{__('You dont have any warnings.')}}'
    const Chat_with_other_collaborators_of_this_ontology_messages_are_saved_and_can_be_read_at_any_time_between_collaborators= '{{__('Chat with other collaborators of this ontology, messages are saved and can be read at any time between collaborators.')}}';
    const Enter_message = '{{__('Enter message...')}}';
    const Send= '{{__('Send')}}';
    const Select_a_element_in_your_ontology = '{{__('Select a element in your ontology')}}';
    const The_warnings_console_is_the_way_our_editor_tells_you_good_modeling_practices_you_should_implement_when_building_a_ontologyThis_console_will_show_you_warnings_that_will_help_you_build_a_better_ontology = '{{__('The warnings console is the way our editor tells you good modeling practices you should implement when building a ontology.This console will show you warnings that will help you build a better ontology.')}}';
    const Click_here = '{{__('Click here')}}';
    const warningIndex = '{{route("warningIndex", app()->getLocale())}}';
    const to_see_all_the_warnings_our_console_track_We_will_be_updating_this_console_with_more_warnings_in_the_future = '{{__('to see all the warnings our console track. We will be updating this console with more warnings in the future,')}}';
    const help = '{{route("help", app()->getLocale())}}';
    const contact_us = '{{__('contact us')}}';
    const if_you_had_any_problem_with_this_feature = '{{__('if you had any problem with this feature.')}}';
    const warningConsole = '{{asset("css/images/warningConsole.png")}}';
    const Close = '{{__('Close')}}';
    const Edit_Current_Ontology = '{{__('Edit Current Ontology')}}';
    const Save_the_ontology_first_to_see_its_IRI = '{{__('Save the ontology first to see its IRI')}}';
    const Publication_Date = '{{__('Publication Date')}}';
    const Last_Uploaded = '{{__('Last Uploaded')}}';
    const Created_By = '{{__('Created By')}}';
    const Description = '{{__('Description')}}';
    const Link = '{{__('Link')}}';
    const Domain = '{{__('Domain')}}';
    const General_Purpose = '{{__('General Purpose')}}';
    const Profile_Users = '{{__('Profile Users')}}';
    const Intended_Use = '{{__('Intended Use')}}';
    const Type_of_Ontology = '{{__('Type of Ontology')}}';
    const Degree_of_Formality = '{{__('Degree of Formality')}}';
    const Scope = '{{__('Scope')}}';
    const Competence_Questions = '{{__('Competence Questions')}}';
    const Namespaces = '{{__('Namespaces')}}';
    const Collaborators = '{{__('Collaborators')}}';
    const Insert_usernames_to_share_your_ontology_with_other_Onto4ALL_users = '{{__('Insert usernames to share your ontology with other Onto4ALL users')}}';
    const Collaborators_will_be_able_to_edit_this_ontology = '{{__('Collaborators will be able to edit this ontology')}}';
    const You = '{{__('You')}}';
    const Save_Changes = '{{__('Save Changes')}}';
    const Insert_usernames_here = '{{__('Insert usernames here')}}';
    const Methodology = '{{__('Methodology')}}';
    const Specification_of_the_ontology = '{{__('Specification of the ontology')}}';
    const Acquisition_and_extraction_of_knowledge = '{{__('Acquisition and extraction of knowledge')}}';
    const Conceptualization = '{{__('Conceptualization')}}';
    const Ontological_grounding = '{{__('Ontological grounding')}}';
    const Formalization_of_the_ontology = '{{__('Formalization of the ontology')}}';
    const Evaluation_of_the_ontology = '{{__('Evaluation of the ontology')}}';
    const Documentation = '{{__('Documentation')}}';
    const Publication_of_the_ontology = '{{__('Publication of the ontology')}}';
    const In_this_phase_the_developer_performs_the_specification_of_the_ontology_through_a_template_which_has_to_contain_at_least_information_about_the_domain_and_scope_of_the_ontology_its_general_purpose_its_audience_scenarios_for_its_application_and_the_required_degree_of_formality_In_addition_the_developer_establishes_the_coverage_of_the__ontology_by_describing_its_starting_point_its_limits_within_the_domain_and_competency_questions = '{{__('In this phase, the developer performs the specification of the ontology through a template, which has to contain at least information about: the domain and scope of the ontology, its general purpose, its audience, scenarios for its application and the required degree of formality. In addition, the developer establishes the coverage of the ontology by describing its starting point, its limits within the domain and competency questions.')}}';
    const You_can_edit_the_information_of_a_ontology_by_clicking_on_the_Edit_Ontology_Info_button_or_by_accessing_the_ontology_manager_and_selecting_the_ontology_you_want_and_then_clicking_in_the_Update_button = '{{__('You can edit the information of a ontology by clicking on the Edit Ontology Info button or by accessing the ontology manager and selecting the ontology you want and then clicking in the Update button')}}';
    const menu_superior = "{{asset('css/images/Methodology/menu-superior.png')}}";
    const After_clicking_the_button_a_modal_will_show_up_with_all_the_information_the_ontology_has = '{{__('After clicking the button a modal will show up with all the information the ontology has.')}}';
    const info = "{{asset('css/images/Methodology/info.png')}}";
    const Phase_2_consists_of_the_knowledge_acquisition_which_encompasses_the_selection_of_materials_to_be_approached_about_the_subject_of_the_domain_and_the_selection_of_methods_for_extracting_knowledge_Within_OntoForInfoScience_these_activities_are_conducted_in_a_way_that_mixes_different_methods_like_textual_analysis_of_books_and_papers_automatic_terminological_extraction_semi_automatic_methods_for_identification_of_concepts_to_mention_a_few = '{{__('Phase 2 consists of the knowledge acquisition, which encompasses the selection of materials to be approached (about the subject of the domain) and the selection of methods for extracting knowledge. Within OntoForInfoScience, these activities are conducted in a way that mixes different methods, like: textual analysis of books and papers, automatic terminological extraction, semi-automatic methods for identification of concepts, to mention a few.')}}';
    const Phase_3_concerns_conceptualization_when_the_developer_performs_activities_of_identification_and_analysis_of_the_concepts_that_are_candidates_to_classes_in_the_ontology_In_addition_the_developer_promotes_the_knowledge_organization_so_that_one_is_able_to_obtain_relations_properties_and_constraints_of_the_ontology_The_more_appropriate_way_to_represent_the_conceptualization_of_ontology_it_is_through_of_a_graphical_conceptual_model_representing_conceptual_relations_between_identified_concepts_through_graphs_or_similar_structuresIn_the_Onto4AllEditor_the_Phase_3_must_be_performed_in = '{{__('Phase 3 concerns conceptualization, when the developer performs activities of identification and analysis of the concepts that are candidates to classes in the ontology. In addition, the developer promotes the knowledge organization so that one is able to obtain relations, properties and constraints of the ontology. The more appropriate way to represent the conceptualization of ontology it is through of a graphical conceptual model representing conceptual relations between identified concepts through graphs or similar structuresIn the Onto4AllEditor the Phase 3 must be performed in ')}}';
    const this_page_using_the_graphical_editor = '{{__('this page using the graphical editor')}}';
    const You_can_access_this_page_again_by_clicking_in_the_Ontology_Editor_on_the_menu = '{{__('You can access this page again by clicking in the “Ontology Editor” on the menu')}}';
    const Phase_4_corresponds_to_the_activity_of_ontological_grounding_in_which_the_developer_surveys_top_levels_ontologies_to_be_used_as_starting_points_Developers_choose_the_top_level_ontology_more_suitable_to_their_aims_in_considering_the_underlying_philosophical_approach_that_will_justify_modeling_decisions_From_the_operational_point_of_view_the_developer_imports_selected_top_level_ontology_to_an_ontology_editor_tool_for_successful_implementation = '{{__('Phase 4 corresponds to the activity of ontological grounding in which the developer surveys top-levels ontologies to be used as starting points. Developers choose the top-level ontology more suitable to their aims in considering the underlying philosophical approach that will justify modeling decisions. From the operational point of view, the developer imports selected top-level ontology to an ontology editor tool for successful implementation.')}}';
    const You_can_edit_your_previous_saved_ontologies_using_the_button_open_in_the_editor_on_the_right_sidebar = '{{__('You can edit your previous saved ontologies using the button open in the editor on the right sidebar')}}';
    const importFromSidebar = "{{asset('css/images/Methodology/importFromSidebar.png')}}";
    const Select_a_valid_file_from_your_computer_using_the_choose_file_button_or_drag_a_file_direct_to_the_box_and_then_click_in_import = '{{__('Select a valid file from your computer using the choose file button or drag a file direct to the box and then click in import')}}';
    const select_file = "{{asset('css/images/Methodology/select-file.png')}}";
    const After_that_your_imported_ontology_will_be_showing_on_the_editor = '{{__('After that, your imported ontology will be showing on the editor')}}';
    const pizza = "{{asset('css/images/Methodology/pizza.png')}}";
    const In_this_phase_the_developer_produces_a_formal_description_of_the_domain_from_the_conceptualization_of_the_prior_phase_3_Activities_of_phase_5_are = '{{__('In this phase, the developer produces a formal description of the domain from the conceptualization of the prior phase 3. Activities of phase 5 are:')}}';
    const to_construct_general_taxonomy_of_the_ontology_based_on_previously_selected_top_level_taxonomy_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_Ontology_Editor_the_page_you_are_right_now = '{{__('to construct general taxonomy of the ontology based on previously selected top-level taxonomy (in the Onto4AllEditor, this activity must be performed in the Ontology Editor, the page you are right now)')}}';
    const to_create_formal_definitions_for_each_class_using_a_logical_language_so_that_the_formal_definition_is_able_to_be_derived_from_the_textual_definitions_created_previously = '{{__('to create formal definitions for each class using a logical language, so that the formal definition is able to be derived from the textual definitions created previously')}}';
    const to_create_instances_for_ontological_classes_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_Ontology_Editor_adding_the_symbol_Instance_rectangle_to_the_ontology_in_the_drawing_area_this_symbol_can_be_find_on_the_ontology_palette_in_the_left_of_the_editor = '{{__('to create instances for ontological classes (in the Onto4AllEditor, this activity must be performed in the Ontology Editor, adding the symbol “Instance” (rectangle) to the ontology in the drawing area, this symbol can be find on the ontology palette, in the left of the editor)')}}';
    const editorIMG = "{{asset('css/images/Methodology/editor.png')}}";
    const propriedades = "{{asset('css/images/Methodology/propriedades.png')}}";
    const class_properties = "{{asset('css/images/Methodology/class-properties.png')}}";
    const relation = "{{asset('css/images/Methodology/relation.png')}}";
    const relation_properties = "{{asset('css/images/Methodology/relation-properties.png')}}";
    const consoleIMG = "{{asset('css/images/Methodology/console.png')}}";
    const In_phase_7_documentation_of_all_activities_performed_along_the_ontology_development_cycle_is_organized_The_production_of_documentation_occurs_during_all_the_time_the_ontology_has_been_constructed_The_content_of_the_documentation_encompasses_the_document_of_specification_from_phase_1_documents_of_reference_about_the_domain_from_phase_2_the_set_of_conceptual_models_from_phase_3_reused_ontologies_phases_4_and_5_ontological_and_formal_content_phase_5_and_other_useful = '{{__('In phase 7, documentation of all activities performed along the ontology development cycle is organized. The production of documentation occurs during all the time the ontology has been constructed. The content of the documentation encompasses the document of specification (from phase 1), documents of reference about the domain (from phase 2), the set of conceptual models (from phase 3), reused ontologies (phases 4 and 5), ontological and formal content (phase 5), and other useful')}}';
    const In_phase_8_the_developer_makes_the_ontological_artifact_available_in_a_way_that_be_downloaded_and_properly_visualized_by_a_community_of_users_You_can_download_the_ontology_you_just_draw_by_clicking_in_the_file_menu_and_then_in_the_export_submenu = '{{__('In phase 8 the developer makes the ontological artifact available in a way that be downloaded and properly visualized by a community of users.You can download the ontology you just draw by clicking in the file menu and then in the export submenu')}}';
    const exporte = "{{asset('css/images/Methodology/export.png')}}";
    const You_can_export_your_ontology_in_XML_OWL_or_SVG_image_When_you_do_that_your_ontology_is_also_saved_in_your_account_you_can_look_all_the_ontologies_you_made_by_clicking_on_the_File_Manager_menu_on_the_top_of_the_page = '{{__('You can export your ontology in XML, OWL or SVG (image).When you do that your ontology is also saved in your account, you can look all the ontologies you made by clicking on the File Manager menu on the top of the page.')}}';
    const OntoForInfoScience_is_a_detailed_methodology_for_construction_of_ontologies_that_details_each_step_of_the_ontology_development_cycle_The_goal_of_such_methodology_is_to_enable_experts_in_Knowledge_Organization_to_overcome_the_technical_jargon_difficulties_as_well_as_logical_and_philosophical_issues_that_involve_the_ontology_development_Mendonça_2016_The_methodology_OntoForInfoScience_consists_of_nine_phases = '{{__('OntoForInfoScience is a detailed methodology for construction of ontologies that details each step of the ontology development cycle. The goal of such methodology is to enable experts in Knowledge Organization to overcome the technical jargon difficulties, as well as logical and philosophical issues that involve the ontology development (Mendonça, 2016).The methodology OntoForInfoScience consists of nine phases:')}}';
    const Class_Expression_Editor = '{{__('Class Expression Editor')}}';
    const None_axiom_to_check = '{{__('None axiom to check!')}}';
    const You_can_import_other_ontologies_to_this_editor_if_they_have_been_created_using_the_Onto4AllEditor_and_have_a_XML_extension_You_can_also_import_OWL_files_made_by_other_editors_Beware_that_this_function_only_works_for_valid_OWL_files_with_right_syntax_If_you_have_any_issues_with_this_feature_please_contact_us_All_ontologies_exported_by_this_editor_can_be_imported_in_later_projectsUsing_the_editor_menu_click_on_the_file_button_and_then_on_the_import_as_showed_below = "{{__('You can import other ontologies to this editor if they have been created using the Onto4AllEditor and have a .XML extension. You can also import OWL files made by other editors (Beware that this function only works for valid OWL files with right syntax. If you have any issues with this feature, please, contact us). All ontologies exported by this editor can be imported in later projects.Using the editor menu, click on the file button and then on the import as showed below:')}}";
    const to_define_descriptive_properties_of_the_classes_involving_textual_attributes_as_names_synonyms_definitions_and_annotations_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_editor_clicking_under_a_class_or_relation_with_the_right_button_of_the_mouse_and_choosing_the_function_Edit_Properties_in_the_submenu_or_selecting_the_classrelation_and_pressing_CTRL_M = "{{__('to define descriptive properties of the classes involving textual attributes as names, synonyms, definitions and annotations (in the Onto4AllEditor, this activity must be performed in the editor, clicking under a class or relation with the right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the class/relation and pressing CTRL + M))')}}";
    const to_define_properties_of_classes_involving_attributes_as_data_types_cardinality_existential_and_universal_quantifiers_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_menu_Ontology_Editor_clicking_under_a_class_or_relation_with_the_right_button_of_the_mouse_and_choosing_the_function_Edit_Properties_in_the_submenu_or_selecting_the_classrelation_and_pressing_CTRL_M = "{{__('to define properties of classes, involving attributes as data types, cardinality, existential and universal quantifiers (in the Onto4AllEditor, this activity must be performed in the menu “Ontology Editor”, clicking under a class or relation with the right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the class/relation and pressing CTRL + M))')}}";
    const to_specify_ontological_relations_consisting_of_the_application_of_a_defined_set_of_rules_and_principles_carrying_out_the_transformation_of_conceptual_relations_into_formal_relations_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_editor_clicking_under_a_class_or_relation_with_the_right_button_of_the_mouse_and_choosing_the_function_Edit_Properties_in_the_submenu_or_selecting_the_relation_and_pressing_CTRL_M = "{{__('to specify ontological relations, consisting of the application of a defined set of rules and principles carrying out the transformation of conceptual relations into formal relations (in the Onto4AllEditor, this activity must be performed in the editor, clicking under a class or relation with the right button of the mouse and choosing the function Edit Properties in the submenu (or selecting the relation and pressing CTRL + M)).')}}";
    const The_evaluation_of_the_ontology_correspond_to_the_application_of_a_set_of_criteria_allowing_one_to_perform_both_the_ontological_validation_validation_of_the_correspondence_between_ontology_and_the_real_world_and_the_ontological_verification_analysis_of_the_ontology_with_respect_to_the_correctness_of_its_construction_Examples_of_validation_criteria_are_non_recursivity_in_definitions_the_specification_of_different_types_of_part_of_relations_the_definition_of_inverse_relations_and_the_creation_of_the_cardinalitiesIn_the_Onto4AllEditor_the_Phase_6_is_performed_automatically_by_the_editor_through_of_the_functionality_Warnings_Console_that_suggests_good_modeling_practices_for_the_current_drawn_ontology = "{{__('The evaluation of the ontology correspond to the application of a set of criteria allowing one to perform both the ontological validation (validation of the correspondence between ontology and the real world) and the ontological verification (analysis of the ontology with respect to the correctness_of_its_construction_Examples_of_validation_criteria_are_non-recursivity_in_definitions_the_specification_of_different_types_of_part_of_relations_the_definition_of_inverse_relations_and_the_creation_of_the_cardinalitiesIn_the_Onto4AllEditor_the_Phase_6_is_performed_automatically_by_the_editor_through_of_the_functionality_Warnings_Console_that_suggests_good_modeling_practices_for_the_current_drawn_ontology')}}";
    const importIMG = "{{asset('css/images/Methodology/import.png')}}";

    var optionUsers = '';
    @foreach($users as $user)
        @if($user->id == Auth::user()->id)
            optionUsers += '<option value="{{$user->id}}" selected="selected" locked="locked">{{__("You")}}</option>';
        @else
            optionUsers += '<option value="{{$user->id}}">{{$user->name}}</option>';
        @endif
    @endforeach
    
</script>

<div class="hidden" id="app"></div>

<!-- Warning Console -->
<div id="warnings-console"></div>
<!--  ./Warning Console -->


<!-- Right Sidebar -->
<div id="siderbar"></div>
<!--./ Right Sidebar -->


<!-- Error Console Info modal -->
<div id='modal'></div>
<!--./Warning Console Info modal -->

<!-- Edit Ontology -->
<div id='ontologyForm'></div>
<!-- Edit Ontology -->



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
                            <span class="time"><i class="fa fa-user"></i> {{__('Created By')}}:
                                {{$ontology->user->name}}</span>
                            <span class="time"><i class="fa fa-clock-o"></i> {{__('Last update')}}:
                                {{date("d-m-Y | H:i e", strtotime($ontology->updated_at))}}</span>
                            @if($ontology->favourite == 1)
                            <span class="time"><i style="color: #f39c12" class="fa fa-fw fa-star"></i></span>
                            @endif

                            <h3 class="timeline-header">
                                <a class="openOntology" data-dismiss="modal" id="{{$ontology->id}}" href="">{{$ontology->name}}</a>
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
                                <a data-dismiss="modal" id="{{$ontology->id}}" class="btn btn-default editor-timeline-item openOntology" href="#"><i class="fa fa-fw fa-object-group"></i> {{__('Open in the editor')}}</a>
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

<!-- Tips Menu Modal -->
<div class="modal fade" id="tips-menu" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 style="text-align: center" class="modal-title">{{__('Tips')}}</h4>

            </div>
            <div class="modal-body">

                <div style="margin-bottom: 10px" id="searchBar" class="input-group input-group-sm">
                    <input value="" id="search-tip-input" type="text" class="form-control" placeholder="{{__('Search for tips')}}">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search-plus"></i></button>
                    </div>
                </div>
                <div id="menu-wrapper">
                    <div class="tab-content">
                        <div id="menu-scroll">
                            <div id="control-sidebar-theme-demo-options-tab table-search" class="tab-pane active table-search">
                                @foreach($relations as $ontologyRelation)
                                <div id="tipSearch" class="box box-default collapsed-box box-solid relation-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title title">{{$ontologyRelation->name}} <i class="fa fa-fw fa-long-arrow-right"></i></h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <dl>
                                            <dt>Definition</dt>
                                            <dd>{{$ontologyRelation->definition}}</dd>
                                            @if($ontologyRelation->semi_formal_definition)
                                            <dt>Semi Formal Definition</dt>
                                            <dd>{{$ontologyRelation->semi_formal_definition}}</dd>
                                            @endif
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
                                            @if(app()->getLocale() =='pt' && $ontologyRelation->label_pt)
                                            <dt>Label PT</dt>
                                            <dd>{{$ontologyRelation->label_pt}}</dd>
                                            @else
                                            <dt>Label</dt>
                                            <dd>{{$ontologyRelation->label}}</dd>
                                            @endif
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
                                        <h3 class="box-title title">{{$class->name}} <i class="fa fa-fw fa-circle-thin"></i>
                                        </h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <dl>
                                            <dt>Definition</dt>
                                            <dd>{{$class->definition}}</dd>
                                            @if($class->semi_formal_definition)
                                            <dt>Semi Formal Definition</dt>
                                            <dd>{{$class->semi_formal_definition}}</dd>
                                            @endif
                                            @if($class->formal_definition)
                                            <dt>Formal Definition (has_associated_axiom)</dt>
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
                                            @if(app()->getLocale() =='pt' && $ontologyRelation->label_pt)
                                            <dt>Label PT</dt>
                                            <dd>{{$ontologyRelation->label_pt}}</dd>
                                            @else
                                            <dt>Label</dt>
                                            <dd>{{$ontologyRelation->label}}</dd>
                                            @endif
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{__('Close')}}</button>
                {{__('External Ontology Databases')}}:
                <a href="http://www.ontobee.org/" target="_blank"> OntoBee | </a>
                <a href="https://bioportal.bioontology.org/" target="_blank"> BioPortal | </a>
                <a href="https://www.ebi.ac.uk/ols/index" target="_blank"> Ontology Lookup Service (OLS) | </a>
                <a href="http://swoogle.umbc.edu/2006/" target="_blank"> Swoogle | </a>
                <a href="http://resources.si.washington.edu/fma_browser1/" target="_blank"> Foundational Model Anatomy
                    Browser </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Methodology Menu Modal -->
<div id='methodology'></div>
<!-- Methodology Menu Modal -->

<!-- Class Expression Editor Modal -->
<div id='classExpressionEditor'></div>
<!--./Class Expression Editor Modal -->

<script src="{{ asset('js/app.js') }}"></script>


<!-- LOADS MXGRAPH GRAPHEDITOR AND ITS FUNCTIONS -->

<script type="text/javascript">
    // Parses URL parameters. Supported parameters are:
    // - lang=xy: Specifies the language of the user interface.
    // - touch=1: Enables a touch-style user interface.
    // - storage=local: Enables HTML5 local storage.
    // - chrome=0: Chromeless mode.
    var urlParams = (function(url) {
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

<!-- Onto4ALL -->
<script type="text/javascript" src="{{asset('js/Compiler.js')}}"></script>
<script type="text/javascript" src="{{asset('js/Converter.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ClassExpressionEditor.js')}}"></script>
<script type="text/javascript" src="{{asset('js/OntologyManager.js')}}"></script>
<script type="text/javascript" src="{{asset('js/Properties.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
</script>

<script type="text/javascript">
    // Extends EditorUi to update I/O action states based on availability of backend
    (function() {
        var editorUiInit = EditorUi.prototype.init;

        EditorUi.prototype.init = function() {
            editorUiInit.apply(this, arguments);
            this.actions.get('export').setEnabled(false);

            // Updates action states which require a backend
            if (!Editor.useLocalStorage) {
                mxUtils.post(OPEN_URL, '', mxUtils.bind(this, function(req) {
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
        mxUtils.getAll([bundle, STYLE_PATH + '/default.xml'], function(xhr) {
            // Adds bundle text to resources
            mxResources.parse(xhr[0].getText());

            // Configures the default graph theme
            var themes = new Object();
            themes[Graph.prototype.defaultThemeName] = xhr[1].getDocumentElement();

            // Main
            new EditorUi(new Editor(urlParams['chrome'] == '0', themes));
        }, function() {
            document.body.innerHTML =
                '<center style="margin-top:10%;">Error loading resource files. Please check browser console.</center>';
        });
    })();


    // ONTO4ALL JQUERY SCRIPTS

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    
    function onReady(callback) {
        var intervalId = window.setInterval(function () {
            if (document.getElementsByTagName('body')[0] !== undefined) {
                window.clearInterval(intervalId);
                callback.call(this);
            }
        }, 2000);
    }

    function setVisible(selector, visible) {
        document.querySelector(selector).style.display = visible ? 'block' : 'none';
    }

    function updateChat(id) {
        if (id > 0) {
            $.ajax({
                type: 'POST',
                url: '/updateChat',
                data: 'ontology_id=' + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(r) {
                    $("#chat-ontology").html(r);
                },
                error: function(e) {
                    console.log("Ocorreu um erro no update do chat: ");
                    console.log(e)
                }
            });
        }
    }

    $("#send_msg").click(function() {
        if (!$("#send_msg").is('[disabled]')) {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: $('form[id="form_send_msg"]').serialize() + "&ontology_id=" + document.getElementById('id').value,
                url: '/sendChat',
                async: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(r) {
                    if (r.status == "SUCESSO") {

                        var d = new Date,
                        dataFormatada = [d.getDate(),
                                d.getMonth()+1,
                                d.getFullYear()].join('/')+' '+
                                [d.getHours(),
                                d.getMinutes(),
                                d.getSeconds()].join(':');

                        $('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">{{ Auth::user()->name }}</span><span class="direct-chat-timestamp pull-left">' + dataFormatada +'</span></div><img class="direct-chat-img" src="{{ asset("storage/img/profile/" . Auth::user()->avatar_url) }}" alt="Imagem de perfil"><div class="direct-chat-text">' + $("#message").val() + '</div></div>').insertAfter($(".direct-chat-msg").last());

                        $("#message").val("");

                        if (document.getElementById('id').value > 0 && window.location.origin == ip_address) {
                            socket.emit('updateChat', document.getElementById('id').value);
                        }

                    }
                    if (r.status == "ERRO") {
                        alert(getTranslate("Unable to send the message, please try again later."));
                    }
                },
                error: function(e) {
                    console.log("Ajax erro: ");
                    console.log(e)
                }
            });
        }
    });

    onReady(function () {
        setVisible('body', true);
        setVisible('#loading', false);

        $("#chat").removeClass('hidden');
        if (document.getElementById('id').value > 0) {
            updateChat(document.getElementById('id').value);

            if (window.location.origin == ip_address) {
                socket.on('updateChat', (ontologyID) => {
                    if (ontologyID == document.getElementById('id').value) {
                        updateChat(document.getElementById('id').value);
                    }
                });
            }

        } else {
            $("#chat-ontology").html('<div class="direct-chat-msg"></div>');
        }

    });

    document.addEventListener("DOMContentLoaded", function() {

    // Select2 Plugin
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2(
            {theme: 'classic'}

        );
        $('.js-example-tags').select2({
            theme: 'classic',
            tags: true
        });
    });

    // Progress bar from the Methodology tab
    /*
    let percentage = document.getElementById('progress-bar').clientWidth / document.getElementById('progress-bar').offsetParent().clientWidth * 100;
    document.querySelector('input[type="checkbox"]').addEventListener('click', function () {
        if (this.checked) {
            this.closest('li').setAttribute('class', 'done');
            percentage = percentage + 12.5;
            document.getElementById('progress-bar').clientWidth = percentage + '%';
            document.getElementById('progress-bar').setAttribute('aria-valuenow', percentage);
            console.log(percentage);

        } else {
            this.closest('li').attr('class', '');
            percentage = percentage - 12.5;
            document.getElementById('progress-bar').clientWidth = percentage + '%';
            document.setAttribute('aria-valuenow', percentage);

        }
        document.getElementById('progress-text').textContent = percentage + "% complete";

    });*/
});

    document.getElementById('search-tip-input').addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        document.querySelectorAll('#menu-scroll .collapsed-box').filter(function () {
            if(this.textContent.toLowerCase().indexOf(value) > -1){
                this.style.visibility = "visible";
            }
            else{
                this.style.visibility = "hidden";
            }
        });
    });


</script>


@stop
