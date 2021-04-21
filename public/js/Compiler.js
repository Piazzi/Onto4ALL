var classes = [], relations = [], instances = [], previousElements = [], elementsIdWithError = [], compilerCounter = 0, objects = [];
let warningsCount = 0, basicErrorsCount = 0, conceptualErrorsCount = 0;

/**
 * Searches for errors in the relation
 * @param {mxCell} relation 
 */
function compileRelation(relation) {
    let label = relation.value.getAttribute('label');
   
    // Checks if the relation is connected to 2 classes or instances
    if(label !== null && relation.target === null || relation.source === null){
        basicErrorsCount++;
        if (getLanguage() === 'pt')
            sendWarningMessage('A relação ' + label.bold() + ' (ID: ' + relation.id + ') não está conectada a duas classes', 9, 'Erro Basico');
        else
            sendWarningMessage('The relation ' + label.bold() + ' (ID: ' + relation.id + ') it is not fully connected to 2 classes', 9, 'Basic Error');
    }

    if(relation.source !== null && relation.target !== null)
    {
        // Shows a error message if two classes has been connected with the instance_of relation
        if((label == 'instance_of' || label == "instancia_um" )){
            if(relation.source.style.includes('Class') && relation.target.style.includes('Class')){
                conceptualErrorsCount++;
                if (getLanguage() === 'pt')
                sendWarningMessage("Você não pode ter uma relação instancia_um entre duas classes (" + relation.source.getAttribute('label').bold() + ', ' + relation.target.getAttribute('label').bold() + "). A relação precisa estar entre uma classe e uma instância. ", 3, " Erro Conceitual");
                else
                sendWarningMessage("You cant have a instance_of relation between two classes (" + relation.source.getAttribute('label').bold() + ', ' + relation.target.getAttribute('label').bold() + "). It must be between one class and one instance. ", 3, " Conceptual Error");
            }
        }

        // Shows a error message if the domain and range properties are equal
        if(relation.source.getAttribute('label') == relation.target.getAttribute('label')){
            basicErrorsCount++;
            if (getLanguage() === 'pt')
                sendWarningMessage('As propriedades domain e range da relaçao ' + relation.getAttribute('label').bold() + ' não podem ser iguais.', "", 'Erro Básico');
            else
                sendWarningMessage('The properties domain and range from the ' + relation.getAttribute('label').bold() + ' relation cannot be equal.', "", 'Basic Error');

        }
    }


    
}

/**
 * Searches for errors in the class
 * @param {mxCell} classCell 
 */
function compileClass(classCell) {

    // remove the current class from the classes array
    let classesToCompare = classes.filter(item => item.id !== classCell.id);

    // Shows a error message if two classes have the same name
    if(classCell.getAttribute('label') !== null)
        for (let i = 0; i < classesToCompare.length; i++) {
            if(classCell.getAttribute('label') == classesToCompare[i].getAttribute('label')){
                conceptualErrorsCount++;
                if (getLanguage() === 'pt')
                    sendWarningMessage("Você não pode ter duas classes com o mesmo nome, você tem duas classes chamadas " + classCell.getAttribute('label').bold() + ".", 1, 'Erro Conceitual');
                else
                    sendWarningMessage("You can not have two classes with the same name, you have two classes named " + classCell.getAttribute('label').bold() + ".", 1, 'Conceptual Error');
            } 
        }

    if(classCell.edges !== null && classCell.edges.length > 1){

        // Shows a error message if two classes has the same relation between them more than one time
        let connectedRelations = classCell.edges.filter(relation => relation.target !== null && relation.source !== null && relation.getAttribute('label') !== "");
        for (let i = 0; i < connectedRelations.length; i++) {
            for (let j = 0; j < connectedRelations.length; j++) {
                if(connectedRelations[i].id != connectedRelations[j].id && connectedRelations[i].getAttribute('label') == connectedRelations[j].getAttribute('label') && connectedRelations[i].target.getAttribute('label') == connectedRelations[j].target.getAttribute('label') && connectedRelations[i].source.getAttribute('label') == connectedRelations[j].source.getAttribute('label')){
                    basicErrorsCount++;
                    if (getLanguage() === 'pt')
                        sendWarningMessage("Você não pode ter duas relações iguais apontando para as mesmas classes. Esse erro ocorre nas seguintes classes: " + connectedRelations[i].source.getAttribute('label') + " e " + connectedRelations[i].target.getAttribute('label') + ".", 2, 'Erro Básico');
                    else
                        sendWarningMessage("You can't have 2 equal relations pointing to the same classes. This error occurs in the following classes: " + connectedRelations[i].source.getAttribute('label') + " and " + connectedRelations[i].target.getAttribute('label') + ".", 2, 'Basic Error');
                    connectedRelations.splice(i, 1);
                    connectedRelations.splice(j, 1);
                } 
            }
            
        }

        //Shows a error if a class has multiple inheritance
        let inheritanceCount = 0;
        classCell.edges.forEach(relation => {
            if(relation.getAttribute('label') == 'is_a' || relation.getAttribute('label') == 'é_um' && relation.source !== null){
                if(relation.source.id == classCell.id){
                    inheritanceCount++;
                }
            }
        });
        if(inheritanceCount > 1){
            warningsCount++;
            if(getLanguage() == 'pt')
                sendWarningMessage("Classes não podem ter herança múltipla. Sua classe " + classCell.getAttribute('label') + "(ID: " + classCell.id + ") não pode ser o domínio de mais de uma relação is_a", 8, 'Má Prática');
            else
                sendWarningMessage("A class can't have multiple inheritance. Your " + classCell.getAttribute('label') + "(ID: " + classCell.id + ") class can't be the domain of more than one is_a relation", 8, 'Bad Practice');
        }

    }

    
    


}

