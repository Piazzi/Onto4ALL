import React from 'react';
import ReactDOM from 'react-dom';

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
    }
    render() {

        const { ontologies } = this.state;

            return (
            <div className="modal fade" id="ontology-manager" style={{display: 'none'}}>
                <div className="modal-dialog modal-lg">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 className="modal-title">{Ontology_Manager}</h4>

                        </div>
                        <div className="modal-body">
                            {ontologies == null ? (
                            <p>{You_dont_have_any_ontologies_saved_in_our_ontology_manager_yet}</p>
                            ) : (
                            <ul className="timeline">
                                {ontologies.map((ontology, index) => (
                                <li>
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
                                            <a data-dismiss="modal" id={ontology.id} className="btn btn-default editor-timeline-item openOntology" href="#"><i className="fa fa-fw fa-object-group"></i> {Open_in_the_editor}</a>
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