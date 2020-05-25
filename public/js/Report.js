$(document).ready(function () {
    // Reads the current ontology XML and then writes the report on a string for download
    $('#download-ontology-report').click(function () {
        console.log(editor.editor.getGraphXml());

        // get the XML document
        let xmlDoc = editor.editor.getGraphXml();
        let report = '/********** Ontology Report **********/ \nClasses:';

        // Starts the XML interpretation
        for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
        {
            if(isClass(xmlDoc,i))
            {
                report = report + '\n       '+getValueOrLabel(xmlDoc,i);
                // check if the properties are filled
                if(filledProperties(xmlDoc,i))
                {
                    report = report + '\n       Properties:';
                    let parentNode = xmlDoc.getElementsByTagName("mxCell")[i].parentNode;
                    for(let i = 0; i < parentNode.attributes.length; i++)
                    {
                        report = report + '\n           - '+parentNode.attributes[i].name+': '+parentNode.attributes[i].value;
                    }
                }
                else
                {
                    report = report + '\n           The properties of this class has not been filled yet';
                }
                report = report+ '\n    ----------------------------------------';


            }
        }
        report = report + '\nRelações: ';

        for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
        {
            if(isRelation(xmlDoc,i))
            {
                report = report + '\n       '+getValueOrLabel(xmlDoc,i);
                // check if the properties are filled
                if(filledProperties(xmlDoc,i))
                {
                    report = report + '\n       Properties:';
                    let parentNode = xmlDoc.getElementsByTagName("mxCell")[i].parentNode;
                    for(let i = 0; i < parentNode.attributes.length; i++)
                    {
                        report = report + '\n           - '+parentNode.attributes[i].name+': '+parentNode.attributes[i].value;
                    }
                }
                else
                {
                    report = report + '\n           The properties of this relation has not been filled yet';
                }
                report = report+ '\n    ----------------------------------------';


            }
        }
        console.log(report);

    })

});