import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import Select from 'react-select'

function Console(props) {
    return (
        <div className="box box-default box-solid direct-chat direct-chat-warning no-warnings collapsed-box" id="warnings-console">
            <div id="warnings-console-header" className="box-header">
                <h3 className="box-title">{Warnings_Console}</h3>

                <a href="#" data-target="#warningsConsole" data-toggle="modal" aria-expanded="false">
                    <i className="fa fa-fw fa-question-circle" title={Click_to_see_more_information}></i>
                </a>

                <a download="ontology-errors.txt" href="#" id="download-errors-txt">
                    <i className="fa fa-download" title={Downloads_a_txt_file_containing_all_the_current_warnings_in_the_ontology}></i>
                </a>

                <a download="ontology-report.txt" href="#" id="download-ontology-report" title={Download_a_report_with_all_the_information_of_your_current_ontology}>
                    <i className="fa fa-fw fa-file-text-o"></i>
                </a>

                <a id="methodology-icon" title={Methodology_OntoForInfoScience} href="#" data-toggle="modal" data-target="#methodology-menu">
                    <i className="fa fa-fw fa-info-circle"></i>
                </a>
                <a  id="tips-icon" title={tips} href="#"  data-toggle="modal" data-target="#tips-menu">
                    <i className="fa fa-fw fa-search"></i>
                </a>


                <span id="classes" title={The_number_of_classes_in_your_current_ontology} data-widget="collapse" style={{color: '#f39c12'}}>
                    <i className="fa fa-fw fa-circle-o"></i>
                    <span id="classes-count"> 0</span>
                </span>

                <span id="relations" title={The_number_of_relations_in_your_current_ontology} data-widget="collapse" style={{color: '#3c8dbc'}}>
                    <i className="fa fa-1.5x fa-fw fa-exchange"></i>
                    <span id="relations-count"> 0</span>
                </span>

                <span id="instances" title={The_number_of_instances_in_your_current_ontology} data-widget="collapse" style={{color: 'rebeccapurple'}}>
                    <i className="fa fa-fw fa-circle-thin"></i>
                    <span id="instances-count"> 0</span>
                </span>

                

                <div className="box-tools pull-right">

                    <span id="errors" title={The_number_of_errors_in_your_current_ontology} data-widget="collapse" className="badge bg-green" data-original-title="Errors">
                        <i className="fa fa-close"></i>
                        <span id="error-count"> 0</span>
                    </span>

                    <span id="warnings" title={The_number_of_warnings_in_your_current_ontology} data-widget="collapse" className="badge bg-green" data-original-title="Warnings">
                        <i className="fa fa-warning"> </i>
                        <span id="warnings-count"> 0</span>
                    </span>

                    <button id="open-warnings-console" type="button" className="btn btn-box-tool" data-widget="collapse">
                        <i className="fa fa-fw fa-expand"></i>
                    </button>
                </div>
            </div>
            <div data-widget="collapse" className="box-body">
                {/* Warnings are loaded here */}
                <div className="direct-chat-messages">
                    {/* Message to the right */}
                    <div className="direct-chat-msg">
                        <div className="direct-chat-info clearfix">
                            <span className="direct-chat-name pull-right">{Welcome}</span>
                            <span className="direct-chat-timestamp pull-left"></span>
                        </div>
                        {/* /.direct-chat-info */}
                        <img id="no-warning-img" className="direct-chat-img" src={LogoMini} alt="Message User Image"></img>
                        <div id="no-warning-text" className="direct-chat-text">
                            {You_dont_have_any_warnings}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Console;

if (document.getElementById('console')) {
    ReactDOM.render(<Console />, document.getElementById('console'));
}