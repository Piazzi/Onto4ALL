/**
 * This file is responsible for the warning console in the editor page
 * The main function is the movementCompiler()
 */

var classes = [], relations = [], instances = [], previousElements = [], elementsIdWithError = [], compilerCounter = 0;

/**
 * Gets the XML from the editor after any change is made.
 * And finds any measurable error.
 * @param xml
 */
function movementCompiler(xml) {
    classes = [];
    relations = [];
    instances = [];
    compilerCounter++;

    // Removes the previous error messages
    $(".direct-chat-messages").empty();

    let xmlDoc, missingClassProperties = "", missingRelationProperties = "", warningsCount = 0, basicErrorsCount = 0,
        conceptualErrorsCount = 0;
    xmlDoc = new DOMParser().parseFromString(xml, "text/xml");

    //console.log("Elementos Antigos", previousElements);
    // get a array of HTML elements representing the Classes, Instances and Relations
    let elements = xmlDoc.getElementsByTagName("mxCell");
    //console.log("Elementos Atuais", elements);

    // Starts the XML interpretation send by the editor
    // Each mxCell element is compared to each other to find any measurable error
    // Complexity: O(n^2)
    for (let i = 1; i < elements.length; i++) {
        try {
            if (!elementIsValid(elements[i]))
                continue;

            if (isRelation(elements[i]))
                relations.push(elements[i]);
            else if (isClass(elements[i]))
                classes.push(elements[i]);
            else if (isInstance(elements[i]))
                instances.push(elements[i]);
            else
                continue;

        } catch (e) {
            console.log(e);
            console.log('Element: ', elements[i]);
            console.log('Parent: ', elements[i].parentNode);
            continue;
        }

        /*
        console.log(getElementId(elements[i]));
        if (elements[i].isEqualNode(previousElements[i]) && elementsIdWithError.indexOf(getElementId(elements[i])) === -1) {
            continue;
        }*/

        //editor.editor.setGraphXml();
        //console.log(xmlDoc.documentElement);

        if (isRelation(elements[i])) {
            // Checks if the relation is connected to 2 classes
            if (getValueOrLabel(elements[i]) !== null && elements[i].getAttribute("target") === null || elements[i].getAttribute("source") === null) {
                basicErrorsCount++;
                addIdToErrorArray(getElementId(elements[i]));
                if (getLanguage() === 'pt')
                    sendWarningMessage('A relação ' + getValueOrLabel(elements[i]).bold() + ' (ID: ' + getElementId(elements[i]) + ') não está conectada a duas classes', 9, 'Erro Basico');
                else
                    sendWarningMessage('The relation ' + getValueOrLabel(elements[i]).bold() + ' (ID: ' + getElementId(elements[i]) + ') it is not fully connected to 2 classes', 9, 'Basic Error');
            }

            // Shows a error message if two classes has been connected with the instance_of relation
            if ((getValueOrLabel(elements[i]) === 'instance_of' || getValueOrLabel(elements[i]) === 'instancia_um') && (elements[i].hasAttribute("source") && elements[i].hasAttribute("target"))) {
                let domainClass, rangeClass;
                // Look for the two mxCells using the ids
                for (let k = 0; k < elements.length; k++) {
                    if (!elementIsValid(elements[k]))
                        continue;
                    if (getElementId(elements[k]) === elements[i].getAttribute("source"))
                        domainClass = elements[k];
                    if (getElementId(elements[k]) === elements[i].getAttribute("target"))
                        rangeClass = elements[k];

                }

                // shows a error if the mxCells are two classes
                if (isClass(domainClass) && isClass(rangeClass)) {
                    conceptualErrorsCount++;
                    addIdToErrorArray(getElementId(elements[i]));
                    if (getLanguage() === 'pt')
                        sendWarningMessage("Você não pode ter uma relação instancia_um entre duas classes (" + getValueOrLabel(domainClass).bold() + ', ' + getValueOrLabel(rangeClass).bold() + "). A relação precisa estar entre uma classe e uma instância. ", "", " Erro Conceitual");
                    else
                        sendWarningMessage("You cant have a instance_of relation between two classes (" + getValueOrLabel(domainClass).bold() + ', ' + getValueOrLabel(rangeClass).bold() + "). It must be between one class and one instance. ", "", " Conceptual Error");
                }
            }
        }

        // If the mxCell is a Instance, start searching for his relations. If any relation belonging to the instance it's not a instance_of
        // relation, shows a error message
        if (isInstance(elements[i])) {
            for (let k = 0; k < elements.length; k++) {
                if (elements[k].getAttribute("edge") != null &&
                    getValueOrLabel(elements[k]) !== 'instance_of' &&
                    getValueOrLabel(elements[k]) !== 'instancia_um' &&
                    elements[k].getAttribute("source") === getElementId(elements[i]) ||
                    elements[k].getAttribute("target") === getElementId(elements[i]) &&
                    elements[k].getAttribute("source") !== null &&
                    elements[k].getAttribute("target") !== null) {

                    conceptualErrorsCount++;
                    addIdToErrorArray(getElementId(elements[i]));
                    addIdToErrorArray(getElementId(elements[k]));
                    if (getLanguage() === 'pt')
                        sendWarningMessage("Você só poder ter uma relação instancia_um entre uma classe e uma instância. (" + findNameById(elements, elements[k].getAttribute("source")).bold() + ")", "", ' Erro Conceitual');
                    else
                        sendWarningMessage("You can only have a instance_of relation between a class and a instance. (" + findNameById(elements, elements[k].getAttribute("source")).bold() + ")", "", ' Conceptual Error');
                }
            }
            // skip to the next iteration because this is the only error for instances implemented yet
            continue;
        }

        let name = removeSpaces(getValueOrLabel(elements[i]));
        // Check if the Name is in Plural or singular
        /*
        if(isClass(elements[i]) && name.charAt(name.length-1) === 's' || name.charAt(name.length-1) === 'S')
        {
            warningsCount++;
            if(getLanguage() === 'pt')
                sendWarningMessage("É recomendável que os nomes estejam no singular e não no plural.",'','Má Prática');
            else
                sendWarningMessage("It is recommended that the names be in the singular and not in the plural",'','Bad Practice')
        }*/

        // Check if the name contains a Acronym
        // /([a-z]{1}\.)/gi
        // /^([a-z]\.)+/i
        // /^([a-z]\.)+$/i
        if (/^([a-z]\.)+/i.test(name)) {
            warningsCount++;
            addIdToErrorArray(getElementId(elements[i]));
            if (getLanguage() === 'pt')
                sendWarningMessage("É recomendável que os nomes não tenham acrônimos. (" + name.bold() + ")", '', 'Má Prática');
            else
                sendWarningMessage("It is recommended that the names do not have acronyms. (" + name.bold() + ")", '', 'Bad Practice');
        }

        // Check if the name is all on uppercase
        if (/^[^a-z]*$/.test(removeSpaces(name))) {
            warningsCount++;
            addIdToErrorArray(getElementId(elements[i]));
            if (getLanguage() === 'pt')
                sendWarningMessage("É recomendável que os nomes sejam escritos em letras minúsculas. (" + name.bold() + ")", '', 'Má Prática');
            else
                sendWarningMessage("It is recommended that names are written in lowercase letters. (" + name.bold() + ")", '', 'Bad Practice');
        }

        for (let j = i + 1; j < elements.length; j++) {
            // Shows a error message if two classes has the same name
            if (isClass(elements[i]) && isClass(elements[j]) && (getValueOrLabel(elements[i]) === getValueOrLabel(elements[j])) && (getElementId(elements[i]) !== getElementId(elements[j])) && getValueOrLabel(elements[i]) != null && getValueOrLabel(elements[j]) != null) {
                conceptualErrorsCount++;
                addIdToErrorArray(getElementId(elements[i]));
                addIdToErrorArray(getElementId(elements[j]));
                if (getLanguage() === 'pt')
                    sendWarningMessage("Você não pode ter duas classes com o mesmo nome, você tem duas classes chamadas " + (getValueOrLabel(elements[i])).bold() + ".", 1, 'Erro Conceitual');
                else
                    sendWarningMessage("You can not have two classes with the same name, you have two classes named " + (getValueOrLabel(elements[i])).bold() + ".", 1, 'Conceptual Error');

            }

            if (isRelation(elements[i]) && isRelation(elements[j])) {
                // Shows a error message if two classes has the same relation between them more than one time
                if (getValueOrLabel(elements[i]) ===
                    getValueOrLabel(elements[j]) &&
                    elements[i].getAttribute("target") ===
                    elements[j].getAttribute("target") &&
                    elements[i].getAttribute("source") ===
                    elements[j].getAttribute("source") &&
                    getValueOrLabel(elements[i]) != null &&
                    getValueOrLabel(elements[j]) != null &&
                    (elements[i].getAttribute("target") != null &&
                        elements[j].getAttribute("target") != null &&
                        elements[i].getAttribute("source") != null &&
                        elements[j].getAttribute("source") != null)) {
                    basicErrorsCount++;
                    addIdToErrorArray(getElementId(elements[i]));
                    addIdToErrorArray(getElementId(elements[j]));

                    if (getLanguage() === 'pt')
                        sendWarningMessage("Você não pode ter duas relações iguais apontando para as mesmas classes. Esse erro ocorre nas seguintes classes: " +
                            findNameById(elements, elements[i].getAttribute("source")) +
                            " e " + findNameById(elements, elements[i].getAttribute("target")) + ".", '', 'Erro Básico');
                    else
                        sendWarningMessage("You can't have 2 equal relations pointing to the same classes. This error occurs in the following classes: " +
                            findNameById(elements, elements[i].getAttribute("source")) +
                            " and " + findNameById(elements, elements[i].getAttribute("target")) + ".", '', 'Basic Error');
                }

                //Shows a error if a class has multiple inheritance
                if (getLanguage() === 'en' && getValueOrLabel(elements[i]) === "is_a" &&
                    getValueOrLabel(elements[j]) === "is_a" &&
                    elements[i].getAttribute("source") ===
                    elements[j].getAttribute("source") &&
                    elements[i].getAttribute("target") !==
                    elements[j].getAttribute("target") &&
                    elements[i].getAttribute("target") !== null &&
                    elements[j].getAttribute("target") !== null &&
                    elements[i].getAttribute("source") !== null &&
                    elements[j].getAttribute("source") !== null) {
                    sendWarningMessage("A class can't have multiple inheritance. Your " + findNameById(elements, elements[i].getAttribute("source")) + "(ID: " + elements[i].getAttribute('id') + ") class can't be the domain of more than one is_a relation", 8, 'Bad Practice');
                    warningsCount++;
                    addIdToErrorArray(getElementId(elements[i]));
                    addIdToErrorArray(getElementId(elements[j]));

                } else if (getValueOrLabel(elements[i]) === "é_um" &&
                    getValueOrLabel(elements[j]) === "é_um" &&
                    elements[i].getAttribute("source") ===
                    elements[j].getAttribute("source") &&
                    elements[i].getAttribute("target") !==
                    elements[j].getAttribute("target") &&
                    elements[i].getAttribute("target") !== null &&
                    elements[j].getAttribute("target") !== null &&
                    elements[i].getAttribute("source") !== null &&
                    elements[j].getAttribute("source") !== null) {
                    sendWarningMessage("Classes não podem ter herança múltipla. Sua classe " + findNameById(elements, elements[i].getAttribute("source")) + "(ID: " + elements[i].getAttribute('id') + ") não pode ser o domínio de mais de uma relação is_a", 8, 'Má Prática');
                    warningsCount++;
                    addIdToErrorArray(getElementId(elements[i]));
                    addIdToErrorArray(getElementId(elements[j]));

                }
            }

            /*
            // Shows a error message if a class has more than one relation attached to it
            if(elements[i].getAttribute("edge") != null &&
                elements[j].getAttribute("edge") != null &&
                elements[i].getAttribute("source") != null &&
                elements[j].getAttribute("source") != null &&
                elements[i].getAttribute("target") != null &&
                elements[j].getAttribute("target") != null &&
                (elements[i].getAttribute("target") ===
                elements[j].getAttribute("target") &&
                elements[i].getAttribute("source") ===
                elements[j].getAttribute("source")))
            {
               sendWarningMessage("You can only have 1 relation between 2 classes. This error occurs between these two classes: "+getMxCellName(xmlDoc, elements[j].getAttribute("target")) +" and "+
                     getMxCellName(xmlDoc, elements[j].getAttribute("source"))+" .", "", 8);
                excessOfRelationsWarning++;
            }*/

        }


    }

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // Search for 'object' elements in the XML
    let objects = xmlDoc.getElementsByTagName("object");
    for (let i = 0; i < objects.length; i++) {

        if (objects[i].getAttribute("label") != null) {
            // Show the inverse of error if the relation and the inverse Of property have the same name
            if (objects[i].getAttribute("label") === objects[i].getAttribute("inverseOf")) {
                conceptualErrorsCount++;
                addIdToErrorArray(objects[i].getAttribute("id"));
                if (getLanguage() === 'pt')
                    sendWarningMessage("Na relação " + objects[i].getAttribute("label") + ", a propriedade inverse_of não pode ter o mesmo nome que a relação", "", 'Erro Conceitual');
                else
                    sendWarningMessage("In the " + objects[i].getAttribute("label") + " relation, the Inverse Of property can't have the same name of the relation", "", 'Conceptual Error');

            }

        }

        if (isClass(objects[i].childNodes[0])) {
            // Search for missing properties in each class element
            if (objects[i].getAttribute("definition") === "")
                missingClassProperties = missingClassProperties + ' definition,';


            if (objects[i].getAttribute("SubClassOf") === "")
                missingClassProperties = missingClassProperties + ' SubClassOf,';


            if (objects[i].getAttribute("exampleOfUsage") === "")
                missingClassProperties = missingClassProperties + ' exampleOfUsage';

            if (missingClassProperties !== "") {
                basicErrorsCount++;
                addIdToErrorArray(objects[i].getAttribute("id"));
                if (getLanguage() === 'pt')
                    sendWarningMessage('Na classe ' + objects[i].getAttribute("label").bold() + ', você não preencheu as seguintes propriedades: ' + missingClassProperties.bold() + '', "", 'Erro Básico');
                else
                    sendWarningMessage('In the ' + objects[i].getAttribute("label").bold() + ' Class, you did not fill the following properties: ' + missingClassProperties.bold() + '', "", 'Basic Error');
                missingClassProperties = "";
            }
        }

        // Search for missing properties in each relation element
        /* if (objects[i].getAttribute("domain") === "")
             missingRelationProperties = missingRelationProperties + ' domain,';


         if (objects[i].getAttribute("range") === "")
             missingRelationProperties = missingRelationProperties + ' range,';*/


        if (objects[i].getAttribute("inverseOf") === "")
            missingRelationProperties = missingRelationProperties + ' inverseOf';

        if (missingRelationProperties !== "") {
            basicErrorsCount++;
            addIdToErrorArray(objects[i].getAttribute("id"));
            if (getLanguage() === 'pt')
                sendWarningMessage('Na relação ' + objects[i].getAttribute("label").bold() + '(ID: ' + objects[i].getAttribute("id").bold() + ')' + ', você não preencheu as seguintes propriedades: ' + missingRelationProperties.bold() + '', "", 'Erro Básico');
            else
                sendWarningMessage('In the ' + objects[i].getAttribute("label").bold() + '(ID: ' + objects[i].getAttribute("id").bold() + ')' + ' Relation, you did not fill the following properties: ' + missingRelationProperties.bold() + '', "", 'Basic Error');
            missingRelationProperties = "";
        }

        // Throws a error if the domain and range properties are equal
        if (isRelation(objects[i].childNodes[0]) &&
            objects[i].getAttribute("domain") ===
            objects[i].getAttribute("range")) {
            basicErrorsCount++;
            addIdToErrorArray(objects[i].getAttribute("id"));
            if (getLanguage() === 'pt')
                sendWarningMessage('As propriedades domain e range da relaçao ' + objects[i].getAttribute("label").bold() + ' não podem ser iguais.', "", 'Erro Básico');
            else
                sendWarningMessage('The properties domain and range from the ' + objects[i].getAttribute("label").bold() + ' relation cannot be equal.', "", 'Basic Error');
        }

    }

    // Throws a error if the things class doesnt exists in the current ontology
    if (!thingClassExists()) {
        basicErrorsCount++;
        if (getLanguage() === 'pt')
            sendWarningMessage('É necessário que toda ontologia tenha uma classe chamada Coisa. Adicione uma classe Coisa a sua ontologia.', "", "Erro Conceitual");
        else
            sendWarningMessage('It is necessary that every ontology has a class called Thing. Add a Thing class to your ontology.', "", "Conceptual Error");
    }


    updateCountersInFrontEnd(warningsCount, basicErrorsCount, conceptualErrorsCount);
    updateConsoleColors(warningsCount, basicErrorsCount, conceptualErrorsCount);
    updateSaveButtonInFrontEnd(false);

    previousElements = elements;
    elementsIdWithError = [];
}

