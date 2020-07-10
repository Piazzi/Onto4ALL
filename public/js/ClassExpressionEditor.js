
// Detects when the user starts writing somethind
$(document).on('input', '#ClassExpressionEditorInput', function(){

    getClassesNames();
});


function getClassesNames()
{
    let classes = [];
    let xmlDoc = editor.editor.getGraphXml();/*
    for(let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
    {
        if(!mxCellIsValid(xmlDoc.getElementsByTagName("mxCell")[i]))
            continue;

        console.log(xmlDoc.getElementsByTagName("mxCell")[i]);
        if(isClass(xmlDoc.getElementsByTagName("mxCell")[i]))
            classes.push(getValueOrLabel(xmlDoc, i));
    }
    console.log(classes);*/
}