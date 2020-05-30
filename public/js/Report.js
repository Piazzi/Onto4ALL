$(document).ready(function () {
    // Reads the current ontology XML and then writes the report on a string for download
    $('#download-ontology-report').click(function () {
        console.log(editor.editor.getGraphXml());

        // get the XML document from the editor
        let xmlDoc = editor.editor.getGraphXml();
        let report = '/************* Ontology Report *************/ \n\nClasses:';

        // Starts the XML interpretation
        for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
        {
            if(isClass(xmlDoc,i))
            {
                report = report + '\n       '+labelFilter(getValueOrLabel(xmlDoc,i));
                // check if the properties are filled
                if(filledProperties(xmlDoc,i))
                {
                    report = report + '\n       Properties:';
                    let parentNode = xmlDoc.getElementsByTagName("mxCell")[i].parentNode;
                    // write the properties
                    for(let i = 0; i < parentNode.attributes.length; i++)
                    {
                        report = report + '\n           - '+parentNode.attributes[i].name+': '+ labelFilter(parentNode.attributes[i].value);
                    }
                }

                report = report+ '\n    ----------------------------------------';


            }
        }
        report = report + '\nRelations: ';

        for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
        {
            if(isRelation(xmlDoc,i))
            {
                if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") != null &&
                    xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null)
                {
                    let domainId = xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source");
                    let rangeId =  xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target");
                    report = report + '\n       '+labelFilter(getCellName(xmlDoc,domainId))+' '+labelFilter(getValueOrLabel(xmlDoc,i)+' '+labelFilter(getCellName(xmlDoc, rangeId)));
                }
                else
                    report = report + '\n       '+labelFilter(getValueOrLabel(xmlDoc,i));

                // check if the properties are filled
                if(filledProperties(xmlDoc,i))
                {
                    report = report + '\n       Properties:';
                    let parentNode = xmlDoc.getElementsByTagName("mxCell")[i].parentNode;
                    for(let i = 0; i < parentNode.attributes.length; i++)
                    {
                        report = report + '\n           - '+parentNode.attributes[i].name+': '+labelFilter(parentNode.attributes[i].value);
                    }
                }

                report = report+ '\n    ---------------------------------------- ';


            }
        }
        report = report + '\n\n/************ Made with Onto4ALL ************/';
        console.log(report);
        this.href = "data:text/plain;charset=UTF-8," + encodeURIComponent(report);

    })

});

/**
 * Filter the given text, removing HTML tags
 * @param text
 */
function labelFilter(text) {
    return text.replace(/<[^>]*>/g, '');

}