/**
 * Checks if the properties from a given
 * element is filled
 * @param element
 * return integer
 */
function filledProperties(element) {
    try {
        return element.parentNode.getAttribute('label') !== null && element.parentNode.nodeName === 'object' || element.nodeName === 'object';
    } catch (e) {
        console.log(e);
    }
}

/**
 * Returns if the given element is a relation or not
 * @returns {boolean}
 */
function isRelation(element) {
    try {
        return element.getAttribute('edge') != null
        // ||// element.childNodes[0].getAttribute("style").includes('Relation');
    } catch (e) {
        console.log(e);
    }
}

/**
 * Returns if the given element is a class or not
 * @returns {boolean}
 */
function isClass(element) {
    try {
        return element.getAttribute("style").includes('ellipse');
    } catch (e) {
        console.log(e);
    }
}

/**
 * Returns if the given element is a instance or not
 * @returns {boolean}
 */
function isInstance(element) {
    return element.getAttribute("edge") === null && element.getAttribute("style").includes('Instance');
}

/**
 * Creates a new warning message in the warning console for the given text
 * @param text
 * @param warningId
 * @param type
 */
function sendWarningMessage(text, warningId, type) {
    let warning = {
        icon: 'fa-warning',
        backgroundColor: '#f39c12',
        borderColor: '#f39c12',
        imgSrc: '/css/images/warningIcon.png'
    };
    if (type !== 'Bad Practice' && type !== 'Má Prática')
        warning = {
            icon: 'fa-close',
            backgroundColor: 'indianred',
            borderColor: 'indianred',
            imgSrc: '/css/images/error-icon.png'
        };

    $(".direct-chat-messages").append(' <div class="direct-chat-msg ">' +
        '<div class="direct-chat-info clearfix">' +
        '<span class="direct-chat-name pull-right">' +
        '<i class="fa' + warning.icon + '"></i>' +
        '<strong> ' + type + '  </strong>' +
        '</span>' +
        '<span class="direct-chat-timestamp pull-left">' + new Date().toLocaleString() + '</span>' +
        '</div>' +
        '<img class="direct-chat-img" src="' + warning.imgSrc + '" alt="Warning Message">' +
        '<div style="background-color: ' + warning.backgroundColor + '; color: white; border-color: ' + warning.borderColor + '" class="direct-chat-text"> ' + text + '</div>' +
        '</div>');
}

