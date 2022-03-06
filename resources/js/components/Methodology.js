import React from 'react';
import ReactDOM from 'react-dom';

function Methodology(props) {
    return(
        <div className="modal fade" id="methodology-menu" style={{display: 'none'}}>
            <div className="modal-dialog modal-lg">
                <div className="modal-content">
                    <div className="modal-header">
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span></button>
                        <h4 style={{textAlign: 'center'}} className="modal-title">{Methodology}</h4>

                    </div>
                    <div className="modal-body">

                        <div className="nav-tabs-custom">
                            <ul className="nav nav-tabs">
                                <li className="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">1.
                                        {Specification_of_the_ontology} </a></li>
                                <li className=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">2.
                                        {Acquisition_and_extraction_of_knowledge}</a></li>
                                <li className=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">3.
                                        {Conceptualization}</a></li>
                                <li className=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">4.
                                        {Ontological_grounding}</a></li>
                                <li className=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">5.
                                        {Formalization_of_the_ontology}</a></li>
                                <li className=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">6.
                                        {Evaluation_of_the_ontology}</a></li>
                                <li className=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">7.
                                        {Documentation}</a></li>
                                <li className=""><a href="#tab_8" data-toggle="tab" aria-expanded="false">8.
                                        {Publication_of_the_ontology}</a></li>

                                <li className="pull-right"><a href="#tab_9" data-toggle="tab" aria-expanded="false" className="text-muted"><i className="fa fa-question-circle"></i></a></li>
                            </ul>
                            <div className="tab-content">
                                <div className="tab-pane active" id="tab_1">
                                    <p>
                                        {In_this_phase_the_developer_performs_the_specification_of_the_ontology_through_a_template_which_has_to_contain_at_least_information_about_the_domain_and_scope_of_the_ontology_its_general_purpose_its_audience_scenarios_for_its_application_and_the_required_degree_of_formality_In_addition_the_developer_establishes_the_coverage_of_the__ontology_by_describing_its_starting_point_its_limits_within_the_domain_and_competency_questions}
                                    </p>
                                    <p>
                                        {You_can_edit_the_information_of_a_ontology_by_clicking_on_the_Edit_Ontology_Info_button_or_by_accessing_the_ontology_manager_and_selecting_the_ontology_you_want_and_then_clicking_in_the_Update_button}
                                    </p>
                                    <img alt="superior-menu" src={menu_superior}></img>
                                    <hr/>
                                    <p>{After_clicking_the_button_a_modal_will_show_up_with_all_the_information_the_ontology_has}
                                    </p>
                                    <img style={{width: '90%'}} alt="ontology-info" src={info}></img>
                                </div>
                                <div className="tab-pane " id="tab_2">
                                    <p>
                                        {Phase_2_consists_of_the_knowledge_acquisition_which_encompasses_the_selection_of_materials_to_be_approached_about_the_subject_of_the_domain_and_the_selection_of_methods_for_extracting_knowledge_Within_OntoForInfoScience_these_activities_are_conducted_in_a_way_that_mixes_different_methods_like_textual_analysis_of_books_and_papers_automatic_terminological_extraction_semi_automatic_methods_for_identification_of_concepts_to_mention_a_few}
                                    </p>
                                </div>
                                <div className="tab-pane" id="tab_3">
                                    <p>{Phase_3_concerns_conceptualization_when_the_developer_performs_activities_of_identification_and_analysis_of_the_concepts_that_are_candidates_to_classes_in_the_ontology_In_addition_the_developer_promotes_the_knowledge_organization_so_that_one_is_able_to_obtain_relations_properties_and_constraints_of_the_ontology_The_more_appropriate_way_to_represent_the_conceptualization_of_ontology_it_is_through_of_a_graphical_conceptual_model_representing_conceptual_relations_between_identified_concepts_through_graphs_or_similar_structuresIn_the_Onto4AllEditor_the_Phase_3_must_be_performed_in}
                                        <strong>{this_page_using_the_graphical_editor}</strong>.
                                        {You_can_access_this_page_again_by_clicking_in_the_Ontology_Editor_on_the_menu}
                                    </p>
                                    <img className="img-max-width" alt="editor" src={editorIMG}></img>

                                </div>
                                <div className="tab-pane" id="tab_4">
                                    <p>
                                        {Phase_4_corresponds_to_the_activity_of_ontological_grounding_in_which_the_developer_surveys_top_levels_ontologies_to_be_used_as_starting_points_Developers_choose_the_top_level_ontology_more_suitable_to_their_aims_in_considering_the_underlying_philosophical_approach_that_will_justify_modeling_decisions_From_the_operational_point_of_view_the_developer_imports_selected_top_level_ontology_to_an_ontology_editor_tool_for_successful_implementation}
                                    </p>
                                    <p>
                                        <strong>{You_can_edit_your_previous_saved_ontologies_using_the_button_open_in_the_editor_on_the_right_sidebar}</strong>
                                    </p>
                                    <img className="img-max-width" alt="import" src={importFromSidebar}></img>
                                    <p>
                                        <strong>
                                            {You_can_import_other_ontologies_to_this_editor_if_they_have_been_created_using_the_Onto4AllEditor_and_have_a_XML_extension_You_can_also_import_OWL_files_made_by_other_editors_Beware_that_this_function_only_works_for_valid_OWL_files_with_right_syntax_If_you_have_any_issues_with_this_feature_please_contact_us_All_ontologies_exported_by_this_editor_can_be_imported_in_later_projectsUsing_the_editor_menu_click_on_the_file_button_and_then_on_the_import_as_showed_below}
                                        </strong>
                                    </p>
                                    <img className="img-max-width" alt="import" src={importIMG}></img>
                                    <p>{Select_a_valid_file_from_your_computer_using_the_choose_file_button_or_drag_a_file_direct_to_the_box_and_then_click_in_import}
                                    </p>
                                    <img className="img-max-width" alt="select-file" src={select_file}></img>
                                    <p>{After_that_your_imported_ontology_will_be_showing_on_the_editor}</p>
                                    <img className="img-max-width" alt="pizza ontology" src={pizza}></img>

                                </div>
                                <div className="tab-pane" id="tab_5">
                                    <p>
                                        {In_this_phase_the_developer_produces_a_formal_description_of_the_domain_from_the_conceptualization_of_the_prior_phase_3_Activities_of_phase_5_are}
                                    </p>
                                    <ul>
                                        <li>
                                            5.1){to_construct_general_taxonomy_of_the_ontology_based_on_previously_selected_top_level_taxonomy_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_Ontology_Editor_the_page_you_are_right_now}
                                            <img className="img-max-width" alt="properties" src={editorIMG}></img>
                                        </li>
                                        <li>
                                            5.2)
                                            {to_define_descriptive_properties_of_the_classes_involving_textual_attributes_as_names_synonyms_definitions_and_annotations_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_editor_clicking_under_a_class_or_relation_with_the_right_button_of_the_mouse_and_choosing_the_function_Edit_Properties_in_the_submenu_or_selecting_the_classrelation_and_pressing_CTRL_M}
                                            <img alt="properties" src={propriedades}></img>
                                        </li>
                                        <li>
                                            5.3)
                                            {to_create_formal_definitions_for_each_class_using_a_logical_language_so_that_the_formal_definition_is_able_to_be_derived_from_the_textual_definitions_created_previously}
                                        </li>
                                        <li>
                                            5.4)
                                            {to_define_properties_of_classes_involving_attributes_as_data_types_cardinality_existential_and_universal_quantifiers_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_menu_Ontology_Editor_clicking_under_a_class_or_relation_with_the_right_button_of_the_mouse_and_choosing_the_function_Edit_Properties_in_the_submenu_or_selecting_the_classrelation_and_pressing_CTRL_M}
                                            <img alt="properties" src={propriedades}></img>
                                            <img className="img-max-width" alt="properties" src={class_properties}></img>
                                        </li>
                                        <li>
                                            5.5)
                                            {to_create_instances_for_ontological_classes_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_Ontology_Editor_adding_the_symbol_Instance_rectangle_to_the_ontology_in_the_drawing_area_this_symbol_can_be_find_on_the_ontology_palette_in_the_left_of_the_editor}
                                        </li>
                                        <li>
                                            5.6)
                                            {to_specify_ontological_relations_consisting_of_the_application_of_a_defined_set_of_rules_and_principles_carrying_out_the_transformation_of_conceptual_relations_into_formal_relations_in_the_Onto4AllEditor_this_activity_must_be_performed_in_the_editor_clicking_under_a_class_or_relation_with_the_right_button_of_the_mouse_and_choosing_the_function_Edit_Properties_in_the_submenu_or_selecting_the_relation_and_pressing_CTRL_M}
                                            <img className="img-max-width" alt="properties" src={relation}></img>
                                            <img className="img-max-width" alt="properties" src={relation_properties}></img>
                                        </li>
                                    </ul>
                                </div>
                                <div className="tab-pane" id="tab_6">
                                    <p>
                                        {The_evaluation_of_the_ontology_correspond_to_the_application_of_a_set_of_criteria_allowing_one_to_perform_both_the_ontological_validation_validation_of_the_correspondence_between_ontology_and_the_real_world_and_the_ontological_verification_analysis_of_the_ontology_with_respect_to_the_correctness_of_its_construction_Examples_of_validation_criteria_are_non_recursivity_in_definitions_the_specification_of_different_types_of_part_of_relations_the_definition_of_inverse_relations_and_the_creation_of_the_cardinalitiesIn_the_Onto4AllEditor_the_Phase_6_is_performed_automatically_by_the_editor_through_of_the_functionality_Warnings_Console_that_suggests_good_modeling_practices_for_the_current_drawn_ontology}
                                    </p>
                                    <img className="img-max-width" alt="console" src={consoleIMG}></img>

                                </div>
                                <div className="tab-pane" id="tab_7">
                                    <p>
                                        {In_phase_7_documentation_of_all_activities_performed_along_the_ontology_development_cycle_is_organized_The_production_of_documentation_occurs_during_all_the_time_the_ontology_has_been_constructed_The_content_of_the_documentation_encompasses_the_document_of_specification_from_phase_1_documents_of_reference_about_the_domain_from_phase_2_the_set_of_conceptual_models_from_phase_3_reused_ontologies_phases_4_and_5_ontological_and_formal_content_phase_5_and_other_useful}
                                    </p>
                                </div>
                                <div className="tab-pane" id="tab_8">
                                    <p>{In_phase_8_the_developer_makes_the_ontological_artifact_available_in_a_way_that_be_downloaded_and_properly_visualized_by_a_community_of_users_You_can_download_the_ontology_you_just_draw_by_clicking_in_the_file_menu_and_then_in_the_export_submenu}
                                    </p>
                                    <img className="img-max-width" alt="export" src={exporte}></img>
                                    <p>{You_can_export_your_ontology_in_XML_OWL_or_SVG_image_When_you_do_that_your_ontology_is_also_saved_in_your_account_you_can_look_all_the_ontologies_you_made_by_clicking_on_the_File_Manager_menu_on_the_top_of_the_page}
                                    </p>

                                </div>
                                <div className="tab-pane" id="tab_9">
                                    <p>
                                        {OntoForInfoScience_is_a_detailed_methodology_for_construction_of_ontologies_that_details_each_step_of_the_ontology_development_cycle_The_goal_of_such_methodology_is_to_enable_experts_in_Knowledge_Organization_to_overcome_the_technical_jargon_difficulties_as_well_as_logical_and_philosophical_issues_that_involve_the_ontology_development_Mendonça_2016_The_methodology_OntoForInfoScience_consists_of_nine_phases}
                                    </p>
                                    <ul>
                                        <li>
                                            1) {Specification_of_the_ontology}
                                        </li>
                                        <li>
                                            2) {Acquisition_and_extraction_of_knowledge}
                                        </li>
                                        <li>
                                            3) {Conceptualization}
                                        </li>
                                        <li>
                                            4) {Ontological_grounding}
                                        </li>
                                        <li>
                                            5) {Formalization_of_the_ontology}
                                        </li>
                                        <li>
                                            6) {Evaluation_of_the_ontology}
                                        </li>
                                        <li>
                                            7) {Documentation}
                                        </li>
                                        <li>
                                            8) {Publication_of_the_ontology}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-default pull-left" data-dismiss="modal">{Close}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Methodology;

if (document.getElementById('methodology')) {
    ReactDOM.render(<Methodology />, document.getElementById('methodology'));
}