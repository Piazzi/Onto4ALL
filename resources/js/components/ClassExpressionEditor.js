import React from 'react';
import ReactDOM from 'react-dom';

function ClassExpressionEditor(props) {
    return (
        <div className="tab modal fade" id="ClassExpressionEditorModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog modal-lg" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="exampleModalLabel">
                            <p style={{textAlign: 'center'}} className="modal-title">{Class_Expression_Editor}</p>
                        </h5>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <label>Constraint</label>
                        <label>Axioms:</label>
                        <div id="highlight-constraint-text"> </div>
                        <p id="help-text"><i id="help-text-icon" className="fa fa-fw fa-info-circle"></i> {None_axiom_to_check} </p>
                    </div>
                    <div className="modal-footer">
                        <button type="button" className="btn btn-secondary" data-dismiss="modal">{Close}</button>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ClassExpressionEditor;

if (document.getElementById('classExpressionEditor')) {
    ReactDOM.render(<ClassExpressionEditor />, document.getElementById('classExpressionEditor'));
}