/**
 * Returns the value (property) of a mxCell Tag or the label (property) of a object Tag
 * This function is used during the comparisons
 * @param element
 * return a string
 */
function getValueOrLabel(element) {
    return element.getAttribute("value") ? element.getAttribute("value") : element.parentNode.getAttribute('label')
}

/**
 * Returns the id from a mxCell Tag or a object Tag
 * @param element
 * return integer
 */
function getElementId(element) {
    if (element)
        return element.getAttribute("id") ? element.getAttribute("id") : element.parentNode.getAttribute('id')
}

/**
 * Returns the value(name)/label for the given id
 * This functions works for both object and mxCell Tags
 * @param id
 * @param elements
 * @returns {*}
 */
function findNameById(elements, id) {
    for (let i = 0; i < elements.length; i++)
        if (getElementId(elements[i]) === id)
            return getValueOrLabel(elements[i])
}

/**
 * Get the language by looking at the pathname
 * @returns {string}
 */
function getLanguage() {
    return window.location.pathname.split('/')[1]
}

/**
 * Check if the mxCell is valid (have the necessary attributes for the compiler to read)
 * @param mxCell
 * @returns {boolean}
 */
function elementIsValid(mxCell) {
    try {
        return mxCell.hasAttribute('style') && mxCell.hasAttribute('parent');
    } catch (e) {
        console.log(e);
    }
    // mxCell.getAttribute('style').includes('Relation') ||
    //    mxCell.getAttribute('style').includes('Instance') ||
    //  mxCell.getAttribute('style').includes('Class');
    //else
    //   return false;
}

