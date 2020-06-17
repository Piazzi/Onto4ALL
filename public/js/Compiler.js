
/**
 * This file is responsible for the warning console in the editor page
 * The main function is the movementCompiler()
 * The other ones are helper functions to make the code cleaner (DRY)
 */


/**
 * Gets the XML from the editor after any change is made.
 * @param xml
 */
function movementCompiler(xml) {

    // Removes the previous error messages
    $(".direct-chat-messages").empty();

    let parser, xmlDoc, missingClassProperties = "", missingRelationProperties = "", classesCount = 0, relationsCount = 0, instancesCount = 0;

    parser = new DOMParser();
    xmlDoc = parser.parseFromString(xml, "text/xml");
    // Each of theses error has a unique Id used for searching for the error in the DOM Elements
    //  These id's also corresponds to the id's on the warning index page
    let equalClassNamesWarning = 0, // id = 1
        equalRelationBetweenClassesWarning = 0, // id = 2
        instanceOfBetweenClassesWarning = 0, // id = 3
        wrongRelationWarning = 0, // id = 4
        inverseOfNameWarning = 0, // id = 5
        missingClassPropertiesWarning = 0, // id = 6
        missingRelationPropertiesWarning = 0, // id = 7
        //excessOfRelationsWarning = 0,  //
        multipleInheritanceWarning = 0, // id = 8
        notConnectedRelationWarning = 0; // id = 9;

    // Starts the XML interpretation send by the editor
    // Each mxCell element is compared to each other to find any measurable error
    // This compiler is made of three parts, the first one is to compare elements with the
    // MxCell tag in it. The second one to compare elements with MxCell and Object
    // and the third one to compare elements with the Object tag only
    // For this i used the getValueOrLabel function.
    // Complexity: O(n^2)
    for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {


        // -------- WARNINGS SEARCH -----------------

        // Checks if the mxCell element is a relation by looking at the "edge" attribute
        if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") !== null && (
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") === null ||
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") === null))
        {
            notConnectedRelationWarning++;
            if(getLanguage() === 'pt')
                warningMessage('A relação '+ getValueOrLabel(xmlDoc, i) +' não está conectada a duas classes', 9);
            else
                warningMessage('The relation '+ getValueOrLabel(xmlDoc, i) +' it is not fully connected to 2 classes', 9);
        }

        if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") !== null)
            relationsCount++;
        else if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('ellipse'))
            classesCount++;
        else if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('Instance'))
            instancesCount++;

        // If the mxCell is a Instance, start searching for his relations. If any relation belonging to the instance it's not a instance_of
        // relation, shows a error message
        if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('Instance')) {
            for (let k = 0; k < xmlDoc.getElementsByTagName("mxCell").length; k++) {
                if (xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("edge") != null &&
                    getValueOrLabel(xmlDoc, k) != 'instance_of') {
                    if (xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("source") === getElementId(xmlDoc, i) ||
                        xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("target") === getElementId(xmlDoc, i)) {
                        wrongRelationWarning++;
                        if(getLanguage() === 'pt')
                            warningMessage("Você só poder ter uma relação instance_of entre uma classe e uma instância","",4);
                        else
                            warningMessage("You can only have a instance_of relation between a class and a instance","",4);
                    }
                }
            }

        }

        // Shows a error message if two classes has been connected with the instance_of relation
        if (getValueOrLabel(xmlDoc, i) === 'instance_of' &&
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") !== null &&
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !== null) {
            // get the ids from the mxCells in the relation
            let domainId = xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source");
            let rangeId = xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target");
            let domainClass, rangeClass;

            // Look for the two mxCells using the ids
            for (let k = 2; k < xmlDoc.getElementsByTagName("mxCell").length; k++) {
                if (getElementId(xmlDoc, k) === domainId)
                    domainClass = xmlDoc.getElementsByTagName("mxCell")[k];
                if (getElementId(xmlDoc, k) === rangeId)
                    rangeClass = xmlDoc.getElementsByTagName("mxCell")[k];


            }

            // shows a error if the mxCells are two classes
            if (domainClass.getAttribute("style").includes('ellipse') && rangeClass.getAttribute("style").includes('ellipse')) {
                instanceOfBetweenClassesWarning++;
                if(getLanguage() === 'pt')
                    warningMessage("Você não pode ter uma relação instance_of entre duas classes. A relação precisa estar entre uma classe e uma instância. ","",3);
                else
                    warningMessage("You cant have a instance_of relation between two classes. It must be between one class and one instance. ","",3);
            }

        }

        for (let j = i + 1; j < xmlDoc.getElementsByTagName("mxCell").length; j++) {


            // Shows a error message if two classes has the same name (Comparison made between two MxCell tags)
            if ((getValueOrLabel(xmlDoc, i) ===
                 getValueOrLabel(xmlDoc, j)) && (
                 getElementId(xmlDoc, i) !==
                 getElementId(xmlDoc, j)) &&
                getValueOrLabel(xmlDoc, i) != null &&
                getValueOrLabel(xmlDoc, j) != null)
                {
                    if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") == null &&
                        xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("edge") == null &&
                        xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('ellipse') &&
                        xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("style").includes('ellipse') &&
                        getValueOrLabel(xmlDoc, i) !== 'Name' &&
                        getValueOrLabel(xmlDoc, j) !== 'Name') {
                        equalClassNamesWarning++;
                        if(getLanguage() === 'pt')
                            warningMessage("Você não pode ter duas classes com o mesmo nome, você tem duas classes chamadas "+(getValueOrLabel(xmlDoc, i)).bold()+".",1);
                        else
                            warningMessage("You can not have two classes with the same name, you have two classes named "+(getValueOrLabel(xmlDoc, i)).bold()+".",1);
                }
            }


            // Shows a error message if two classes has the same relation between them more than one time
            if (getValueOrLabel(xmlDoc, i) ===
                getValueOrLabel(xmlDoc, j) &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                getValueOrLabel(xmlDoc, i) != null &&
                getValueOrLabel(xmlDoc, j) != null &&
                (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") != null)) {
                equalRelationBetweenClassesWarning++;
                if(getLanguage() === 'pt')
                    warningMessage("Você não pode ter duas relações iguais apontando para as mesmas classes. Esse erro ocorre nas seguintes classes: "+
                        getMxCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +
                        " e "+ getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target")) +".", 2);
                else
                    warningMessage("You can't have 2 equal relations pointing to the same classes. This error occurs in the following classes: "+
                    getMxCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +
                    " and "+ getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target")) +".", 2);
            }


            /*
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
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source")))
            {
               warningMessage("You can only have 1 relation between 2 classes. This error occurs between these two classes: "+getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target")) +" and "+
                     getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source"))+" .", "", 8);
                excessOfRelationsWarning++;
            }*/

            //Shows a error if a class has multiple inheritance
            if(getValueOrLabel(xmlDoc, i) === "is_a" &&
                getValueOrLabel(xmlDoc, j)=== "is_a" &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !==
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") !== null )
            {
                if(getLanguage() === 'pt')
                    warningMessage("Classes não podem ter herança múltipla. Sua classe "+getMxCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +" não pode ser o domínio de mais de uma relação is_a",8);
                else
                    warningMessage("A class can't have multiple inheritance. Your "+getMxCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +" class can't be the domain of more than one is_a relation",8);
                multipleInheritanceWarning++;
            }



        }


    }

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // Search for 'object' elements in the XML
    for (let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++){
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null ){


            // Show the inverse of error if the relation and the inverse Of property have the same name
            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") == xmlDoc.getElementsByTagName("object")[i].getAttribute("inverseOf")) {
                inverseOfNameWarning++;
                if(getLanguage() === 'pt')
                    warningMessage("Na relação "+xmlDoc.getElementsByTagName("object")[i].getAttribute("label") +", a propriedade inverse_of não pode ter o mesmo nome que a relação","",5);
                else
                    warningMessage("In the "+xmlDoc.getElementsByTagName("object")[i].getAttribute("label") +" relation, the Inverse Of property can't have the same name of the relation","",5);

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
            missingClassPropertiesWarning++;
            if(getLanguage() === 'pt')
                warningMessage('Na classe '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+', você não preencheu as seguintes propriedades: ' + missingClassProperties.bold()+ '',"",6);
            else
                warningMessage('In the '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+' Class, you did not fill the following properties: ' + missingClassProperties.bold()+ '',"",6);
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
            missingRelationPropertiesWarning++;
            if(getLanguage() === 'pt')
                warningMessage('Na relação '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+', você não preencheu as seguintes propriedades: ' + missingRelationProperties.bold()+ '',"",7);
            else
                warningMessage('In the '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+' Relation, you did not fill the following properties: ' + missingRelationProperties.bold()+ '',"",7);
            missingRelationProperties  = "";
        }

    }

    // /.----------- WARNINGS SEARCH --------------

    // Update the counters on front end
    $("#warnings-count").text(equalRelationBetweenClassesWarning + equalClassNamesWarning + instanceOfBetweenClassesWarning + wrongRelationWarning + inverseOfNameWarning + missingClassPropertiesWarning + missingRelationPropertiesWarning + multipleInheritanceWarning + notConnectedRelationWarning);
    $("#classes-count").text(classesCount);
    $("#relations-count").text(relationsCount);
    $("#instances-count").text(instancesCount);

    // Checks if any error can be removed from the console error
    if(equalClassNamesWarning === 0)
        removeWarning(1);
    if(equalRelationBetweenClassesWarning === 0)
        removeWarning(2);
    if(instanceOfBetweenClassesWarning === 0)
        removeWarning(3);
    if(wrongRelationWarning === 0)
        removeWarning(4);
    if(inverseOfNameWarning === 0)
        removeWarning(5);
    if(missingClassPropertiesWarning === 0)
        removeWarning(6);
    if(missingRelationPropertiesWarning === 0)
        removeWarning(7);
    if(multipleInheritanceWarning === 0)
        removeWarning(8);
    if(notConnectedRelationWarning === 0)
        removeWarning(9);


}

