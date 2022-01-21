
var classes = [],
    relations = [],
    instances = [],
    previousCells = [],
    compilerCounter = 0;

let warningsCount = 0,
    basicErrorsCount = 0,
    conceptualErrorsCount = 0;

const saveOntology = document.getElementById("save-ontology");
const warnings = document.getElementById("warnings");
const errors = document.getElementById("errors");
const warningsConsole = document.getElementById("warnings-console");
const directChatMessages = document.querySelector(".direct-chat-messages");

/**
 * Gets the current cells from the graph after any change is made.
 * And finds any measurable error.
 */
function compileCells() {

    resetVariables();
    removePreviousConsoleMessages();

    // iterate throught the current cells in the graph to find any measurable error
    for (const [key, cell] of Object.entries(editor.graph.getModel().cells)) {
        // skip the cells that is not valid for compilation
        if (typeof cell.value !== "object") continue;

        resetElementErrorFlag(cell);
        compileLabel(cell);

        if (cell.style.includes("Relation")) {
            relations.push(cell);
            compileRelation(cell);
        } else if (cell.style.includes("Class")) {
            classes.push(cell);
            compileClass(cell);
        } else if (cell.style.includes("Instance")) {
            instances.push(cell);
            compileInstance(cell);
        }
        else continue;

        setElementColor(cell);
    }

    thingClassExists();
    updateCountersInFrontEnd(
        warningsCount,
        basicErrorsCount,
        conceptualErrorsCount
    );
    updateConsoleColors(warningsCount, basicErrorsCount, conceptualErrorsCount);
    updateSaveButtonInFrontEnd(false);
}

function removePreviousConsoleMessages() {
    directChatMessages.innerHTML = "";
}

/**
 * Reset variables to it's default state
 */
function resetVariables() {
    previousCells = classes.concat(relations).concat(instances);
    (classes = []),
        (relations = []),
        (instances = []);
    (warningsCount = 0), (basicErrorsCount = 0), (conceptualErrorsCount = 0);
    compilerCounter++;
}


/**
 * Searches for errors in the relation
 * @param {mxCell} relation
 */