/**
 * Gets all classes names in the current diagram
 * @returns {Array}
 */
function getElementsNames(category = 'Class') {
    let names = [];
    if (category === 'Relation') {
        for (let i = 0; i < relations.length; i++)
            names.push(getValueOrLabel(relations[i]));
    } else {
        for (let i = 0; i < classes.length; i++)
            names.push(getValueOrLabel(classes[i]));
    }
    return names;
}

/**
 * Cleans the given string, removing white spaces and trash
 * @param string
 * @returns {*}
 */
function removeSpaces(string) {
    if (string === '' || string === null)
        return '';
    string = string.replace(/[&]nbsp[;]/gi, " ");
    string = string.replace(/[<]br[^>]*[>]/gi, "");
    return string.replace(/\s/g, '');
}

/**
 * Add the element id to the array if he aren't there
 * @param elementId
 */
function addIdToErrorArray(elementId) {
    if (elementsIdWithError.indexOf(elementId) === -1)
        elementsIdWithError.push(elementId);
}

/**
 * Autocomplete the SubClassOf, Domain and Range properties.
 * @param element
 * @param propertyName
 * @param inputField
 */
function autoCompleteInputs(element, propertyName, inputField) {
    console.log(element.value);
    // check if the element is a relation
    if (element.edge == true) {
        if (element.source && element.source.id != null && propertyName === 'domain')
            inputField.value = findNameById(previousElements, element.source.id);
        if (element.target && element.target.id != null && propertyName === 'range')
            inputField.value = findNameById(previousElements, element.target.id);
    } else {
        if (propertyName === 'SubClassOf' && (element.value !== 'Thing' && element.value !== 'Coisa'))
            for (let i = 0; i < previousElements.length; i++)
                if (isRelation(previousElements[i]) && (getValueOrLabel(previousElements[i]) === 'is_a' || getValueOrLabel(previousElements[i]) === 'é_um') && previousElements[i].getAttribute("source") == element.id)
                    inputField.value = findNameById(previousElements, previousElements[i].getAttribute("target"));
    }
}

