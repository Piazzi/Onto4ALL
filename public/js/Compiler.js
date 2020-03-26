//console.log(mxUtils.getPrettyXml(ui.editor.getGraphXml()));
//console.log(mxUtils.getXml(ui.editor.getGraphXml()));

/**
 * Gets the XML from the editor after a Cell is moved or connect to another Cell
 * @param xml
 */
function movementCompiler(xml) {

    console.log(xml);
    let parser, xmlDoc, missingClassProperties = "", missingRelationProperties = "", classesCount = 0, relationsCount = 0, instancesCount = 0;

    parser = new DOMParser();
    xmlDoc = parser.parseFromString(xml, "text/xml");
    // Each of theses error has a unique Id used for searching for the error in the DOM Elements
    //  These id's also corresponds to the id's on the error index page
    let equalClassNamesError = 0, // id = 1
        equalRelationBetweenClassesError = 0, // id = 2
        instanceOfBetweenClassesError = 0, // id = 3
        wrongRelationError = 0, // id = 4
        inverseOfNameError = 0, // id = 5
        missingClassPropertiesError = 0, // id = 6
        missingRelationPropertiesError = 0, // id = 7
        excessOfRelationsError = 0,  // id = 8
        multipleInheritanceError = 0; // id = 9

    let notConnectedRelationWarning = 0; // id = 1;

    // Starts the XML interpretation send by the editor
    // Each mxCell element is compared to each other to find any measurable error
    // Complexity: O(n^2)
    for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {

        // -------- WARNINGS SEARCH -----------------

        // Checks if the mxCell element is a relation by looking at the "edge" attribute
        if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") !== null && (
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") === null ||
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") === null))
        {
            notConnectedRelationWarning++;
            warningMessage('The relation '+xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") +' it is not fully connected to 2 classes', 1);
        }

        if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") !== null)
            relationsCount++;
        else if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('ellipse'))
            classesCount++;
        else if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('Instance'))
            instancesCount++;


        // /.----------- WARNINGS SEARCH --------------


        // ------------- ERROR SEARCH ---------------
        for (let j = i + 1; j < xmlDoc.getElementsByTagName("mxCell").length; j++) {


            // Shows a error message if two classes or two relations has the same name
            if ((xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value")) && (
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") !==
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("id")) &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") != null) {
                if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") == null &&
                    xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("edge") == null &&
                    xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('ellipse') &&
                    xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("style").includes('ellipse') &&
                    xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") != 'Name' &&
                    xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") != 'Name') {
                    equalClassNamesError++;
                    errorMessage("You can not have two classes with the same name, you have two classes named "+(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value")).bold()+".","Inconsistency",1);
                }
            }


            // Shows a error message if two classes has the same relation between them more than one time
            if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") != null) {
                equalRelationBetweenClassesError++;
                errorMessage("You can't have 2 equal relations pointing to the same classes. This error occurs in the following classes: "+
                    getMxCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +
                    " and "+ getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target")) +".", "Imprecision",2);
            }

            // Shows a error message if two classes has been connected with the instance_of relation
            if (xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") === 'instance_of' &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") !== null) {
                // get the ids from the mxCells in the relation
                let domainId = xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source");
                let rangeId = xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target");
                let domainClass, rangeClass;

                // Look for the two mxCells using the ids
                for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {
                    if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") === domainId)
                        domainClass = xmlDoc.getElementsByTagName("mxCell")[i];
                    if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") === rangeId)
                        rangeClass = xmlDoc.getElementsByTagName("mxCell")[i];


                }

                // shows a error if the mxCells are two classes
                if (domainClass.getAttribute("style").includes('ellipse') && rangeClass.getAttribute("style").includes('ellipse')) {
                    instanceOfBetweenClassesError++;
                    errorMessage("You cant have a instance_of relation between two classes. It must be between one class and one instance. This error occurs in the following classes: "
                        +domainClass.getAttribute("value")+" and "+ rangeClass.getAttribute("value") +".", "",3);
                }

            }


            // If the mxCell is a Instance, start searching for his relations. If any relation belonging to the instance it's not a instance_of
            // relation, shows a error message
            if (xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("style").includes('Instance')) {
                for (let k = 0; k < xmlDoc.getElementsByTagName("mxCell").length; k++) {
                    if (xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("edge") != null &&
                        xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("value") != 'instance_of') {
                        if (xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("source") == xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("id") ||
                            xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("target") == xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("id")) {
                            wrongRelationError++;
                            errorMessage("You can only have a instance_of relation between a class and a instance","",4);
                        }
                    }
                }

            }

            // Shows a error message if a class has more than one relation attached to it
            if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("edge") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") != null &&
                (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source")) &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") !==
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value"))
            {
                errorMessage("You can only have 1 relation between 2 classes. This error occurs in the following relations: "
                    +xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value")
                    +" and "+xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value")
                    +". Between these two classes: "+getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target")) +" and "+
                     getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source"))+" .", "", 8);
                excessOfRelationsError++;
            }

            if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") === "is_a" &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("value") === "is_a" &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !==
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target"))
            {
                errorMessage("A class can't have multiple inheritance. Your "+getMxCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +" class can't be the domain of more than one is_a relation","",9);
                multipleInheritanceError++;
            }



        }


    }

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // Search for 'object' elements in the XML
    for (let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++){
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null ){


            // Show the inverse of error if the relation and the inverse Of property have the same name
            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") == xmlDoc.getElementsByTagName("object")[i].getAttribute("inverseOf")) {
                inverseOfNameError++;
                errorMessage("In the "+xmlDoc.getElementsByTagName("object")[i].getAttribute("label") +" relation, the Inverse Of property can't have the same name of the relation","",5);

            }

        }

        // Search for missing properties in each class element
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("definition") === "")
            missingClassProperties = missingClassProperties + ' definition,';


        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf") === "")
            missingClassProperties = missingClassProperties + ' SubClassOf,';


        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("exampleOfUsage") === "")
            missingClassProperties = missingClassProperties + ' exampleOfUsage';

        if(missingClassProperties !== "")
        {
            missingClassPropertiesError++;
            errorMessage('In the '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+' Class, you did not fill the following properties: ' + missingClassProperties.bold()+ '',"",6);
            missingClassProperties = "";
        }


        // Search for missing properties in each relation element
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("domain") === "")
            missingRelationProperties = missingRelationProperties  + ' domain,';


        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("range") === "")
            missingRelationProperties = missingRelationProperties  + ' range,';


        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("inverseOf") === "")
            missingRelationProperties = missingRelationProperties  + ' inverseOf';

        if(missingRelationProperties  !== "")
        {
            missingRelationPropertiesError++;
            errorMessage('In the '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+' Relation, you did not fill the following properties: ' + missingRelationProperties.bold()+ '',"",7);
            missingRelationProperties  = "";
        }

    }

    // Update the counters on front end
    $("#error-count").text(equalRelationBetweenClassesError + equalClassNamesError + instanceOfBetweenClassesError + wrongRelationError + inverseOfNameError + missingClassPropertiesError + missingRelationPropertiesError + excessOfRelationsError + multipleInheritanceError);
    $("#warning-count").text(notConnectedRelationWarning);
    $("#classes-count").text(classesCount);
    $("#relations-count").text(relationsCount);
    $("#instances-count").text(instancesCount);

    // Checks if any error can be removed from the console error
    if(equalClassNamesError === 0)
        removeError(1);
    if(equalRelationBetweenClassesError === 0)
        removeError(2);
    if(instanceOfBetweenClassesError === 0)
        removeError(3);
    if(wrongRelationError === 0)
        removeError(4);
    if(inverseOfNameError === 0)
        removeError(5);
    if(missingClassPropertiesError === 0)
        removeError(6);
    if(missingRelationPropertiesError === 0)
        removeError(7);
    if(excessOfRelationsError === 0)
        removeError(8);
    if(multipleInheritanceError === 0)
        removeError(9);

    if(notConnectedRelationWarning === 0)
        removeWarning(1);


}