function compileRelation(relation) {
    let label = relation.getAttribute("label");

    // Checks if the relation is connected to 2 classes or instances
    if (
        (label !== null && relation.target === null) ||
        relation.source === null
    ) {
        basicErrorsCount++;
        if (getLanguage() === "pt")
            sendWarningMessage(
                "A relação " +
                label.bold() +
                " (ID: " +
                relation.id +
                ") não está conectada a duas classes",
                "Erro Basico",
                relation
            );
        else
            sendWarningMessage(
                "The relation " +
                label.bold() +
                " (ID: " +
                relation.id +
                ") it is not fully connected to 2 classes",
                "Basic Error",
                relation
            );
    }

    if (relation.source !== null && relation.target !== null) {
        // Shows a error message if two classes has been connected with the instance_of relation
        if (label == "instance_of" || label == "instancia_um") {
            if (
                relation.source.style.includes("Class") &&
                relation.target.style.includes("Class")
            ) {
                conceptualErrorsCount++;
                if (getLanguage() === "pt")
                    sendWarningMessage(
                        "Você não pode ter uma relação instancia_um entre duas classes (" +
                        relation.source.getAttribute("label").bold() +
                        ", " +
                        relation.target.getAttribute("label").bold() +
                        "). A relação precisa estar entre uma classe e uma instância. ",
                        "Erro Conceitual",
                        relation
                    );
                else
                    sendWarningMessage(
                        "You cant have a instance_of relation between two classes (" +
                        relation.source.getAttribute("label").bold() +
                        ", " +
                        relation.target.getAttribute("label").bold() +
                        "). It must be between one class and one instance. ",
                        "Conceptual Error",
                        relation
                    );
            }
        }

        // Shows a error message if the domain and range properties are equal
        /*
        if(relation.source.getAttribute('label') == relation.target.getAttribute('label')){
            basicErrorsCount++;
            if (getLanguage() === 'pt')
                sendWarningMessage('As propriedades domain e range da relaçao ' + relation.getAttribute('label').bold() + ' não podem ser iguais.',  'Erro Básico');
            else
                sendWarningMessage('The properties domain and range from the ' + relation.getAttribute('label').bold() + ' relation cannot be equal.',  'Basic Error');

        }*/
    }

    // Autocomplete the domain and range properties
    if (relation.source !== null)
        relation.setAttribute("domain", extractContent(relation.source.getAttribute("label")));
    else relation.setAttribute("domain", "");
    if (relation.target !== null)
        relation.setAttribute("range", extractContent(relation.target.getAttribute("label")));
    else relation.setAttribute("range", "");

    // Search for missing properties in each relation element
    let missingRelationProperties = "";

    if (relation.getAttribute("domain") === "")
        missingRelationProperties = missingRelationProperties + " domain,";

    if (relation.getAttribute("range") === "")
        missingRelationProperties = missingRelationProperties + " range,";

    // is_a relations don't have a inverse of
    /*
    if (
        relation.getAttribute("label") !== "is_a" &&
        relation.getAttribute("label") !== "é_um " &&
        relation.getAttribute("inverseOf") === ""
    )
        missingRelationProperties = missingRelationProperties + " inverseOf";
    */

    if (missingRelationProperties !== "") {
        warningsCount++;
        if (getLanguage() === "pt")
            sendWarningMessage(
                "Na relação " +
                relation.getAttribute("label").bold() +
                "(ID: " +
                relation.id.bold() +
                ")" +
                ", você não preencheu as seguintes propriedades: " +
                missingRelationProperties.bold() +
                "",
                "Má Prática",
                relation
            );
        else
            sendWarningMessage(
                "In the " +
                relation.getAttribute("label").bold() +
                "(ID: " +
                relation.id.bold() +
                ")" +
                " Relation, you did not fill the following properties: " +
                missingRelationProperties.bold() +
                "",
                "Bad Practice",
                relation
            );
        missingRelationProperties = "";
    }
}

/**
 * Searches for errors in the class
 * @param {mxCell} classCell
 */
