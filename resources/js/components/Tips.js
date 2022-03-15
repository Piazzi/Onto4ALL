import React from 'react';
import ReactDOM from 'react-dom';

class Tips extends React.Component {

    constructor(props) {
        super(props);
   
        this.state = {
            relations: [],
            classes: [],
        };
    }

    componentDidMount() {
        fetch('/getRelations', {
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
                        relations: res
                    });
                })
            .catch(function(error) {
                console.log(error);
            });


        fetch('/getClasses', {
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
                        classes: res
                    });
                })
            .catch(function(error) {
                console.log(error);
            });
    }
    render() {

        var { relations, classes } = this.state;

        return (
            <div className="modal fade" id="tips-menu" style={{display: 'none'}}>
                <div className="modal-dialog modal-lg">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span></button>
                            <h4 style={{textAlign: 'center'}} className="modal-title">{tips}</h4>

                        </div>
                        <div className="modal-body">

                            <div style={{marginBottom: '10px'}} id="searchBar" className="input-group input-group-sm">
                                <input id="search-tip-input" type="text" className="form-control" placeholder={Search_for_tips}></input>
                                <div className="input-group-btn">
                                    <button type="submit" className="btn btn-default"><i className="fa fa-search-plus"></i></button>
                                </div>
                            </div>
                            <div id="menu-wrapper">
                                <div className="tab-content">
                                    <div id="menu-scroll">
                                        <div id="control-sidebar-theme-demo-options-tab table-search" className="tab-pane active table-search">
                                            {relations.map((ontologyRelation, index) => (
                                            <div id="tipSearch" className="box box-default collapsed-box box-solid relation-box">
                                                <div className="box-header with-border">
                                                    <h3 className="box-title title">{ontologyRelation.name} <i className="fa fa-fw fa-long-arrow-right"></i></h3>
                                                    <div className="box-tools pull-right">
                                                        <button type="button" className="btn btn-box-tool" data-widget="collapse"><i className="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div className="box-body">
                                                    <dl>
                                                        <dt>Definition</dt>
                                                        <dd>{ontologyRelation.definition}</dd>

                                                        {ontologyRelation.semi_formal_definition &&
                                                        <div>
                                                        <dt>Semi Formal Definition</dt>
                                                        <dd>{ontologyRelation.semi_formal_definition}</dd>
                                                        </div>
                                                        }
                                                        
                                                        {ontologyRelation.formal_definition &&
                                                        <div>
                                                        <dt>Formal Definition</dt>
                                                        <dd>{ontologyRelation.formal_definition}</dd>
                                                        </div>
                                                        }
                                                        <dt>Domain</dt>
                                                        <dd>{ontologyRelation.domain}</dd>
                                                        <dt>Range</dt>
                                                        <dd>{ontologyRelation.range}</dd>
                                                        <dt>Example Of Usage</dt>
                                                        <dd>{ontologyRelation.example_of_usage}</dd>
                                                        {ontologyRelation.imported_from &&
                                                        <div>
                                                        <dt>Imported From</dt>
                                                        <dd>
                                                            <a target="_blank" href={ontologyRelation.imported_from}>{ontologyRelation.imported_from}</a>
                                                        </dd>
                                                        </div>
                                                        }
                                                        <dt>ID</dt>
                                                        <dd>{ontologyRelation.relation_id}</dd>
                                                        {getLanguage() === 'pt' && $ontologyRelation.label_pt ? (
                                                         <div>
                                                        <dt>Label PT</dt>
                                                        <dd>{ontologyRelation.label_pt}</dd>
                                                        </div>
                                                        ) : (
                                                        <div>
                                                        <dt>Label</dt>
                                                        <dd>{ontologyRelation.label}</dd>
                                                        </div>
                                                        )}
                                                        {ontologyRelation.synonyms &&
                                                        <div>
                                                        <dt>Synonyms</dt>
                                                        <dd>{ontologyRelation.synonyms}</dd>
                                                        </div>
                                                        }
                                                        {ontologyRelation.is_defined_by &&
                                                        <div>
                                                        <dt>Is Defined By</dt>
                                                        <dd>{ontologyRelation.is_defined_by}</dd>
                                                        </div>
                                                        }
                                                        {ontologyRelation.comments &&
                                                        <div>
                                                        <dt>Editor Note (comments)</dt>
                                                        <dd>{ontologyRelation.comments}</dd>
                                                        </div>
                                                        }
                                                        {ontologyRelation.inverse_of &&
                                                        <div>
                                                        <dt>Inverse Of</dt>
                                                        <dd>{ontologyRelation.inverse_of}</dd>
                                                        </div>
                                                        }
                                                        {ontologyRelation.subproperty_of &&
                                                        <div>
                                                        <dt>Subproperty Of</dt>
                                                        <dd>{ontologyRelation.subproperty_of}</dd>
                                                        </div>
                                                        }
                                                        {ontologyRelation.superproperty_of &&
                                                        <div>
                                                        <dt>Superproperty Of</dt>
                                                        <dd>{ontologyRelation.superproperty_of}</dd>
                                                        </div>
                                                        }
                                                        <dt>Ontology</dt>
                                                        <dd>{ontologyRelation.ontology}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            ))}
                                            {classes.map((classe, index) => (  
                                            <div id="tipSearch" className="box box-success collapsed-box box-solid">
                                                <div className="box-header with-border">
                                                    <h3 className="box-title title">{classe.name} <i className="fa fa-fw fa-circle-thin"></i>
                                                    </h3>
                                                    <div className="box-tools pull-right">
                                                        <button type="button" className="btn btn-box-tool" data-widget="collapse"><i className="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div className="box-body">
                                                    <dl>
                                                        <dt>Definition</dt>
                                                        <dd>{classe.definition}</dd>
                                                        {classe.semi_formal_definition &&
                                                        <div>
                                                        <dt>Semi Formal Definition</dt>
                                                        <dd>{classe.semi_formal_definition}</dd>
                                                        </div>
                                                        }
                                                        {classe.formal_definition &&
                                                        <div>
                                                        <dt>Formal Definition (has_associated_axiom)</dt>
                                                        <dd>{classe.formal_definition}</dd>
                                                        </div>
                                                        }
                                                        <dt>ID</dt>
                                                        <dd>{classe.class_id}</dd>
                                                        {classe.subclass &&
                                                        <div>
                                                        <dt>SubClassOf</dt>
                                                        <dd>{classe.subclass}</dd>
                                                        </div>
                                                        }
                                                        {classe.synonyms &&
                                                        <div>
                                                        <dt>Synonyms (has_synonym)</dt>
                                                        <dd>{classe.synonyms}</dd>
                                                        </div>
                                                        }
                                                        <dt>Example Of Usage</dt>
                                                        <dd>{classe.example_of_usage}</dd>
                                                        {classe.imported_from &&
                                                        <div>
                                                        <dt>Imported From</dt>
                                                        <dd>
                                                            <a target="_blank" href="{classe.imported_from}">{classe.imported_from}</a>
                                                        </dd>
                                                        </div>
                                                        }
                                                        {getLanguage() === 'pt' && $classe.label_pt ? (
                                                         <div>
                                                        <dt>Label PT</dt>
                                                        <dd>{classe.label_pt}</dd>
                                                        </div>
                                                        ) : (
                                                        <div>
                                                        <dt>Label</dt>
                                                        <dd>{classe.label}</dd>
                                                        </div>
                                                        )}
                                                        {classe.elucidation &&
                                                        <div>
                                                        <dt>Elucidation</dt>
                                                        <dd>{classe.elucidation}</dd>
                                                        </div>
                                                        }
                                                        {classe.is_defined_by &&
                                                        <div>
                                                        <dt>Is Defined By</dt>
                                                        <dd>{classe.is_defined_by}</dd>
                                                        </div>
                                                        }
                                                        {classe.disjoint_with &&
                                                        <div>
                                                        <dt>Disjoint With</dt>
                                                        <dd>{classe.disjoint_with}</dd>
                                                        </div>
                                                        }
                                                        {classe.comments &&
                                                        <div>
                                                        <dt>Editor Note (comments)</dt>
                                                        <dd>{classe.comments}</dd>
                                                        </div>
                                                        }
                                                        <dt>Ontology</dt>
                                                        <dd>{classe.ontology}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-default pull-left" data-dismiss="modal">{Close}</button>
                            {External_Ontology_Databases}:
                            <a href="http://www.ontobee.org/" target="_blank"> OntoBee | </a>
                            <a href="https://bioportal.bioontology.org/" target="_blank"> BioPortal | </a>
                            <a href="https://www.ebi.ac.uk/ols/index" target="_blank"> Ontology Lookup Service (OLS) | </a>
                            <a href="http://swoogle.umbc.edu/2006/" target="_blank"> Swoogle | </a>
                            <a href="http://resources.si.washington.edu/fma_browser1/" target="_blank"> Foundational Model Anatomy
                                Browser </a>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Tips;

if (document.getElementById('tips')) {
    ReactDOM.render(<Tips />, document.getElementById('tips'));
}