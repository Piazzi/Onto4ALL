//editor.graph.getSelectionCell()
var currentCell;
/**
 * Function called when a mxCell is selected in the editor
 * @param {mxCell} cell 
 */
function getSelectedCell(cell) {
    console.log(currentCell);
    currentCell = cell;
    if(currentCell == null){
        updateTabs();
        return;
    }
        
    let style = currentCell.style;

    if(style.includes('Class')){
        updateTabs('Class');
    } else if(style.includes('Relation')){
        updateTabs('Relation');
    } else if(style.includes('Instance')){
        updateTabs('Instance');
    } else if(style.includes('DatatypeProperty')){
        updateTabs('DatatypeProperty');
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
 * Update the current cell with the inputs set in front end
 * @param {mxCell} cell 
 */
function updateCurrentCell(cell) {
    
}