function compileClass(classCell) {
    // Shows a error message if two classes have the same name
    if (classCell.getAttribute("label") !== null) {
        // remove the current class from the classes array
        let classesToCompare = classes.filter(
            (item) => item.id !== classCell.id
        );
        let classesLenght = classesToCompare.length;
        for (let i = 0; i < classesLenght; i++) {
            if (
                classCell.getAttribute("label") ==
                classesToCompare[i].getAttribute("label")
            ) {
                conceptualErrorsCount++;
                if (getLanguage() === "pt")
                    sendWarningMessage(
                        "Você não pode ter duas classes com o mesmo nome, você tem duas classes chamadas " +
                        classCell.getAttribute("label").bold() +
                        ".",
                        "Erro Conceitual",
                        classCell
                    );
                else
                    sendWarningMessage(
                        "You can not have two classes with the same name, you have two classes named " +
                        classCell.getAttribute("label").bold() +
                        ".",
                        "Conceptual Error",
                        classCell
                    );
            }
        }
    }

    if (classCell.edges !== null) {
        // Autocomplete the SubClassOf property
        let isSubClassOf = 0;
        classCell.edges.forEach((relation) => {
            if (
                (relation.getAttribute("label") == "is_a" ||
                    relation.getAttribute("label") == "é_um") &&
                relation.source !== null &&
                relation.target !== null &&
                relation.source.id == classCell.id
            ) {
                isSubClassOf++;
                classCell.setAttribute(
                    "SubClassOf",
                    extractContent(relation.target.getAttribute("label"))
                );
            }
        });
        if (isSubClassOf == 0) classCell.setAttribute("SubClassOf", "");

        let classCellEdgesLength = classCell.edges.length;
        if (classCellEdgesLength > 1) {
            // Shows a error message if two classes has the same relation between them more than one time
            let connectedRelations = classCell.edges.filter(
                (relation) =>
                    relation.target !== null &&
                    relation.source !== null &&
                    relation.getAttribute("label") !== ""
            );
            let connectedRelationsLenght = connectedRelations.length;
            for (let i = 0; i < connectedRelationsLenght; i++) {
                for (let j = 0; j < connectedRelationsLenght; j++) {
                    if (
                        connectedRelations[i].id != connectedRelations[j].id &&
                        connectedRelations[i].getAttribute("label") ==
                        connectedRelations[j].getAttribute("label") &&
                        connectedRelations[i].target.getAttribute("label") ==
                        connectedRelations[j].target.getAttribute(
                            "label"
                        ) &&
                        connectedRelations[i].source.getAttribute("label") ==
                        connectedRelations[j].source.getAttribute("label")
                    ) {
                        basicErrorsCount++;
                        if (getLanguage() === "pt")
                            sendWarningMessage(
                                "Você não pode ter duas relações iguais apontando para as mesmas classes. Esse erro ocorre nas seguintes classes: " +
                                connectedRelations[i].source.getAttribute(
                                    "label"
                                ) +
                                " e " +
                                connectedRelations[i].target.getAttribute(
                                    "label"
                                ) +
                                ".",
                                "Erro Básico",
                                classCell
                            );
                        else
                            sendWarningMessage(
                                "You can't have 2 equal relations pointing to the same classes. This error occurs in the following classes: " +
                                connectedRelations[i].source.getAttribute(
                                    "label"
                                ) +
                                " and " +
                                connectedRelations[i].target.getAttribute(
                                    "label"
                                ) +
                                ".",
                                "Basic Error",
                                classCell
                            );
                        connectedRelations.splice(i, 1);
                        connectedRelations.splice(j, 1);
                    }
                }
            }

            //Shows a error if a class has multiple inheritance
            let inheritanceCount = 0;
            classCell.edges.forEach((relation) => {
                if (
                    (relation.getAttribute("label") == "is_a" ||
                        relation.getAttribute("label") == "é_um") &&
                    relation.source !== null
                ) {
                    if (relation.source.id == classCell.id) {
                        inheritanceCount++;
                    }
                }
            });
            if (inheritanceCount > 1) {
                warningsCount++;
                if (getLanguage() == "pt")
                    sendWarningMessage(
                        "Classes não podem ter herança múltipla. Sua classe " +
                        classCell.getAttribute("label") +
                        "(ID: " +
                        classCell.id +
                        ") não pode ser o domínio de mais de uma relação is_a",
                        "Má Prática",
                        classCell
                    );
                else
                    sendWarningMessage(
                        "A class can't have multiple inheritance. Your " +
                        classCell.getAttribute("label") +
                        "(ID: " +
                        classCell.id +
                        ") class can't be the domain of more than one is_a relation",
                        "Bad Practice",
                        classCell
                    );
            }
        }
    }

    /*
    if( classCell.getAttribute("label") !== 'Thing' && classCell.getAttribute("label") !== 'Coisa')
    {
        // Search for missing properties in each class element
        let missingClassProperties = "";
        //if(classCell.getAttribute('definition') === "")
        //    missingClassProperties = missingClassProperties + ' definition,';

        if ((classCell.getAttribute("SubClassOf") === ""))
            missingClassProperties = missingClassProperties + ' SubClassOf';

        //if ((classCell.getAttribute("exampleOfUsage") === ""))
        //    missingClassProperties = missingClassProperties + ' exampleOfUsage';

        if (missingClassProperties !== "") {
            basicErrorsCount++;
            if (getLanguage() === 'pt')
                sendWarningMessage('Na classe ' + classCell.getAttribute("label").bold() + ', você não preencheu as seguintes propriedades: ' + missingClassProperties.bold() + '',  'Erro Básico');
            else
                sendWarningMessage('In the ' + classCell.getAttribute("label").bold() + ' Class, you did not fill the following properties: ' + missingClassProperties.bold() + '',  'Basic Error');
                missingClassProperties = "";
        }
    }*/
    if (classCell.getAttribute("DisjointWith") !== "")
        autoCompleteProperty(classCell, "DisjointWith");
}

