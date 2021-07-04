//editor.graph.getSelectionCell()
var currentCell;
/**
 * Function called when a mxCell is selected in the editor
 * @param {mxCell} cell 
 */
function getSelectedCell(cell) {
    console.log(currentCell);
    currentCell = cell;
    if(currentCell == null)
        return updateTabs();
        
    let style = currentCell.style;

    if(style.includes('Class')){
        updateTabs('Class');
        inputs = classInputs;
    } else if(style.includes('Relation')){
        updateTabs('Relation');
        inputs = relationInputs;
    } else if(style.includes('Instance')){
        updateTabs('Instance');
        inputs = instanceInputs
    } else if(style.includes('DatatypeProperty')){
        updateTabs('DatatypeProperty');
        inputs = datatypePropertyInputs;
    } else
        return;
    
    setInputs(cell);
}

/**
 * Disable and enable the correspondent tabs on the right sidebar
 * @param {string} cellType 
 */
function updateTabs(cellType) {
    switch (cellType) {
        case 'Class':
            document.getElementById("classes-nav").click();
            document.getElementById("object-properties-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.add('tab-disabled');
            document.getElementById("individuals-nav").classList.add('tab-disabled');
            document.getElementById("classes-nav").classList.remove('tab-disabled');
            document.getElementById("annotations-nav").classList.remove('tab-disabled');
            break;

        case 'Relation':
            document.getElementById("object-properties-nav").click()
            document.getElementById("classes-nav").classList.add('tab-disabled');
            document.getElementById("individuals-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.add('tab-disabled');
            document.getElementById("object-properties-nav").classList.remove('tab-disabled');
            document.getElementById("annotations-nav").classList.remove('tab-disabled');
            break;
    
        case 'Instance':
            document.getElementById("individuals-nav").click();
            document.getElementById("classes-nav").classList.add('tab-disabled');
            document.getElementById("object-properties-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.add('tab-disabled');
            document.getElementById("individuals-nav").classList.remove('tab-disabled');
            document.getElementById("annotations-nav").classList.remove('tab-disabled');
            break;

        case 'DatatypeProperty':
            document.getElementById("datatype-properties-nav").click();
            document.getElementById("classes-nav").classList.add('tab-disabled');
            document.getElementById("object-properties-nav").classList.add('tab-disabled');
            document.getElementById("individuals-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.remove('tab-disabled');
            document.getElementById("annotations-nav").classList.remove('tab-disabled');
            break;
            
        default:
            document.getElementById("empty-nav").click();
            document.getElementById("classes-nav").classList.add('tab-disabled');
            document.getElementById("object-properties-nav").classList.add('tab-disabled');
            document.getElementById("annotations-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.add('tab-disabled');
            document.getElementById("individuals-nav").classList.add('tab-disabled');
            break;
    }
}


/**
 * Sets the cells properties in their correpondent front end inputs
 * @param {mxCell} cell 
 */
 function setInputs(cell) {
 
    let cellProperties = cell.value.attributes;
    
    for (let i = 0; i < cellProperties.length; i++) {
        console.log(cellProperties[i]);
        // set properties
        if(inputs.hasOwnProperty(cellProperties[i].name))
            if(cellProperties[i].name in selectInputs)
            $(document).ready(function () {
                $('#'+cellProperties[i].name).select2({
                    theme: 'classic',
                    width: 'resolve',
                    placeholder: "",
                    allowClear: true,
                }).val(cellProperties[i].value).trigger('change');
            });
        else
            inputs[cellProperties[i].name].value = cellProperties[i].value;
        // set annotations
        if(annotationInputs.hasOwnProperty(cellProperties[i].name))
            annotationInputs[cellProperties[i].name].value = cellProperties[i].value;
    }
}


/**
 * Update the current cell with the inputs set in front end
 * @param {mxCell} cell 
 */
function updateCurrentCell(cell) {
    
}

let inputs;

let selectInputs = ["Equivalence","DisjointWith", "equivalentTo","subpropertyOf","inverseOf","disjointWith","sameAs","differentAs"];

// Properties for each cell 
let classInputs = {
    "SubClassOf": document.getElementById('SubClassOf'),
    "Equivalence": document.getElementById('Equivalence'),
    "Instances": document.getElementById('Instances'),
    "TargetForKey": document.getElementById('TargetForKey'),
    "DisjointWith": document.getElementById('DisjointWith'),
    "Constraint": document.getElementById('Constraint')
}

let relationInputs = {
    "domain": document.getElementById("domain"),
    "range": document.getElementById("range"),
    "equivalentTo": document.getElementById("equivalentTo"),
    "subpropertyOf": document.getElementById("subpropertyOf"),
    "inverseOf": document.getElementById("inverseOf"),
    "disjointWith": document.getElementById("disjointWith-relations"),
    "functional": document.getElementById("functional"),
    "inverseFunctional": document.getElementById("inverseFunctional"),
    "transitive": document.getElementById("transitive"),
    "symetric": document.getElementById("symetric"),
    "asymmetric": document.getElementById("asymmetric"),
    "reflexive": document.getElementById("reflexive"),
    "irreflexive": document.getElementById("irreflexive")
}

let annotationInputs = {
    "label": document.getElementById('label'),
    "comment": document.getElementById('comment'),
    "isDefinedBy": document.getElementById('isDefinedBy'),
    "seeAlso": document.getElementById('seeAlso'),
    "backwardCompatibleWith": document.getElementById('backwardCompatibleWith'),
    "deprecated": document.getElementById('deprecated'),
    "incompatibleWith": document.getElementById('incompatibleWith'),
    "priorVersion": document.getElementById('priorVersion'),
    "versionInfo": document.getElementById('versionInfo')
}

let datatypePropertyInputs = {
    "label": document.getElementById('label-datatype-properties'),
    "domain": document.getElementById('domain-datatype-properties'),
    "range": document.getElementById('range-datatype-properties'),
    "equivalentTo": document.getElementById('equivalentTo-datatype-properties'),
    "subpropertyOf":  document.getElementById('subpropertyOf-datatype-properties'),
    "disjointWith": document.getElementById('disjointWith-datatype-properties'),
    "functional": document.getElementById('functional-datatype-properties'),
    "datatype": document.getElementById('datatype')
}

let instanceInputs = {
    "label": document.getElementById("label-individuals"),
    "types": document.getElementById("types"),
    "sameAs": document.getElementById("sameAs"),
    "differentAs": document.getElementById("differentAs"),
    "objectProperties": document.getElementById("objectProperties"),
    "dataProperties": document.getElementById("dataProperties"),
    "negativeObjectProperties": document.getElementById("negativeObjectProperties"),
    "negativeDataProperties": document.getElementById("negativeDataProperties")
}