/**
 * Checks if the properties from a given
 * mxCell is filled
 * @param xmlDoc
 * @param i
 * return integer
 */
function filledProperties(xmlDoc, i) {
    return xmlDoc.getElementsByTagName('mxCell')[i].parentNode.getAttribute('label') !== null;
}

/**
 * Returns if the given mxCell is a relation or not
 * @returns {boolean}
 */
function isRelation(xmlDoc, id) {
    // check if the properties are filled
    if(filledProperties(xmlDoc,id))
    {
        return xmlDoc.getElementsByTagName('mxCell')[id].getAttribute('edge') !== null;
    }
    else
    return xmlDoc.getElementsByTagName("mxCell")[id].getAttribute("edge") !== null;
}

/**
 * Returns if the given mxCell is a class or not
 * @returns {boolean}
 */
function isClass(xmlDoc, id) {
    // check if the properties are filled
    if(filledProperties(xmlDoc,id))
    {
        return xmlDoc.getElementsByTagName('mxCell')[id].childNodes[0].getAttribute('edge') == null &&
               xmlDoc.getElementsByTagName("mxCell")[id].getAttribute("style").includes('ellipse');
    }
    else
    return xmlDoc.getElementsByTagName("mxCell")[id].getAttribute("edge") === null &&
        xmlDoc.getElementsByTagName("mxCell")[id].getAttribute("style").includes('ellipse');
}

