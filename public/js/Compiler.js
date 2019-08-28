//console.log(mxUtils.getPrettyXml(ui.editor.getGraphXml()));
//console.log(mxUtils.getXml(ui.editor.getGraphXml()));

/**
 * Gets the XML from the editor after a Cell is moved or connect to another Cell
 * @param xml
 */
function movementCompiler(xml) {

    console.log(xml);
    let parser, xmlDoc;

    parser = new DOMParser();
    xmlDoc = parser.parseFromString(xml, "text/xml");
    let equalClassNamesError = 0;
    let equalRelationNamesError = 0;

    for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {
        for (let j = i + 1; j < xmlDoc.getElementsByTagName("mxCell").length; j++) {
            if ((xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value")) && (
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") !==
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("id")) &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") != null
            ) {
                if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") == null &&
                    xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("edge") == null)
                {
                    errorAnimation($("#equalClassNamesError"));
                    equalClassNamesError++;
                }
                else {
                    errorAnimation($("#equalRelationNamesError"));
                    equalRelationNamesError++;
                }

            } else if (equalClassNamesError === 0)
                $("#equalClassNamesError").hide();
            else if (equalRelationNamesError === 0)
                $("#equalRelationNamesError").hide();


            if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null
            ) {
                errorAnimation($("#equalRelationsError"));
            } else
                $("#equalRelationsError").hide();

            equalRelationNamesError = 0;
            equalClassNamesError = 0;
        }

    }

}

/**
 * Gets the XML from the editor after any property of the cell have been edited
 * @param xml
 */
function propertiesCompiler(xml) {

}

/**
 * Initializes the modal animation of the given error
 * @param modal
 */
function errorAnimation(modal) {
    modal.show();
    modal.animate({opacity: '0.4'}, "slow");
    modal.animate({opacity: '0.8'}, "slow");
    modal.animate({opacity: '0.4'}, "slow");
    modal.animate({opacity: '0.8'}, "slow");
}