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
        setInputs(cell);
    } else if(style.includes('Relation')){
        updateTabs('Relation');
        setInputs(cell);
    } else if(style.includes('Instance')){
        updateTabs('Instance');
        setInputs(cell);
    } else if(style.includes('DatatypeProperty')){
        updateTabs('DatatypeProperty');
        setInputs(cell);
    } else
        return;
    
}

/**
 * Disable and enable the correspondent tabs on the right sidebar
 * @param {string} cellType 
 */
function updateTabs(cellType) {
    switch (cellType) {
        case 'Class':
            document.getElementById("classes-nav").classList.remove('tab-disabled');
            document.getElementById("classes-nav").click();
            document.getElementById("object-properties-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.add('tab-disabled');
            document.getElementById("annotations-nav").classList.remove('tab-disabled');
            document.getElementById("individuals-nav").classList.add('tab-disabled');
            break;

        case 'Relation':
            document.getElementById("classes-nav").classList.add('tab-disabled');
            document.getElementById("object-properties-nav").classList.remove('tab-disabled');
            document.getElementById("object-properties-nav").click()
            document.getElementById("annotations-nav").classList.remove('tab-disabled');

            break;
    
        case 'Instance':
            document.getElementById("classes-nav").classList.add('tab-disabled');
            document.getElementById("object-properties-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.add('tab-disabled');
            document.getElementById("individuals-nav").classList.remove('tab-disabled');
            document.getElementById("individuals-nav").click();
            document.getElementById("annotations-nav").classList.remove('tab-disabled');

            break;

        case 'DatatypeProperty':
            document.getElementById("classes-nav").classList.add('tab-disabled');
            document.getElementById("datatype-properties-nav").classList.remove('tab-disabled');
            document.getElementById("datatype-properties-nav").click();
            document.getElementById("annotations-nav").classList.remove('tab-disabled');
            document.getElementById("object-properties-nav").classList.add('tab-disabled');

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
    let cellType = cell.style;

    if(cellType.includes('Class')){
        subClassOf.value = cellProperties.SubClassOf.value;
        equivalence.value = cellProperties.Equivalence.value;
        instancesInput.value = cellProperties.Instances.value;
        targetForKey.value = cellProperties.TargetForKey.value;
        disjointWith.value = cellProperties.DisjointWith.value;
        constraint.value = cellProperties.Constraint.value;
    } else if(cellType.includes('Relation')) {
        domain.value = cellProperties.domain.value;
        range.value = cellProperties.range.value;
        equivalentTo.value = cellProperties.equivalentTo.value;
        subpropertyOf.value = cellProperties.subpropertyOf.value;
        inverseOf.value = cellProperties.inverseOf.value;
        disjointWithRelations.value = cellProperties.disjointWith.value;
        functional.value = cellProperties.functional.value;
        inverseFunctional.value = cellProperties.inverseFunctional.value;
        transitive.value = cellProperties.transitive.value;
        equivalentTo.value = cellProperties.equivalentTo.value;
        symetric.value = cellProperties.symetric.value;
        asymmetric.value = cellProperties.asymmetric.value;
        reflexive.value = cellProperties.reflexive.value;
        irreflexive.value = cellProperties.irreflexive.value;
    }
}


/**
 * Update the current cell with the inputs set in front end
 * @param {mxCell} cell 
 */
function updateCurrentCell(cell) {
    
}

// Class properties inputs
let subClassOf = document.getElementById('SubClassOf');
let equivalence = document.getElementById('Equivalence');
let instancesInput = document.getElementById('Instances');
let targetForKey = document.getElementById('TargetForKey');
let disjointWith = document.getElementById('DisjointWith');
let constraint = document.getElementById('Constraint');

// Object properties inputs 
let domain = document.getElementById("domain");
let range = document.getElementById("range");
let equivalentTo = document.getElementById("equivalentTo");
let subpropertyOf = document.getElementById("subpropertyOf");
let inverseOf = document.getElementById("inverseOf");
let disjointWithRelations = document.getElementById("disjointWith-relations");
let functional = document.getElementById("functional");
let inverseFunctional = document.getElementById("inverseFunctional");
let transitive = document.getElementById("transitive");
let symetric = document.getElementById("symetric");
let asymmetric = document.getElementById("asymmetric");
let reflexive = document.getElementById("reflexive");
let irreflexive = document.getElementById("irreflexive");

// Annotations properties inputs 
let label = document.getElementById('label');
let comment = document.getElementById('comment');
let isDefinedBy = document.getElementById('isDefinedBy');
let seeAlso = document.getElementById('seeAlso');
let backwardCompatibleWith = document.getElementById('backwardCompatibleWith');
let deprecated = document.getElementById('deprecated');
let imcompatibleWith = document.getElementById('imcompatibleWith');
let priorVersion = document.getElementById('priorVersion');
let versionInfo = document.getElementById('versionInfo');

//Datatype properties
let labelDatatypeProperties = document.getElementById('label-datatype-properties');
let domainDatatypeProperties = document.getElementById('domain-datatype-properties');
let rangeDatatypeProperties = document.getElementById('range-datatype-properties');
let equivalentToDatatypeProperties = document.getElementById('equivalentTo-datatype-properties');
let subPropertyOfDatatypeProperties = document.getElementById('subPropertyOf-datatype-properties');
let disjointWithDatatypeProperties = document.getElementById('disjointWith-datatype-properties');
let funcionalDatatypeProperties = document.getElementById('functional-datatype-properties');

// Intances properties
let labelInstance = document.getElementById("label-individuals");
let types = document.getElementById("types");
let sameAs = document.getElementById("sameAs");
let differentAs = document.getElementById("differentAs");
let objectProperties = document.getElementById("objectProperties");
let dataProperties = document.getElementById("dataProperties");
let negativeObjectProperties = document.getElementById("negativeObjectProperties");
let negativeDataProperties = document.getElementById("negativeDataProperties");