/**
 * Removes the error message in the error console for the given error Id
 * @param errorId
 */
function removeError(errorId)
{
    $('.direct-chat-msg:contains(Error Id: '+errorId+')').remove();
}

/**
 * Removes the warning message in the error console for the given warning ID
 * @param warningId
 */
function removeWarning(warningId)
{
    $('.direct-chat-msg:contains(Warning Id: '+warningId+')').remove();
}

/**
 * Returns the cell, given the id.
 *
 * @param xmlDoc
 * @param id
 * @returns {*|string}
 */
function getMxCell(xmlDoc, id) {
    for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {
        if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") === id)
            return xmlDoc.getElementsByTagName("mxCell")[i];
    }
}

/**
 * Returns the value(name) of a mxCell
 *
 * @param xmlDoc
 * @param id
 */
function getMxCellName(xmlDoc, id)
{
    for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {
        if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") === id)
            return xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value");
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
}

/**
 * Creates a new error message in the error console for the given text
 * @param text
 * @param errorType
 * @param errorId
 */
function errorMessage(text, errorType, errorId) {

    if (errorType == null)
        errorType = '';
    $(".direct-chat-messages").append(' <div class="direct-chat-msg ">\n' +
        '                    <div class="direct-chat-info clearfix">\n' +
        '                        <span class="direct-chat-name pull-right"><i class="fa fa-close"></i><strong>'+ errorType+'Error | Error Id: '+errorId+'</strong></span>\n' +
        '                        <span class="direct-chat-timestamp pull-left">' + new Date().toLocaleString() + '</span>\n' +
        '                    </div>\n' +
        '                    <!-- /.direct-chat-info -->\n' +
        '                    <img class="direct-chat-img" src="css/images/error.gif" alt="Error Message"><!-- /.direct-chat-img -->\n' +
        '                    <div class="direct-chat-text">\n' +
        '                      ' + text + '\n' +
        '                    </div>\n' +
        '                    <!-- /.direct-chat-text -->\n' +
        '                </div>');

    errorAnimation($(".direct-chat-msg"));
    errorAnimation($("#error-count"));
}

/**
 * Creates a new warning message in the error console for the given text
 * @param text
 * @param warningId
 */
function warningMessage(text, warningId)
{
    $(".direct-chat-messages").append(' <div class="direct-chat-msg ">\n' +
        '                    <div class="direct-chat-info clearfix">\n' +
        '                        <span class="direct-chat-name pull-right"><i class="fa fa-warning"></i><strong> Warning | Warning Id: ' +warningId+'</strong></span>\n' +
        '                        <span class="direct-chat-timestamp pull-left">' + new Date().toLocaleString() + '</span>\n' +
        '                    </div>\n' +
        '                    <!-- /.direct-chat-info -->\n' +
        '                    <img class="direct-chat-img" src="css/images/warning.png" alt="Warning Message"><!-- /.direct-chat-img -->\n' +
        '                    <div class="direct-chat-text">\n' +
        '                      ' + text + '\n' +
        '                    </div>\n' +
        '                    <!-- /.direct-chat-text -->\n' +
        '                </div>');
    errorAnimation($("#warning-count"));
}