/**
 * Searches for errors in the instance
 * @param {mxCell} instance
 */
function compileInstance(instance) {
    // shows a error if there is any relation besides instance_of connected to a instance
    /*
    if (instance.edges !== null && instance.edges.length > 0) {
        instance.edges.forEach((relation) => {
            if (
                relation.getAttribute("label") !== "instance_of" &&
                relation.getAttribute("label") !== "instancia_um"
            ) {
                conceptualErrorsCount++;
                if (getLanguage() === "pt")
                    sendWarningMessage(
                        "Você só poder ter uma relação instancia_um entre uma classe e uma instância. (" +
                        relation.getAttribute("label").bold() +
                        ")",
                        "Erro Conceitual",
                        instance
                    );
                else
                    sendWarningMessage(
                        "You can only have a instance_of relation between a class and a instance. (" +
                        relation.getAttribute("label").bold() +
                        ")",
                        " Conceptual Error",
                        instance
                    );
            }
        });
    }
    */

}

/**
 * Compile only the label of the cell to find any measurable error
 * @param {mxCell} cell
 */
function compileLabel(cell) {
    let label = cell.getAttribute("label");

    cell.setAttribute("label", sanitizeString(label));

    // Check if the label contains a Acronym
    if (/^([a-z]\.)+/i.test(label)) {
        warningsCount++;
        if (getLanguage() === "pt")
            sendWarningMessage(
                "É recomendável que os nomes não tenham acrônimos. (" +
                label.bold() +
                ")",
                "Má Prática",
                cell
            );
        else
            sendWarningMessage(
                "It is recommended that the labels do not have acronyms. (" +
                label.bold() +
                ")",
                "Bad Practice",
                cell
            );
    }
}

/**
 * Sanitizes the string, removing HTML entities and replacing unwanted characters
 * @param {*} string
 * @returns string
 */
function sanitizeString(string) {
    string = string.split(" ").join("_");
    string = string.replace(/[&]nbsp[;]/gi, "");
    return string;
}

/**
 * Creates a new warning message in the warning console for the given text
 * @param text
 * @param type
 */
function sendWarningMessage(text, type, element) {
    setErrorFlag(element);
    let warning = {
        icon: "fa-warning",
        backgroundColor: "#f39c12",
        borderColor: "#f39c12",
        imgSrc: "/css/images/warningIcon.png",
    };
    if (type !== "Bad Practice" && type !== "Má Prática")
        warning = {
            icon: "fa-close",
            backgroundColor: "indianred",
            borderColor: "indianred",
            imgSrc: "/css/images/error-icon.png",
        };

    directChatMessages.innerHTML +=
        ' <div class="direct-chat-msg ">' +
        '<div class="direct-chat-info clearfix">' +
        '<span class="direct-chat-name pull-right">' +
        '<i class="fa' +
        warning.icon +
        '"></i>' +
        "<strong> " +
        type +
        "  </strong>" +
        "</span>" +
        '<span class="direct-chat-timestamp pull-left">' +
        new Date().toLocaleString() +
        "</span>" +
        "</div>" +
        '<img class="direct-chat-img" src="' +
        warning.imgSrc +
        '" alt="Warning Message">' +
        '<div style="background-color: ' +
        warning.backgroundColor +
        "; color: white; border-color: " +
        warning.borderColor +
        '" class="direct-chat-text"> ' +
        text +
        "</div>" +
        "</div>";
}

/**
 * Get the language by looking at the pathname
 * @returns {string}
 */
function getLanguage() {
    return window.location.pathname.split("/")[1];
}

/**
 * Gets all classes or relations names in the current diagram
 * @returns {Array}
 */
function getElementsNames(category = "Class") {
    let names = [];
    let relationsLength = relations.length, classesLength = classes.length, instancesLength = instances.length;
    if (category === "Relation") {
        for (let i = 0; i < relationsLength; i++)
            names.push(relations[i].getAttribute("label"));
    } else if (category === "Class") {
        for (let i = 0; i < classesLength; i++)
            names.push(classes[i].getAttribute("label"));
    } else if (category === "Instance") {
        for (let i = 0; i < instancesLength; i++)
            names.push(instances[i].getAttribute("label"));
    }
    return names;
}

