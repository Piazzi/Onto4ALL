import React from 'react';
import ReactDOM from 'react-dom';

function OntologyForm(props) {
    return (
        <div className="modal fade" id="edit-ontology-modal" style={{display: 'none'}}>
            <div className="modal-dialog modal-lg">
                <div className="modal-content">
                    <div className="modal-header">
                        <button style={{color: 'red', opacity: 1}} type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 className="modal-title">{Edit_Current_Ontology}</h4>
                    </div>
                    <div className="modal-body">
                        <input id="id" name="id" type="hidden" ></input>

                        <div className="row">
                            <div className="col-md-12">
                                <div className="form-group">
                                    <label>IRI</label>
                                    <a id="iri-link">
                                        <input title="Open Link" className="form-control iri-link" type="button" style={{textAlign: 'left'}} id="ontology-iri"  disabled value={Save_the_ontology_first_to_see_its_IRI} ></input>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-md-3">
                                <div className="form-group">
                                    <label>{Publication_Date}</label>
                                    <input id="publication-date" name="publication_date" type="date" className="form-control"></input>
                                </div>
                            </div>
                            <div className="col-md-3">
                                <div className="form-group">
                                    <label>{Last_Uploaded}</label>
                                    <input id="last-uploaded" name="last_uploaded" type="date" className="form-control"></input>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>{Created_By}</label>
                                    <input id="created-by" disabled name="created_by" type="text" className="form-control"></input>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label>{Description}</label>
                            <textarea id="description" name="description" className="form-control" rows="3" placeholder=""></textarea>
                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>{Link}</label>
                                    <input placeholder="e.g: https://basic-formal-ontology.org/" id="link" name="link" type="text" className="form-control"></input>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>{Domain}</label>
                                    <input id="ontology-domain" name="ontology-domain" type="text" className="form-control"></input>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label>{General_Purpose}</label>
                            <input id="general-purpose" name="general_purpose" type="text" className="form-control"></input>
                        </div>
                        <div className="row">
                            <div className="col-md-4">
                                <div className="form-group">
                                    <label>{Profile_Users}</label>
                                    <input id="profile-users" name="profile_users" type="text" className="form-control"></input>
                                </div>
                            </div>
                            <div className="col-md-4">
                                <div className="form-group">
                                    <label>{Intended_Use}</label>
                                    <input id="intended-use" name="intended_use" type="text" className="form-control"></input>
                                </div>
                            </div>
                            <div className="col-md-4">
                                <div className="form-group">
                                    <label>{Type_of_Ontology}</label>
                                    <input id="type-of-ontology" name="type_of_ontology" type="text" className="form-control"></input>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>{Degree_of_Formality}</label>
                                    <input id="degree-of-formality" name="degree_of_formality" type="text" className="form-control"></input>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>{Scope}</label>
                                    <input id="scope" name="scope" type="text" className="form-control"></input>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label>{Competence_Questions}</label>
                            <input id="competence-questions" name="competence_questions" type="text" className="form-control"></input>
                        </div>
                        <div className="form-group">
                            <label>{Namespaces}</label>
                            <select data-placeholder="{{__('Insert used namespaces here')}}" id="namespace-select" style={{width: '100%'}} className="js-example-basic-multiple js-example-tags" name="namespace[]" multiple="multiple">
                                <option value="http://www.w3.org/2002/07/owl#">http://www.w3.org/2002/07/owl#</option>
                                <option value="http://www.w3.org/1999/02/22-rdf-syntax-ns">http://www.w3.org/1999/02/22-rdf-syntax-ns</option>
                                <option value="http://www.w3.org/2000/01/rdf-schema#">http://www.w3.org/2000/01/rdf-schema#</option>
                                <option value="http://www.w3.org/XML/1998/namespace">http://www.w3.org/XML/1998/namespace</option>
                                <option value="http://www.w3.org/2001/XMLSchema#">http://www.w3.org/2001/XMLSchema#</option>
                            </select>
                        </div>
                        <div className="form-group">
                            <label>{Collaborators}</label>
                            <span>- {Insert_usernames_to_share_your_ontology_with_other_Onto4ALL_users}</span> <strong style={{color: '#761c19'}}>({Collaborators_will_be_able_to_edit_this_ontology})</strong>
                            <select data-placeholder={Insert_usernames_here} id="collaborators-select" style={{width: '100%'}} className="js-example-basic-multiple" name="collaborators[]" multiple="multiple">
                               <option dangerouslySetInnerHTML={{__html: optionUsers}}/>
                            </select>
                        </div>
                    </div>
                    <div className="modal-footer">
                        <button type="button" className="btn btn-default pull-left" data-dismiss="modal">{Close}</button>
                        <button onClick={() => document.getElementById('save-ontology').click()} type="button" className="btn btn-success pull-right" data-dismiss="modal">{Save_Changes}</button>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default OntologyForm;

if (document.getElementById('ontologyForm')) {
    ReactDOM.render(<OntologyForm />, document.getElementById('ontologyForm'));
}