/**
 * Update the save button in the front end
 */
function updateSaveButtonInFrontEnd(saved) {
    let message = '';
    // Updates the save file button
    if(saved)
    {
        console.log(document.getElementById('save-ontology'));
        if(getLanguage() == 'pt')
            message = 'Todas as alterações foram salvas';
        else
            message = 'All changes saved';
        $("#save-ontology").removeClass("unsaved").addClass("saved").html('<i class="fa fa-fw fa-cloud-upload"></i> '+message+'');
    }
    else
    {
        if(getLanguage() == 'pt')
        message = 'Alterações não salvas. Clique aqui para salvar';
        else
        message = 'Unsaved changes. Click here to save';
        $("#save-ontology").removeClass("saved").addClass("unsaved").html('<i class="fa fa-fw fa-cloud-upload"></i> '+message+'');
    }

    // shows the button only if the user has made chances in the empty diagram
    if(compilerCounter > 1)
     $("#save-ontology").css("visibility", "visible")
}

/**
 * Updates the counters in the front end
 * @param warningsCount
 * @param basicErrorsCount
 * @param conceptualErrorsCount
 */
function updateCountersInFrontEnd(warningsCount, basicErrorsCount, conceptualErrorsCount) {
    $("#warnings-count").text(warningsCount);
    $("#error-count").text(basicErrorsCount + conceptualErrorsCount);
    $("#classes-count").text(classes.length);
    $("#relations-count").text(relations.length);
    $("#instances-count").text(instances.length);
}