/**
 * Cleans the given string, removing white spaces and trash
 * @param string
 * @returns {*}
 */
function removeSpaces(string) {
    if (string === "" || string === null) return "";
    string = string.replace(/[&]nbsp[;]/gi, " ");
    string = string.replace(/[<]br[^>]*[>]/gi, "");
    return string.replace(/\s/g, "");
}

/**
 * Autocomplete the equivalentProperty, inverseOf, DisjointWith, EquivalentTo and hasSynonym properties.
 * @param cell
 * @param propertyName
 */
function autoCompleteProperty(cell, propertyName) {
    switch (propertyName) {
        //Autocomplete for the properties: inverseOf, equivalentProperty, DisjointWith, EquivalentTo and hasSynonym
        default:
            let cellsIds = cell.getAttribute(propertyName).split(",");
            // remove the current cell id from another cell property if needed
            // this happens when the user remove a cell from an property
            let cells;
            cell.isEdge() ? (cells = relations) : (cells = classes);

            cells.forEach((currentCell) => {
                let cellProperty = currentCell
                    .getAttribute(propertyName)
                    .split(",");
                if (
                    cellProperty.includes(cell.id) &&
                    !cellsIds.includes(currentCell.id)
                ) {
                    let index = cellProperty.indexOf(cell.id);
                    if (index > -1) {
                        cellProperty.splice(index, 1);
                        currentCell.setAttribute(propertyName, cellProperty);
                    }
                }
                // remove the value from the other relations with same label
                if (cell.isEdge()) {
                    let relationsLength = relations.length;
                    for (let i = 0; i < relationsLength; i++) {
                        if (
                            relations[i].getAttribute("label") ==
                            cell.getAttribute("label") &&
                            relations[i].getAttribute(propertyName) !=
                            cell.getAttribute(propertyName)
                        ) {
                            relations[i].setAttribute(
                                propertyName,
                                cell.getAttribute(propertyName)
                            );
                            // propragates the update to the other relations
                            autoCompleteProperty(
                                getCellById(relations[i].id, "Relation"),
                                propertyName
                            );
                        }
                    }
                }
            });

            // update the property value in the correspondent cells
            cellsIds.forEach((id) => {
                if (id != "" && id != "null") {
                    // update the property value in other relations with the same label
                    if (cell.isEdge()) {
                        let relationsLength = relations.length;
                        let cellToUpdate = getCellById(id, "Relation");
                        for (let i = 0; i < relationsLength; i++) {
                            if (
                                relations[i].id != cell.id &&
                                relations[i].getAttribute("label") ==
                                cellToUpdate.getAttribute("label")
                            ) {
                                let updatedValue = relations[i]
                                    .getAttribute(propertyName)
                                    .split(",");
                                if (!updatedValue.includes(cell.id))
                                    updatedValue.push(cell.id);
                                relations[i].setAttribute(
                                    propertyName,
                                    updatedValue
                                );
                            }

                            if (
                                relations[i].getAttribute("label") ==
                                cell.getAttribute("label")
                            ) {
                                relations[i].setAttribute(
                                    propertyName,
                                    cell.getAttribute(propertyName)
                                );
                            }
                        }
                    }

                    let cellToUpdate = getCellById(
                        id,
                        cell.isEdge() ? "Relation" : "Class"
                    );
                    if (cellToUpdate != undefined) {
                        let updatedValue = cellToUpdate
                            .getAttribute(propertyName)
                            .split(",");
                        removeItemAll(updatedValue, "null");
                        removeItemAll(updatedValue, "");
                        if (!updatedValue.includes(cell.id))
                            updatedValue.push(cell.id);
                        cellToUpdate.setAttribute(propertyName, updatedValue);
                    }
                }
            });
            break;
    }
}

/**
 * Update the save button in the front end
 */
