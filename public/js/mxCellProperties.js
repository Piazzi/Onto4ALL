//editor.graph.getSelectionCell()
var currentCell;

/**
 * Function called when a mxCell is selected in the editor
 * @param {mxCell} cell
 */
function getSelectedCell(cell) {
    console.log(currentCell);
    currentCell = cell;
    if (currentCell == null) return updateTabs();

    let style = currentCell.style;

    if (style.includes("Class")) {
        updateTabs("Class");
        inputs = classInputs;
    } else if (style.includes("Relation")) {
        updateTabs("Relation");
        inputs = relationInputs;
    } else if (style.includes("Instance")) {
        updateTabs("Instance");
        inputs = instanceInputs;
    } else if (style.includes("DatatypeProperty")) {
        updateTabs("DatatypeProperty");
        inputs = datatypePropertyInputs;
    } else return;

    setPropertiesInputs(cell);
}

/**
 * Disable and enable the correspondent tabs on the right sidebar
 * @param {string} cellType
 */
function updateTabs(cellType) {
    switch (cellType) {
        case "Class":
            document.getElementById("classes-nav").click();
            document
                .getElementById("object-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("datatype-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("individuals-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("classes-nav")
                .classList.remove("tab-disabled");
            document
                .getElementById("annotations-nav")
                .classList.remove("tab-disabled");
            document.getElementById("highlight-constraint-text").innerHTML = "";
            break;

        case "Relation":
            document.getElementById("object-properties-nav").click();
            document
                .getElementById("classes-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("individuals-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("datatype-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("object-properties-nav")
                .classList.remove("tab-disabled");
            document
                .getElementById("annotations-nav")
                .classList.remove("tab-disabled");
            break;

        case "Instance":
            document.getElementById("individuals-nav").click();
            document
                .getElementById("classes-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("object-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("datatype-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("individuals-nav")
                .classList.remove("tab-disabled");
            document
                .getElementById("annotations-nav")
                .classList.remove("tab-disabled");
            break;

        case "DatatypeProperty":
            document.getElementById("datatype-properties-nav").click();
            document
                .getElementById("classes-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("object-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("individuals-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("datatype-properties-nav")
                .classList.remove("tab-disabled");
            document
                .getElementById("annotations-nav")
                .classList.remove("tab-disabled");
            break;

        default:
            document.getElementById("empty-nav").click();
            document
                .getElementById("classes-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("object-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("annotations-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("datatype-properties-nav")
                .classList.add("tab-disabled");
            document
                .getElementById("individuals-nav")
                .classList.add("tab-disabled");
            break;
    }
}

/**
 * Update the cell attribute with the given name and value
 * @param {string} name
 * @param {string} value
 */
function updatePropertyInput(name, value) {
    currentCell.setAttribute(name, value);
}

/**
 * Sets the cells properties in their correpondent front end inputs
 * @param {mxCell} cell
 */
function setPropertiesInputs(cell) {
    let cellProperties = cell.value.attributes;
    console.log(cellProperties);
    for (let i = 0; i < cellProperties.length; i++) {
        // set properties
        if (inputs.hasOwnProperty(cellProperties[i].name)) {
            // if the property has a select input
            if (selectInputs.includes(cellProperties[i].name)) {
                createSelectOptions(cell, cellProperties[i].name);
                $(document).ready(function () {
                    $("#" + cellProperties[i].name)
                        .select2({
                            theme: "classic",
                            width: "resolve",
                            placeholder: "",
                            allowClear: true,
                        })
                        .val(cellProperties[i].value.split(","))
                        .trigger("change");
                });
            }
            // if the property has a checkbox input
            else if (checkboxInputs.includes(cellProperties[i].name)) {
                if (cellProperties[i].value == "true")
                    inputs[cellProperties[i].name].checked = true;
                else inputs[cellProperties[i].name].checked = false;
            } else
                inputs[cellProperties[i].name].value = cellProperties[i].value;
        }

        // set annotations
        if (annotationInputs.hasOwnProperty(cellProperties[i].name)) {
            // autocomplete IRI
            if (cellProperties[i].name == "label") {
                console.log(document.getElementById("id"));
                iriValue =
                    "https://onto4alleditor.com/" +
                    getLanguage() +
                    "/ontologies/" +
                    document.getElementById("id").value +
                    "#" +
                    annotationInputs["label"].value;
                annotationInputs[cellProperties[i].name].value = iriValue;
                currentCell.setAttribute("IRI", iriValue);
                document.getElementById("IRI-link").href = iriValue;
            }

            annotationInputs[cellProperties[i].name].value =
                cellProperties[i].value;
        }
    }
}

/**
 * Create the select options for the given property
 * @param {mxCell} cell
 */
function createSelectOptions(cell, propertyName) {
    select = document.getElementById(propertyName);
    if (select == null) return;
    if (select.options.length > 0) removeSelectOptions(select);
    let options = [];
    if (cell.isEdge()) {
        options = relations;
        if (propertyName == "inverseOf") {
            select.removeAttribute("multiple");
            options = getInverseOfOptions();
        }

        // removes current cell name from the select options
        options = options.filter(
            (e) =>
                e.id !== cell.id &&
                e.getAttribute("label") !== cell.getAttribute("label")
        );
    } else {
        options = classes.filter(
            (e) =>
                e.id !== cell.id &&
                e.getAttribute("label") !== cell.getAttribute("label")
        );
        // removes the class Thing from the options
        options = options.filter((e) =>
            getLanguage() == "en"
                ? e.getAttribute("label").toUpperCase() !== "THING"
                : e.getAttribute("label").toUpperCase() !== "COISA"
        );
    }

    // remove duplicated options
    options = options.reduce((unique, o) => {
        if (
            !unique.some(
                (obj) => obj.getAttribute("label") === o.getAttribute("label")
            )
        ) {
            unique.push(o);
        }
        return unique;
    }, []);

    options.forEach((element) => {
        let option = document.createElement("option");
        option.setAttribute("value", element.id);
        option.innerHTML = element.getAttribute("label");
        select.appendChild(option);
    });
}

/**
 * Removes the current options from the given select
 * @param {*} select
 */
function removeSelectOptions(select) {
    while (select.options.length > 0) {
        select.remove(0);
    }
}

/**
 * Returns the correct values for the inverseOf property,
 * if a relation is already a inverseOf another, it should not appear in the select options
 * @returns array
 */
function getInverseOfOptions() {
    let inverseOfValues = [];
    let options = [];

    // push the relations that is an inverse of another
    relations.forEach((relation) => {
        let inverseOf = relation.getAttribute("inverseOf").split(",");
        removeItemAll(inverseOf, "");
        removeItemAll(inverseOf, "null");
        if (inverseOf != "null" && inverseOf != "")
            inverseOfValues.push(
                getCellById(inverseOf[0]).getAttribute("label")
            );
    });

    // build the options and includes the current cell inverseOf as a selected option
    relations.forEach((relation) => {
        if (
            !inverseOfValues.includes(relation.getAttribute("label")) ||
            currentCell.getAttribute("inverseOf").includes(relation.id)
        )
            options.push(relation);
    });
    return options;
}

let inputs;
const selectInputs = [
    "Equivalence",
    "DisjointWith",
    "equivalentTo",
    "subpropertyOf",
    "inverseOf",
    "disjointWith",
    "sameAs",
    "differentAs",
];
const checkboxInputs = [
    "functional",
    "inverseFunctional",
    "transitive",
    "symetric",
    "asymmetric",
    "reflexive",
    "irreflexive",
];

// Properties for each cell
const classInputs = {
    SubClassOf: document.getElementById("SubClassOf"),
    Equivalence: document.getElementById("Equivalence"),
    Instances: document.getElementById("Instances"),
    TargetForKey: document.getElementById("TargetForKey"),
    DisjointWith: document.getElementById("DisjointWith"),
    Constraint: document.getElementById("Constraint"),
};

const relationInputs = {
    domain: document.getElementById("domain"),
    range: document.getElementById("range"),
    equivalentTo: document.getElementById("equivalentTo"),
    subpropertyOf: document.getElementById("subpropertyOf"),
    inverseOf: document.getElementById("inverseOf"),
    disjointWith: document.getElementById("disjointWith-relations"),
    functional: document.getElementById("functional"),
    inverseFunctional: document.getElementById("inverseFunctional"),
    transitive: document.getElementById("transitive"),
    symetric: document.getElementById("symetric"),
    asymmetric: document.getElementById("asymmetric"),
    reflexive: document.getElementById("reflexive"),
    irreflexive: document.getElementById("irreflexive"),
};

const annotationInputs = {
    IRI: document.getElementById("IRI"),
    label: document.getElementById("label"),
    comment: document.getElementById("comment"),
    isDefinedBy: document.getElementById("isDefinedBy"),
    seeAlso: document.getElementById("seeAlso"),
    backwardCompatibleWith: document.getElementById("backwardCompatibleWith"),
    deprecated: document.getElementById("deprecated"),
    incompatibleWith: document.getElementById("incompatibleWith"),
    priorVersion: document.getElementById("priorVersion"),
    versionInfo: document.getElementById("versionInfo"),
};

const datatypePropertyInputs = {
    value: document.getElementById("value-datatype-properties"),
    domain: document.getElementById("domain-datatype-properties"),
    range: document.getElementById("range-datatype-properties"),
    equivalentTo: document.getElementById("equivalentTo-datatype-properties"),
    subpropertyOf: document.getElementById("subpropertyOf-datatype-properties"),
    disjointWith: document.getElementById("disjointWith-datatype-properties"),
    functional: document.getElementById("functional-datatype-properties"),
    datatype: document.getElementById("datatype"),
};

const instanceInputs = {
    types: document.getElementById("types"),
    sameAs: document.getElementById("sameAs"),
    differentAs: document.getElementById("differentAs"),
    objectProperties: document.getElementById("objectProperties"),
    dataProperties: document.getElementById("dataProperties"),
    negativeObjectProperties: document.getElementById(
        "negativeObjectProperties"
    ),
    negativeDataProperties: document.getElementById("negativeDataProperties"),
};

// Add keyup events for the given textArea
let constraintInput = classInputs.Constraint;
constraintInput.addEventListener("keyup", function () {
    document.getElementById("help-text-icon").className = "fa fa-fw fa-clock-o";
    if (getLanguage() === "en")
        document.getElementById("help-text").childNodes[1].nodeValue =
            "Checking the axioms, please wait...";
    else
        document.getElementById("help-text").childNodes[1].nodeValue =
            "Checando os axiomas, aguarde um momento...";
});
// Call the Class Expression Edior / Axiom Editor 2 seconds
// after the user stops typing
constraintInput.addEventListener(
    "keyup",
    debounce(() => {
        // code you would like to run 2000ms after the keyup event has stopped firing
        // further keyup events reset the timer, as expected
        validateAxiom();
    }, 2000)
);
function debounce(callback, wait) {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            callback.apply(this, args);
        }, wait);
    };
}

const annotationsTab = document.getElementById('annotations-tab');

function createNewProperty(label){
    const formGroup = document.createElement('div');
    formGroup.classList.add('form-group');
    const newPropertyLabel = document.createElement('label', label);
    const newPropertyInput = document.createElement('input', '');
    newPropertyLabel.innerText = label;
    newPropertyInput.classList.add('form-control');
    newPropertyInput.id = label;
    newPropertyInput.addEventListener('onchange', () => {
        updateInput(this.id, this.value)
    })
    annotationInputs[label, ''];
    formGroup.appendChild(newPropertyLabel);
    formGroup.appendChild(newPropertyInput);
    annotationsTab.appendChild(formGroup);
}