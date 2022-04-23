import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import Select from 'react-select'

function Modal(props) {
    return (
        <div className="tab modal fade" id="warningsConsole" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog modal-lg" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="exampleModalLabel">
                            <strong>{Warnings_Console}</strong>
                        </h5>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <p>{The_warnings_console_is_the_way_our_editor_tells_you_good_modeling_practices_you_should_implement_when_building_a_ontologyThis_console_will_show_you_warnings_that_will_help_you_build_a_better_ontology}
                            <a target="_blank" href={warningIndex}>{Click_here}</a>
                            {to_see_all_the_warnings_our_console_track_We_will_be_updating_this_console_with_more_warnings_in_the_future}
                            <a href={help}>{contact_us}</a>
                            {if_you_had_any_problem_with_this_feature}
                        </p>
                        <img className="img-max-width" alt="export" src={warningConsole}></img>

                    </div>
                    <div className="modal-footer">
                        <button type="button" className="btn btn-secondary" data-dismiss="modal">{Close}</button>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Modal;

if (document.getElementById('modal')) {
    ReactDOM.render(<Modal />, document.getElementById('modal'));
}