import React from 'react';
import ReactDOM from 'react-dom';

function OntologyManager(props) {
    return (
        <div>
        </div>
    );
}

export default OntologyManager;

if (document.getElementById('ontologyManager')) {
    ReactDOM.render(<OntologyManager />, document.getElementById('ontologyManager'));
}