/**
 * Returns if the given mxCell  is a instance or not
 * @returns {boolean}
 */
function isInstance(xmlDoc, id) {

    return xmlDoc.getElementsByTagName("mxCell")[id].getAttribute("edge") === null &&
        xmlDoc.getElementsByTagName("mxCell")[id].getAttribute("style").includes('Instance');
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
 * Returns the value(name) of a mxCell
 *
 * @param xmlDoc
 * @param id
 */
function getMxCellName(xmlDoc, id)
{
    for (let i = 2; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {
        if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") === id)
            return getValueOrLabel(xmlDoc, id);
    }
}


/**
 * Initializes the modal animation of the given error
 * @param modal
 */
function warningAnimation(modal) {
    modal.show();
    modal.animate({opacity: '0.4'}, "slow");
    modal.animate({opacity: '0.8'}, "slow");
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
        '                    <img class="direct-chat-img" src="/css/images/warningIcon.png" alt="Warning Message"><!-- /.direct-chat-img -->\n' +
        '                    <div class="direct-chat-text">\n' +
        '                      ' + text + '\n' +
        '                    </div>\n' +
        '                    <!-- /.direct-chat-text -->\n' +
        '                </div>');
    warningAnimation($(".direct-chat-msg"));
    warningAnimation($("#warning-count"));
}

/**
 * Returns the value (property) of a mxCell Tag or the label (property) of a object Tag
 * This function is used during the comparisons
 * @param xmlDoc
 * @param i
 * return a string
 */
function getValueOrLabel(xmlDoc, i)
{
    return xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") ? xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") : xmlDoc.getElementsByTagName('mxCell')[i].parentNode.getAttribute('label')
}

/**
 * Returns the id from a mxCell Tag or a object Tag
 * @param xmlDoc
 * @param i
 * return integer
 */
function getElementId(xmlDoc, i)
{
    return xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") ? xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") : xmlDoc.getElementsByTagName('mxCell')[i].parentNode.getAttribute('id')
}

/**
 * Returns the value(name)/label for the given id
 * This functions works for both object and mxCell Tags
 * @param xmlDoc
 * @param id
 * @returns {*}
 */
function getCellName(xmlDoc, id)
{
    for(let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
    {
        if(filledProperties(xmlDoc,i))
        {
            if(xmlDoc.getElementsByTagName("mxCell")[i].parentNode.getAttribute("id") == id)
                return getValueOrLabel(xmlDoc,i);
        }
        else
            if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") == id)
                return getValueOrLabel(xmlDoc,i);
    }
}

/**
 * Get the language by looking at the pathname
 * @returns {string}
 */
function getLanguage()
{
    return window.location.pathname.split('/')[1]
}