//// main.mjs
// import { hello } from 'module'; // or './module'
// let val = hello();  // val is "Hello";


//import "mxClient.js";

//let editorUi = mxUtils.editorUi;
//let xml = mxUtils.getGraphXml;
//onsole.log(xml);

function relation() {
    let cells = mxGraphModel.prototype.getCells();
    console.log(cells[3].prototype.getEdgeCount());
}

