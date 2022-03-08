import React from 'react';
import ReactDOM from 'react-dom';

function Siderbar(props) {
    return (
        <aside className="control-sidebar control-sidebar-light control-sidebar-open">

            <div id='chat'></div>

            <div id='properties'></div>

        </aside>
    );
}

export default Siderbar;

if (document.getElementById('siderbar')) {
    ReactDOM.render(<Siderbar />, document.getElementById('siderbar'));
}