/**
 * Change the console colors based on the number of errors on the current ontology
 * @param warningsCount
 * @param basicErrorsCount
 * @param conceptualErrorsCount
 */
function updateConsoleColors(warningsCount, basicErrorsCount, conceptualErrorsCount) {
    let borderColor = '#00a65a';
    if (warningsCount !== 0) {
        borderColor = '#f39c12';
        $('#warnings')[0].style.setProperty('background-color', '#f39c12', 'important');
    }
    if (basicErrorsCount + conceptualErrorsCount !== 0) {
        borderColor = 'indianred';
        $('#errors')[0].style.setProperty('background-color', 'indianred', 'important');
    }
    $('#warnings-console')[0].style.setProperty('border-color', borderColor, 'important');

    if (basicErrorsCount + conceptualErrorsCount + warningsCount === 0) {
        $('#warnings')[0].style.setProperty('background-color', '#00a65a', 'important');
        $('#errors')[0].style.setProperty('background-color', '#00a65a', 'important');
        $('#warnings-console')[0].style.setProperty('border-color', '#00a65a', 'important');
        let message = 'You dont have any warnings.';
        if (getLanguage() === 'pt')
            message = 'Voce não tem nenhum aviso';
        $(".direct-chat-messages").append('<img id="no-warning-img" class="direct-chat-img" src="/css/images/LogoMini.png" alt="Message User Image"><div id="no-warning-text" class="direct-chat-text">' + message + '</div>');
    }
}