/**
 * Searches for errors in the instance
 * @param {mxCell} instance 
 */
function compileInstance(instance) {
    
    // shows a error if there is any relation besides instance_of connected to a instance
    if(instance.edges !== null && instance.edges.length > 0){
        instance.edges.forEach(relation => {
            if(relation.getAttribute('label') !== 'instance_of' && relation.getAttribute('label') !== 'instancia_um'){
                conceptualErrorsCount++;
                if (getLanguage() === 'pt')
                sendWarningMessage("Você só poder ter uma relação instancia_um entre uma classe e uma instância. (" + relation.getAttribute('label').bold() + ")", 4, ' Erro Conceitual');
                else
                sendWarningMessage("You can only have a instance_of relation between a class and a instance. (" + relation.getAttribute('label').bold() + ")", 4, ' Conceptual Error'); 
            }
        });
    }
}

/**
 * Compile only the label of the cell to find any measurable error
 * @param {string} label
 */
function compileLabel(label) {
    
    // Check if the label contains a Acronym
    if (/^([a-z]\.)+/i.test(label)) {
        warningsCount++;
        if (getLanguage() === 'pt')
            sendWarningMessage("É recomendável que os nomes não tenham acrônimos. (" + label.bold() + ")", '', 'Má Prática');
        else
            sendWarningMessage("It is recommended that the labels do not have acronyms. (" + label.bold() + ")", '', 'Bad Practice');
    }

     // Check if the label is all on uppercase
     if (/^[^a-z]*$/.test(removeSpaces(label))) {
        warningsCount++;
        if (getLanguage() === 'pt')
            sendWarningMessage("É recomendável que os nomes sejam escritos em letras minúsculas. (" + label.bold() + ")", '', 'Má Prática');
        else
            sendWarningMessage("It is recommended that labels are written in lowercase letters. (" + label.bold() + ")", '', 'Bad Practice');
    }

}

/**
 * Gets the current cells from the graph after any change is made.
 * And finds any measurable error.
 * @param graphModel
 */
