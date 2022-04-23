import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import Select from 'react-select'

class OntologyManager extends React.Component {
   
    constructor(props) {
        super(props);
   
        this.state = {
            ontologies: [],
        };
    }

    componentDidMount() {

        fetch('/getOntologies', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                    },
                method: 'get'
            })
            .then(res => res.json())
                .then(res => {
                    this.setState({
                        ontologies: res
                    });
                })
            .catch(function(error) {
                console.log(error);
            });
            

            // Request to save the current ontology 
            document.addEventListener("DOMContentLoaded", function () {

                let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                // Fires the Ajax request when the button is clicked

                document.getElementById('save-ontology').addEventListener('click', function () {
                    $("#collaborators-select option[value='" + user_id + "']").prop("selected", true);
                    document.getElementById('save-ontology').innerHTML = '<div  class="overlay"><i style="color: white !important;" class="fa fa-spinner fa-spin"></i></div>';
                    document.getElementById('save-ontology').style.backgroundColor = "#00a65a";
                    document.getElementById('save-ontology').style.borderColor = "#00a65a";
                    $.ajax({
                        /* the route pointing to the post function */
                        url: '/' + getLanguage() + '/updateOrCreate',
                        type: 'POST',
                        /* send the csrf-token and the input to the controller */
                        data: {
                            _token: CSRF_TOKEN,
                            id: document.getElementById('id').value,
                            xml_string: new XMLSerializer().serializeToString(editor.getGraphXml()),
                            name: document.getElementById('name-input').value,
                            publication_date: document.getElementById('publication-date').value,
                            last_uploaded: document.getElementById('last-uploaded').value,
                            description: document.getElementById('description').value,
                            link: document.getElementById('link').value,
                            domain: document.getElementById('ontology-domain').value,
                            general_purpose: document.getElementById('general-purpose').value,
                            profile_users: document.getElementById('profile-users').value,
                            intended_use: document.getElementById('intended-use').value,
                            type_of_ontology: document.getElementById('type-of-ontology').value,
                            degree_of_formality: document.getElementById('degree-of-formality').value,
                            scope: document.getElementById('scope').value,
                            competence_questions: document.getElementById('competence-questions').value,
                            namespace: $("#namespace-select").val().toString(),
                            collaborators: $("#collaborators-select").val()
                        },

                        dataType: 'JSON',
                        /* remind that 'data' is the response of the OntologyController */
                        success: function (data) {
                            updateSaveButtonInFrontEnd(true);
                            document.getElementById('id').value = data['id'];
                            document.getElementById('title').textContent = document.getElementById('name-input').value + ' | Onto4ALL - Ontology Graphical Editor';
                            document.getElementById('last-update').innerHTML = '<span class="time"><i class="fa fa-clock-o"></i> ' + 'Last update: ' + data['updated_at'];;
                        },

                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                            updateSaveButtonErrorInFrontEnd();
                        }
                    })
                });

            });

            // Request to save automatically the current ontology 
            // Update form
            $(".tab-content :input").bind('keydown keyup', function (e) {

                if ($("#switch").is(":checked")) {
                    let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    // Fires the Ajax request when the button is clicked

                    document.getElementById('save-ontology').innerHTML = '<div  class="overlay"><i style="color: white !important;" class="fa fa-spinner fa-spin"></i></div>';
                    document.getElementById('save-ontology').style.backgroundColor = "#00a65a";
                    document.getElementById('save-ontology').style.borderColor = "#00a65a";
                    $.ajax({
                        /* the route pointing to the post function */
                        url: '/' + getLanguage() + '/updateOrCreate',
                        type: 'POST',
                        /* send the csrf-token and the input to the controller */
                        data: {
                            _token: CSRF_TOKEN,
                            id: document.getElementById('id').value,
                            xml_string: new XMLSerializer().serializeToString(editor.getGraphXml()),
                            name: document.getElementById('name-input').value,
                            publication_date: document.getElementById('publication-date').value,
                            last_uploaded: document.getElementById('last-uploaded').value,
                            description: document.getElementById('description').value,
                            link: document.getElementById('link').value,
                            domain: document.getElementById('ontology-domain').value,
                            general_purpose: document.getElementById('general-purpose').value,
                            profile_users: document.getElementById('profile-users').value,
                            intended_use: document.getElementById('intended-use').value,
                            type_of_ontology: document.getElementById('type-of-ontology').value,
                            degree_of_formality: document.getElementById('degree-of-formality').value,
                            scope: document.getElementById('scope').value,
                            competence_questions: document.getElementById('competence-questions').value,
                            namespace: $("#namespace-select").val().toString(),
                            collaborators: $("#collaborators-select").val()
                        },

                        dataType: 'JSON',
                        /* remind that 'data' is the response of the OntologyController */
                        success: function (data) {
                            updateSaveButtonInFrontEnd(true);
                            document.getElementById('id').value = data['id'];
                            document.getElementById('title').textContent = document.getElementById('name-input').value + ' | Onto4ALL - Ontology Graphical Editor';
                            document.getElementById('last-update').innerHTML = '<span class="time"><i class="fa fa-clock-o"></i> ' + 'Last update: ' + data['updated_at'];;
                        },

                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                            updateSaveButtonErrorInFrontEnd();
                        }
                    })
                }
            });

            // Reads the current ontology XML and then writes the report on a string for download
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById('download-ontology-report').addEventListener('click', function () {

                    let report = '/************* Ontology Report *************/ \n\nClasses:';

                    // write the classes in the document
                    classes.forEach(ontologyClass => {
                        report = report + '\n       Class: ' + ontologyClass.value.attributes['label'].value + ' | ID: ' + ontologyClass.id;
                        report = report + '\n       Properties:';
                        for (let i = 0; i < ontologyClass.value.attributes.length; i++)
                            report = report + '\n           - ' + ontologyClass.value.attributes[i].name + ': ' + ontologyClass.value.attributes[i].value;
                        report = report + '\n    ----------------------------------------';
                    });

                    report = report + '\nRelations: ';

                    // write the relations in the document
                    relations.forEach(relation => {
                        report = report + '\n      Relation:  ' + relation.value.attributes['label'].value + ' | ID: ' + relation.id;
                        report = report + '\n       Properties:';
                        for (let i = 0; i < relation.value.attributes.length; i++)
                            report = report + '\n           - ' + relation.value.attributes[i].name + ': ' + relation.value.attributes[i].value;
                        report = report + '\n    ----------------------------------------';
                    });

                    report = report + '\n\n/************ Made with Onto4ALL ************/';
                    document.getElementById('download-ontology-report').setAttribute("href", "data:text/plain;charset=UTF-8," + encodeURIComponent(report));
                })

            });

            // Downloads a .txt file containing all the errors that the user made in the current ontology
            document.getElementById('download-errors-txt').addEventListener('click', function () {
                let consoleMessages = document.getElementsByClassName('direct-chat-text');
                let txts = "";
                for (let i = 0; i < consoleMessages.length; i++)
                    txts = txts + consoleMessages[i].textContent;

                this.href = "data:text/plain;charset=UTF-8," + encodeURIComponent(txts);
            });

            $("#favorite-ontology").click(function() {
                $.ajax({
                    /* the route pointing to the post function */
                    url: '/' + getLanguage() + '/favouriteOntologyIndex',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        id: document.getElementById('id').value,
                        favourite: document.getElementById('favorite-ontology').value
                    },
            
                    dataType: 'JSON',
                    success: function (data) {
                        if (data['favourite'] == 1)
                            document.getElementById('favorite-ontology').innerHTML = '<i style="color:#f39c12" class="fa fa-fw fa-star"></i>';
                        else
                            document.getElementById('favorite-ontology').innerHTML = '<i class="fa fa-fw fa-star-o"></i>';
                    },
            
                    error: function () {
                        alert('You already have 5 favourite ontologies');
                    }
                })
            });

            $( "#name-input" ).keypress(function() {
                if (event.key == 'Enter') {
                    document.getElementById('save-ontology').click();
                    $('.name-input').blur();
                }
            });

            $('#name-input').bind('keypress', function(e) {
                if(e.keyCode==13){
                    document.getElementById('save-ontology').click();
                    $('.name-input').blur();
                }
            });

    }

    render() {

        const { ontologies } = this.state;

            return (
            <div className="modal fade" id="ontology-manager" style={{display: 'none'}}>
                <div className="modal-dialog modal-lg">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span></button>
                            <h4 className="modal-title">{Ontology_Manager}</h4>

                        </div>
                        <div className="modal-body">
                            {ontologies == null ? (
                            <p>{You_dont_have_any_ontologies_saved_in_our_ontology_manager_yet}</p>
                            ) : (
                            <ul className="timeline">
                                {ontologies.map((ontology, index) => (
                                <li key={index}>
                                    <i className="fa fa-object-group bg-green"></i>

                                    <div className="timeline-item">
                                        <span className="time"><i className="fa fa-user"></i> {Created_By}:
                                            {/*ontology.user.name*/ontology.user_id}</span>
                                        <span className="time"><i className="fa fa-clock-o"></i> {Last_update}:
                                            {ontology.updated_at}</span>
                                        {ontology.favourite == 1 &&
                                        <span className="time"><i style={{color: '#f39c12'}} className="fa fa-fw fa-star"></i></span>
                                        }

                                        <h3 className="timeline-header">
                                            <a className="openOntology" data-dismiss="modal" id={ontology.id} href="">{ontology.name}</a>
                                            {was_updated}
                                        </h3>

                                        <div className="timeline-body">
                                            {ontology.description != null &&
                                            <div>
                                                <strong><i className="fa fa-book margin-r-5"></i>{Description}</strong>
                                                <p className="text-muted">
                                                    {ontology.description}
                                                </p>
                                            </div>
                                            }
                                        </div>
                                        <div className="timeline-footer">
                                            <a data-dismiss="modal" id={ontology.id} className="btn btn-default editor-timeline-item openOntology" onClick={() => openOntology(ontology.id)} href="#"><i className="fa fa-fw fa-object-group"></i> {Open_in_the_editor}</a>
                                        </div>
                                    </div>
                                </li>
                                ))}
                            </ul>
                            )}
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-default pull-left" data-dismiss="modal">{Close}</button>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default OntologyManager;

if (document.getElementById('ontologyManager')) {
    ReactDOM.render(<OntologyManager />, document.getElementById('ontologyManager'));
}