function updateSaveButtonInFrontEnd(saved) {
    let message = "";
    let icon = document.createElement("i");
    icon.className = "fa fa-fw fa-cloud-upload";
    // Updates the save file button
    if (saved) {
        if (getLanguage() == "pt") message = "Todas as alterações foram salvas";
        else message = "All changes saved";
        saveOntology.classList.remove("unsaved");
        saveOntology.classList.add("saved");
        saveOntology.innerHTML = message;
        saveOntology.prepend(icon);

        if (window.location.origin == ip_address) {
            if (document.getElementById('id').value > 0) {
                socket.emit('updateOntology', document.getElementById('id').value);
            }
        }
    } else {
        if (getLanguage() == "pt")
            message = "Alterações não salvas. Clique aqui para salvar";
        else message = "Unsaved changes. Click here to save";
        saveOntology.classList.remove("saved");
        saveOntology.classList.add("unsaved");
        saveOntology.innerHTML = message;
        saveOntology.prepend(icon);
    }

    // shows the button only if the user has made chances in the empty diagram
    if (compilerCounter > 1) saveOntology.style.visibility = "visible";
}


/**
 * Update the save button error in the front end
 */
function updateSaveButtonErrorInFrontEnd() {
    let message = "";
    let icon = document.createElement("i");
    icon.className = "fa fa-fw fa-cloud-upload";
    // Updates the save file button
    if (getLanguage() == "pt") message = "Ocorreu um erro ao salvar as alterações";
    else message = "An error occurred saving changes";
    saveOntology.classList.add("unsaved");
    saveOntology.classList.remove("saved");
    saveOntology.innerHTML = message;
    saveOntology.prepend(icon);

    // shows the button only if the user has made chances in the empty diagram
    if (compilerCounter > 1) saveOntology.style.visibility = "visible";
}

/**
 * Updates the counters in the front end
 * @param warningsCount
 * @param basicErrorsCount
 * @param conceptualErrorsCount
 */
function updateCountersInFrontEnd(
    warningsCount,
    basicErrorsCount,
    conceptualErrorsCount
) {
    document.querySelector("#warnings-count").textContent = warningsCount;
    document.querySelector("#error-count").textContent =
        basicErrorsCount + conceptualErrorsCount;
    document.querySelector("#classes-count").textContent = classes.length;
    document.querySelector("#relations-count").textContent = relations.length;
    document.querySelector("#instances-count").textContent = instances.length;

}

/**
 * Change the console colors based on the number of errors on the current ontology
 * @param warningsCount
 * @param basicErrorsCount
 * @param conceptualErrorsCount
 */
function updateConsoleColors(
    warningsCount,
    basicErrorsCount,
    conceptualErrorsCount
) {
    let borderColor = "#00a65a";
    if (warningsCount !== 0) {
        borderColor = "#f39c12";
        warnings.style.setProperty("background-color", "#f39c12", "important");
    }
    if (basicErrorsCount + conceptualErrorsCount !== 0) {
        borderColor = "indianred";
        errors.style.setProperty("background-color", "indianred", "important");
    }
    warningsConsole.style.setProperty("border-color", borderColor, "important");

    if (basicErrorsCount + conceptualErrorsCount + warningsCount === 0) {
        warnings.style.setProperty("background-color", "#00a65a", "important");
        errors.style.setProperty("background-color", "#00a65a", "important");
        warningsConsole.style.setProperty(
            "border-color",
            "#00a65a",
            "important"
        );
        let message = "You dont have any warnings.";
        if (getLanguage() === "pt") message = "Voce não tem nenhum aviso";
        directChatMessages.innerHTML +=
            '<img id="no-warning-img" class="direct-chat-img" src="/css/images/LogoMini.png" alt="Message User Image"><div id="no-warning-text" class="direct-chat-text">' +
            message +
            "</div>";
    }
}

/**
 * Check if the Thing Class exists in the current ontology
 */