function compileCells(graphModel)
{
    console.log(editor.getGraphXml());
    console.log(graphModel.cells);
    //graphModel.cells[2].setStyle("ellipse;whiteSpace=wrap;html=1;aspect=fixed;Class;fillColor=#66B2FF;strokeColor=#FF0000;");
    //graph.getModel().setValue(cell, value);
    classes = [];
    relations = [];
    instances = [];
    warningsCount = 0, basicErrorsCount = 0, conceptualErrorsCount = 0;
    compilerCounter++;

    // Removes the previous error messages
    $(".direct-chat-messages").empty();

    let missingClassProperties = "", missingRelationProperties = "";

    let currentCells = graphModel.cells;
    // iterate throught the current cells in the graph to find any measurable error
    for (const [key, cell] of Object.entries(currentCells)) {
        if (typeof cell.value === "undefined")
            continue;
        
        if(cell.isEdge()){
            relations.push(cell);
            compileRelation(cell);
        }
        else if(cell.style.includes('Class')){
            classes.push(cell);
            compileClass(cell);
        }
        else if(cell.style.includes('Instance')){
            instances.push(cell);
            compileInstance(cell);
        }
        else
            continue;

        compileLabel(cell.getAttribute('label'));

        
    }

    // Shows a error if a Thing Class doesn't exist in the current ontology
    if(!thingClassExists()){
        basicErrorsCount++;
        if (getLanguage() === 'pt')
            sendWarningMessage('É necessário que toda ontologia tenha uma classe chamada Coisa. Adicione uma classe Coisa a sua ontologia.', "", "Erro Conceitual");
        else
            sendWarningMessage('It is necessary that every ontology has a class called Thing. Add a Thing class to your ontology.', "", "Conceptual Error");
    }
   

            /*
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   
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
             missingRelationProperties = missingRelationProperties + ' range,';


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

    
    }

   */
    


    updateCountersInFrontEnd(warningsCount, basicErrorsCount, conceptualErrorsCount);
    updateConsoleColors(warningsCount, basicErrorsCount, conceptualErrorsCount);
    updateSaveButtonInFrontEnd(false);

    previousElements = currentCells;
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
 * Autocomplete the SubClassOf, Domain, Range, DisjointWith, EquivalentTo and hasSynonum properties.
 * @param element
 * @param propertyName
 * @param inputField
 */
function autoCompleteInputs(element, propertyName, inputField) {

    // check if the element is a relation
    if (element.edge == true) {
        if (element.source && element.source.id != null && propertyName === 'domain')
            inputField.value = findNameById(previousElements, element.source.id);
        if (element.target && element.target.id != null && propertyName === 'range')
            inputField.value = findNameById(previousElements, element.target.id);
    }
    else if (propertyName === 'SubClassOf' && (element.value !== 'Thing' && element.value !== 'Coisa'))
    {
        for (let i = 0; i < previousElements.length; i++)
            if (isRelation(previousElements[i]) && (getValueOrLabel(previousElements[i]) === 'is_a' || getValueOrLabel(previousElements[i]) === 'é_um') && previousElements[i].getAttribute("source") == element.id)
                inputField.value = findNameById(previousElements, previousElements[i].getAttribute("target"));
    }

    if(propertyName in autoCompleteProperties){
        let values = [];
        let currentElementName = typeof element.value === 'object' ? element.value.getAttribute('label') : element.value;
        for (let i = 0; i < objects.length; i++) {
            if(isClass(objects[i].childNodes[0]) || isRelation(objects[i].childNodes[0]))
            {
                let propertyValues = objects[i].getAttribute(propertyName)?.split(',');
                if(propertyValues?.indexOf(currentElementName) > -1)
                   values.push(objects[i].getAttribute('label'));
            }

        }
        return values;
    }
    return null;
}

/**
 * Update the save button in the front end
 */
function updateSaveButtonInFrontEnd(saved) {
    let message = '';
    // Updates the save file button
    if(saved)
    {
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
    for (let i = 0; i < classes.length; i++)
        if (classes[i].getAttribute('label').toUpperCase() === 'THING' || classes[i].getAttribute('label').toUpperCase() === 'COISA')
            return true;
    return false;
}

/**
 * Adds a Thing Class to the current ontology
 * This function is called by Actions.js
 */
function addThingClassToCurrentOntology() {
    let object = mxUtils.createXmlDocument().createElement('object');
    object.setAttribute('label', getLanguage() == 'en' ? 'Thing' : 'Coisa');
    classProperties.forEach(element => {object.setAttribute( element, '');});
    annotations.forEach(element => {object.setAttribute( element, '');});
    editor.graph.insertVertex(editor.graph.getDefaultParent(), null, object, 20, 20, 80, 80, "ellipse;whiteSpace=wrap;html=1;aspect=fixed;Class;fillColor=#00A65A;strokeColor=#FFFFFF;fontColor=#FFFFFF;");
}


