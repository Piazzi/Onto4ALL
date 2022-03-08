//require('./bootstrap');

import React from 'react';
import Chat from './components/Chat';
import ClassExpressionEditor from './components/ClassExpressionEditor';
import Console from './components/Console';
import Methodology from './components/Methodology';
import Modal from './components/Modal';
import OntologyForm from './components/OntologyForm';
import OntologyManager from './components/OntologyManager';
import Properties from './components/Properties';
import Sidebar from './components/Sidebar';
import Tips from './components/Tips';

export default function App() {
    return(
        <div>
            <Sidebar />
            <Chat />
            <ClassExpressionEditor />
            <Console />
            <Methodology />
            <Modal />
            <OntologyForm />
            <OntologyManager />
            <Properties />
            <Tips />
        </div>
    )
}