function thingClassExists() {
    let classesLength = classes.length;
    for (let i = 0; i < classesLength; i++)
        if (
            classes[i].getAttribute("label").toUpperCase() === "THING" ||
            classes[i].getAttribute("label").toUpperCase() === "COISA"
        )
            return true;

    basicErrorsCount++;
    if (getLanguage() === "pt")
        sendWarningMessage(
            "É necessário que toda ontologia tenha uma classe chamada Coisa. Adicione uma classe Coisa a sua ontologia.",
            "Erro Conceitual"
        );
    else
        sendWarningMessage(
            "It is necessary that every ontology has a class called Thing. Add a Thing class to your ontology.",
            "Conceptual Error"
        );
}

/**
 * Adds a Thing Class to the current ontology
 * This function is called by Actions.js
 */
function addThingClassToCurrentOntology() {
    let object = mxUtils.createXmlDocument().createElement("object");
    classProperties.forEach((element) => {
        object.setAttribute(element, "");
    });
    annotations.forEach((element) => {
        object.setAttribute(element, "");
    });
    object.setAttribute("label", getLanguage() == "en" ? "Thing" : "Coisa");
    editor.graph.insertVertex(
        editor.graph.getDefaultParent(),
        null,
        object,
        20,
        20,
        80,
        80,
        "ellipse;whiteSpace=wrap;html=1;aspect=fixed;dashed=1;Class;"
    );
}

/**
 * Find a cell using the id
 * @param {string} id
 * @param {string} type
 * @returns object
 */
function getCellById(id, type) {
    if (type == "Class") cells = classes;
    else if (type == "Relation") cells = relations;
    else if (type == "Instance") cells = instances;
    else cells = relations.concat(classes).concat(instances);
    let cellsLength = cells.length;
    for (let i = 0; i < cellsLength; i++)
        if (cells[i].id == id) return cells[i];
}

/**
 * Removes all ocurrences of an value in the array
 * @param {*} arr
 * @param {*} value
 * @returns array
 */
function removeItemAll(arr, value) {
    let i = 0;
    let arrayLength = arr.length;
    while (i < arrayLength) {
        if (arr[i] === value) {
            arr.splice(i, 1);
        } else {
            ++i;
        }
    }
    return arr;
}

/**
 * Return if a cell exists in the current graph
 * @param {*} id
 */
function cellExists(id) {
    let cells = classes.concat(relations).concat(instances);
    let cellsLength = cells.length;
    for (let i = 0; i < cellsLength; i++)
        if (cells[i].id == id) return true;

    return false;
}

/**
 * Returns an array of cell names
 * @param {*} ids
 * @returns array
 */
function getCellsNamesById(ids) {
    let names = [];
    ids.forEach((id) => {
        names.push(getCellById(id, null).getAttribute("label"));
    });
    return names;
}

/**
 * Set an error flag in the element style
 * @param {mxCell} element
 */
function setErrorFlag(element) {
    if (element != undefined && !element.style.includes("error=true;"))
        element.setStyle(element.style + "error=true;");
}

/**
 * Given the element set it's border color if it's a class/instance property
 * or fill color if it's a relation property based if the element
 * has any error or warning attached to it
 * @param {mxCell} element
 */
function setElementColor(element) {

    if (element.style.includes("error=true;")) {
        if (!element.style.includes("strokeColor=#d73925;")) {
            editor.graph.setCellStyles(mxConstants.STYLE_STROKECOLOR, '#d73925', [element])
        }
    }
    // remove error flag and return the cell to its default colors
    else {
        element.setStyle(element.style.replace("error=true;", ""));
        let color;
        if (element.style.includes('Relation'))
            color = '#004C99';
        else if (element.style.includes('Class'))
            color = '#f39c12';
        else if (element.style.includes('Instance'))
            color = '#663399';
        else
            return
        editor.graph.setCellStyles(mxConstants.STYLE_STROKECOLOR, color, [element])

    }
}

/**
 * Reset the element error flag
 * @param {mxCell} element
 */
function resetElementErrorFlag(element) {
    element.setStyle(element.style.replace("error=true;", ""));

}

/**
 * Get the text content from a HTML string
 * @param html
 * @returns {string}
 */
function extractContent(html) {
    return new DOMParser().parseFromString(html, "text/html") .
        documentElement . textContent;

}