/**
 * Check if the Thing Class exists in the current ontology
 */
function thingClassExists() {
    let classes = getElementsNames();
    for (let i = 0; i < classes.length; i++)
        if (classes[i].toUpperCase() === 'THING' || classes[i].toUpperCase() === 'COISA')
            return true;
    return false;
}

/**
 * Adds a Thing Class to the current ontology
 * This function is called by Actions.js
 */
function addThingClassToCurrentOntology() {
    let xmlDoc = document.implementation.createDocument(null, "", null);
    let xml = editor.getGraphXml();
    let rootNode = xml.childNodes[0];
    let classNode = xmlDoc.createElement("mxCell");
    // Sets each attribute following the default pattern of the editor

    classNode.setAttribute("id", 2);
    if (getLanguage() === 'en')
        classNode.setAttribute("value", 'Thing');
    else
        classNode.setAttribute("value", 'Coisa');
    classNode.setAttribute("style", "ellipse;whiteSpace=wrap;html=1;aspect=fixed;Class;fillColor=#00A65A;strokeColor=#FFFFFF;shadow=1;fontColor=#FFFFFF;");
    classNode.setAttribute("vertex", "1");
    classNode.setAttribute("parent", "1");

    let mxGeometryNode = xmlDoc.createElement("mxGeometry");
    mxGeometryNode.setAttribute("width", "80");
    mxGeometryNode.setAttribute("as", "geometry");
    mxGeometryNode.setAttribute("x", "20");
    mxGeometryNode.setAttribute("y", "20");
    mxGeometryNode.setAttribute("height", "80");

    classNode.appendChild(mxGeometryNode);
    rootNode.appendChild(classNode);

    editor.setGraphXml(xml);
}

