import React from 'react';
import ReactDOM from 'react-dom';

import Chat from './Chat';
import Properties from './Properties';

function Sidebar(props) {
    return (
        <aside className="control-sidebar control-sidebar-light control-sidebar-open">

            <Chat id='chat'></Chat>
            <Properties id='properties'></Properties>

        </aside>
    );
}

export default Sidebar;

if (document.getElementById('sidebar')) {
    ReactDOM.render(<Sidebar />, document.getElementById('sidebar'));
}