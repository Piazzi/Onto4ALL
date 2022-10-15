// create the xml document
let xmlDoc = document.implementation.createDocument(null, "mxGraphModel", null);

// Defines the id counter that will be used every time a element is added
// to the xml document. The counter starts at 2 because of the two elements
// that were inserted before the conversion starts
let idCounter = 2;

// Defines the array that will hold the positions of the elements
let positions = [];
let positionCounter = 0;

propertyTransition = {
    'label': 'label',
    'SubClassOf': 'SubClassOf',
    'EquivalentClasses': 'Equivalence',
    'EquivalentObjectProperties': 'Equivalence',
    'Instances': 'Instances', //
    'TargetForKey': 'TargetForKey', //
    'DisjointClasses': 'DisjointWith',
    'Constraint ': 'Constraint', //
    'ObjectPropertyDomain': 'domain',
    'ObjectPropertyRange': 'range',
    'SubObjectPropertyOf': 'subpropertyOf',
    'InverseObjectProperties': 'inverseOf',
    'InverseFunctionalObjectProperty': 'inverseOf',
    'types': 'types', //
    'SameIndividual': 'sameAs',
    'DifferentIndividuals': 'differentAs',
    'DisjointObjectProperties': 'objectProperties',
    'DataPropertyAssertion': 'dataProperties',
    'InverseFunctionalObjectProperty': 'negativeObjectProperties',
    'InverseDataPropertyAssertion': 'negativeDataProperties',
    'comment': 'comment',
    'isDefinedBy': 'isDefinedBy',
    'seeAlso': 'seeAlso', //
    'backwardCompatibleWith': 'backwardCompatibleWith', //
    'deprecated': 'deprecated', //
    'incompatibleWith': 'incompatibleWith', //
    'priorVersion': 'priorVersion', //
    'versionInfo': 'versionInfo', //
}

/**
 * Generate the position of each element that will be inserted
 * into the editor. The elements will be inserted in a circle format
 * @param n (number of elements)
 */
function generatePositions(n)
{
    // resets the counter and the array
    positionCounter = 0;
    positions = [];
    //rx (the radius along X-axis)
    //ry (the radius along Y-axis.)
    let rx, ry;

    // sets the radius of the circle based on the number of elements
    if(n <= 4)
    {
        rx = 150;
        ry = rx;
    }
    else
    {
        rx = 150+n*10;
        ry = rx;
    }

    let frags = 360 / n;
    let theta = [];
    for (let i = 0; i <= n; i++)
        theta.push((frags / 180) * i * Math.PI);


    for(let j = 0; j < n; j++)
    {
        positions.push({
            x: Math.round(rx * (Math.cos(theta[j]))),
            y: Math.round(ry * (Math.sin(theta[j])))
        });
    }

}

/**
 * set the default attributes for the mxGraphModel node.
 * mxGraphModel is the underlying object that stores the data structure of our graph.
 */
function setMxGraphModelAttributes() {

    let mxGraphModel = xmlDoc.getElementsByTagName("mxGraphModel")[0];
    mxGraphModel.setAttribute("dx", '1409');
    mxGraphModel.setAttribute("dy", '820');
    mxGraphModel.setAttribute("grid", '1');
    mxGraphModel.setAttribute("gridSize", '10');
    mxGraphModel.setAttribute("guides", '1');
    mxGraphModel.setAttribute("tooltips", '1');
    mxGraphModel.setAttribute("connect", '1');
    mxGraphModel.setAttribute("arrows", '1');
    mxGraphModel.setAttribute("fold", '1');
    mxGraphModel.setAttribute("page", '1');
    mxGraphModel.setAttribute("pageScale", '1');
    mxGraphModel.setAttribute("pageWidth", '827');
    mxGraphModel.setAttribute("pageHeight", '1169');
    mxGraphModel.setAttribute("background", '#ffffff');
}

/**
 * create the root node that will hold all elements (classes, relations, ect...) of the graph
 * and set the first two nodes of the graph. This two nodes are the default in every graph
 */
function createRootAndMxCellNodes()
{
    if(xmlDoc.getElementsByTagName("mxGraphModel")[0].childNodes.length !== 0)
        return;

    // create the root node that will hold all elements (classes, relations, ect...) of the graph
    let root = xmlDoc.createElement("root");
    xmlDoc.getElementsByTagName("mxGraphModel")[0].appendChild(root);

    // set the first two nodes of the graph. This two nodes are the default in every graph
    let mxCell1 = xmlDoc.createElement("mxCell");
    mxCell1.setAttribute("id", "0");
    root.appendChild(mxCell1);
    let mxCell2 = xmlDoc.createElement("mxCell");
    mxCell2.setAttribute("id", "1");
    mxCell2.setAttribute("parent", "0");
    root.appendChild(mxCell2);
}

/**
 * Creates a Class Node for the XML file
 * @param name
 */
function createClassNode(name)
{
    let classNode = xmlDoc.createElement("mxCell");

    classNode.setAttribute("id", idCounter);
    idCounter++;

    // Sets each attribute following the default pattern of the editor
    classNode.setAttribute("value", name);
    classNode.setAttribute("style", "ellipse;whiteSpace=wrap;html=1;aspect=fixed;Class;");
    classNode.setAttribute("vertex", "1");
    classNode.setAttribute("parent", "1");
    classNode.appendChild(createMxGeometryNode("class"));

    // append the class node to the root node
    xmlDoc.getElementsByTagName("root")[0].appendChild(classNode);
}

/**
 * Creates a Relation Node for the XML file
 * @param name
 */
function createRelationNode(name)
{
    let relationNode = xmlDoc.createElement("mxCell");

    relationNode.setAttribute("id", idCounter);
    idCounter++;

    // Sets the attributes for a relation node
    if(name === "is_a")
        relationNode.setAttribute("value", "is_a");
    else
        relationNode.setAttribute("value", name);

    relationNode.setAttribute("style", "html=1;verticalAlign=bottom;endArrow=block;Relation;");
    relationNode.setAttribute("edge", "1");
    relationNode.setAttribute("parent", "1");
    relationNode.appendChild(createMxGeometryNode("relation"));

    // append the relation node to the root node
    xmlDoc.getElementsByTagName("root")[0].appendChild(relationNode);

    return relationNode;
}

/**
 * Creates a Relation Node for the XML file
 * @param name
 * @param source
 * @param target
 */
 function createRelationNodeClass(name, source, target)
 {
     let relationNode = xmlDoc.createElement("mxCell");

     source = getNode(source);
     target = getNode(target);

     if (source) {
        relationNode.setAttribute("source", source.getAttribute("id"));
     }
     if (target) {
        relationNode.setAttribute("target", target.getAttribute("id"));
     }
 
     // Sets the attributes for a relation node
     relationNode.setAttribute("style", "html=1;verticalAlign=bottom;endArrow=block;Relation;");
     relationNode.setAttribute("edge", "1");
     relationNode.setAttribute("parent", "1");
     relationNode.appendChild(createMxGeometryNode("relation"));
 
     //When the properties are not filled yet this function creates a new node
     // called 'object' and sets the given node as a child
     let object = xmlDoc.createElement("object");
     // Sets the attributes for the new node following the mxGraph pattern.
     // The object receives the value and id properties from the node. This attributes
     // are removed from the original node after that.
     object.setAttribute("label", name);
     object.setAttribute("id", idCounter);
     idCounter++;

     object.appendChild(relationNode);
     xmlDoc.getElementsByTagName("root")[0].appendChild(object);
 
     return object;
 }

/**
 * Create a MxGeometry Node for the XML file
 * @param parentNode
 * @returns {HTMLElement}
 */
function createMxGeometryNode(parentNode)
{
    let mxGeometry = xmlDoc.createElement("mxGeometry");
    mxGeometry.setAttribute("width", "80");
    mxGeometry.setAttribute("as", "geometry");

    // checks if this node belongs to a relation or class node
    if(parentNode === "class")
    {
        mxGeometry.setAttribute("x", positions[positionCounter].x);
        mxGeometry.setAttribute("y", positions[positionCounter].y);
        positionCounter++;
        mxGeometry.setAttribute("height", "80");
    }
    else if(parentNode === "relation")
    {
        mxGeometry.setAttribute("relative", "1");
        let mxPoints = createMxPointNode();
        mxGeometry.appendChild(mxPoints[0]);
        mxGeometry.appendChild(mxPoints[1]);
    }
    return mxGeometry;
}

/**
 * Creates a MxPoint node
 * @returns {HTMLElement[]}
 */
function createMxPointNode()
{
    let sourcePoint = xmlDoc.createElement("mxPoint");
    let targetPoint = xmlDoc.createElement("mxPoint");

    sourcePoint.setAttribute("x", "20");
    sourcePoint.setAttribute("y", "20");
    sourcePoint.setAttribute("as", "sourcePoint");

    targetPoint.setAttribute("x", "100");
    targetPoint.setAttribute("y", "20");
    targetPoint.setAttribute("as", "targetPoint");

    return [sourcePoint, targetPoint];
}

/**
 * Finds the node with the given name
 * @param name
 * @returns {Element}
 */
function getNode(name)
{
    // Find mxCell
    for(let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {
        if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") === name)
            return xmlDoc.getElementsByTagName("mxCell")[i];
    }
    // Find object
    for(let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++) {
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("name") === name)
            return xmlDoc.getElementsByTagName("object")[i];
    }
}

/**
 * Inserts a properties on a given node.
 * @param nodeName
 * @param properties
 */
 function insertPropertiesOnNode(nodeName, properties)
 {
     let node = getNode(nodeName);
     if (!node) {
        return;
     }
     //When the properties are not filled yet this function creates a new node
     // called 'object' and sets the given node as a child
     let object = xmlDoc.createElement("object");
     // Sets the attributes for the new node following the mxGraph pattern.
     // The object receives the value and id properties from the node. This attributes
     // are removed from the original node after that.
     object.setAttribute("id", node.getAttribute("id"));

     node.removeAttribute("value");
     node.removeAttribute("id");

     // set propertie default
     object.setAttribute('DisjointWith', '');
     object.setAttribute('name', nodeName);
     object.setAttribute('label', nodeName);
     // sets the remaining properties
     $.each(properties,function(propertyLabel, propertyValue){

        if (propertyValue instanceof Array) {
            propertyValue = propertyValue.filter(function(e) { return e !== nodeName })
            let propertyValues = [];
            if (propertyValue.length > 0) {
                
                // normalize to properties for id
                $.each(propertyValue,function(i, value){
                    let nodeProp = getNode(value, true);
                    if (nodeProp) {
                        propertyValues.push(nodeProp.getAttribute("id"));
                    }
                });
                propertyValues = propertyValues.join(',');

                if (propertyTransition[propertyLabel]) {
                    object.setAttribute(propertyTransition[propertyLabel], propertyValues);
                }
            }
        } else {
            if (propertyTransition[propertyLabel]) {
                object.setAttribute(propertyTransition[propertyLabel], propertyValue);
            }
        }
     });

     object.appendChild(node);
     xmlDoc.getElementsByTagName("root")[0].appendChild(object);
 
 }

/**
 * Clears the xml Doc root node for a new importation
 */
function clearXmlDocument() {
    if(xmlDoc.firstChild.firstChild !== null)
        xmlDoc.documentElement.removeChild(xmlDoc.getElementsByTagName("root")[0]);
}

/**
 * Return the current ontology in JSON Format
 */
function getCurrentOntologyInJSON(format) {
    let ontologyId = document.getElementById("id").value;
    if(ontologyId == '') {
        document.getElementById("save-ontology").click()
        ontologyId = document.getElementById("id").value;
    }

    let ontology = {
        "id": "https://onto4all.com/en/ontologies/"+ ontologyId,
        "filetype": format,
        "classes": [],
        "object properties": [],
        "data properties": [],
        "individuals": [],
        "constraints": [],
    };


    classes.forEach((e) => {

        let constraint = e.value.getAttribute('Constraint');
        if(!!constraint.trim()) {
            ontology.constraints.push( constraint.replace(';',''));
        }

        ontology.classes.push({
            "Name": e.value.getAttribute('label'),
            "SubClassOf": e.value.getAttribute('SubClassOf').split(),
            "EquivalentTo": e.value.getAttribute('EquivalentTo')?.split(),
            "Instances": e.value.getAttribute('Instances')?.split(),
            "TargetForKey": e.value.getAttribute('TargetForKey')?.split(),
            "DisjointWith": e.value.getAttribute('DisjointWith')?.split(),
            "Constraint ": e.value.getAttribute('Constraint')?.split(),
            "Annotation": {
                "comment": e.value.getAttribute('comment')?.split(),
                "isDefinedBy": e.value.getAttribute('isDefinedBy')?.split(),
                "seeAlso": e.value.getAttribute('seeAlso')?.split(),
                "backwardCompatibleWith": e.value.getAttribute('backwardCompatibleWith')?.split(),
                "deprecated": e.value.getAttribute('deprecated')?.split(),
                "incompatibleWith": e.value.getAttribute('incompatibleWith')?.split(),
                "priorVersion": e.value.getAttribute('priorVersion')?.split(),
                "versionInfo": e.value.getAttribute('versionInfo')?.split(),
            }
            },
        )
    });

    relations.forEach((e) => {
        ontology["object properties"].push({
                "Name": e.value.getAttribute('label'),
                "domain": e.value.getAttribute('domain')?.split(),
                "range": e.value.getAttribute('range')?.split(),
                "equivalentTo": e.value.getAttribute('equivalentTo')?.split(),
                "subpropertyOf": e.value.getAttribute('subpropertyOf')?.split(),
                "inverseOf": e.value.getAttribute('inverseOf')?.split(),
                "disjointWith ": e.value.getAttribute('disjointWith')?.split(),
                "Annotation": {
                    "comment": e.value.getAttribute('comment')?.split(),
                    "isDefinedBy": e.value.getAttribute('isDefinedBy')?.split(),
                    "seeAlso": e.value.getAttribute('seeAlso')?.split(),
                    "backwardCompatibleWith": e.value.getAttribute('backwardCompatibleWith')?.split(),
                    "deprecated": e.value.getAttribute('deprecated')?.split(),
                    "incompatibleWith": e.value.getAttribute('incompatibleWith')?.split(),
                    "priorVersion": e.value.getAttribute('priorVersion')?.split(),
                    "versionInfo": e.value.getAttribute('versionInfo')?.split(),
                }
            },
        );

    });

    instances.forEach((e) => {
        ontology.individuals.push({
                "Name": e.value.getAttribute('label'),
                "types": e.value.getAttribute('types')?.split(),
                "sameAs": e.value.getAttribute('sameAs')?.split(),
                "differentAs": e.value.getAttribute('differentAs')?.split(),
                "objectProperties": e.value.getAttribute('objectProperties')?.split(),
                "dataProperties": e.value.getAttribute('dataProperties')?.split(),
                "negativeObjectProperties": e.value.getAttribute('negativeObjectProperties')?.split(),
                "negativeDataProperties": e.value.getAttribute('negativeDataProperties')?.split(),
                "Annotation": {
                    "comment": e.value.getAttribute('comment')?.split(),
                    "isDefinedBy": e.value.getAttribute('isDefinedBy')?.split(),
                    "seeAlso": e.value.getAttribute('seeAlso')?.split(),
                    "backwardCompatibleWith": e.value.getAttribute('backwardCompatibleWith')?.split(),
                    "deprecated": e.value.getAttribute('deprecated')?.split(),
                    "incompatibleWith": e.value.getAttribute('incompatibleWith')?.split(),
                    "priorVersion": e.value.getAttribute('priorVersion')?.split(),
                    "versionInfo": e.value.getAttribute('versionInfo')?.split(),
                }

            },
        );
    });
    if(ontology.constraints.length == 0)
        delete ontology.constraints
    console.log(ontology);
    return JSON.stringify(cleanObject(ontology));
}

function downloadFile(content, format) {

    const link = window.document.createElement('a');
    link.href = window.URL.createObjectURL(new Blob([content], {type: 'text/plain;charset=utf-8;'}));
    link.download = 'ontology.'+format.toLowerCase();

    document.body.appendChild(link);
    link.click();

    document.body.removeChild(link);
}

function convertTo(data, format) {
    console.log(data);
    if(format == 'XML' || format == 'SVG') {
        downloadFile(data, format);
        return;
    }

    (async () => {
        const rawResponse = await fetch(
            "https://onto4all.repesq.ufjf.br/owlapi/webapi/ontology/format",
            {
                method: "POST",
                headers: {
                    Accept: "text/plain, */*",
                    "Content-Type": "text/plain",
                },
                body: getCurrentOntologyInJSON(format),
            }
        );
        console.log(rawResponse);
        const content = await rawResponse.text();
        console.log(content);
        downloadFile(content, format);

    })();
}

/**
 * Remove empty and null values from the entire object
 * @param {*} object
 * @returns
 */
function cleanObject(object) {
    Object
        .entries(object)
        .forEach(([k, v]) => {
            if (v && typeof v === 'object')
                cleanObject(v);
            if (v &&
                typeof v === 'object' &&
                !Object.keys(v).length ||
                v === null ||
                v === undefined ||
                v === "" ||
                v.length === 0
            ) {
                if (Array.isArray(object))
                    object.splice(k, 1);
                else if (!(v instanceof Date))
                    delete object[k];
            }
        });
    return object;
}

/**
 * Converts a JSON to a mxgraph XML File
 * @param json
 */
 function jsonToXml(json)
 {
    clearXmlDocument();
    setMxGraphModelAttributes();
    createRootAndMxCellNodes();
    generatePositions(json['classes'].length + json['individuals'].length);

    // Starts the conversion of the OWL file by reading all declaration nodes
    // Each of this nodes will become a class, relation or instance node on the XML file
    let classes = json['classes'].concat(json['individuals']);
    $.each(classes,function(i, classe){
        createClassNode(classe['Name']);
    });

    // Reads all SubClassOf nodes to create is_a relation nodes
    // and Sets the attributes of previous created relations
    $.each(json['classes'],function(i, classe){
        if (classe['SubClassOf']) {
            let repetition = 0;
            for(let i = 0; i < classe['SubClassOf'].length; i++)
            {
                // Checks if it's a self loop, it only happens if the subclass appears twice
                if (classe['SubClassOf'][i] == classe['Name']) {
                    repetition++;
                    if (repetition == 1) {
                        continue;
                    }
                }
                createRelationNodeClass("is_a", classe['Name'], classe['SubClassOf'][i]);
            }
        }
    });

    // Reads all Object Properties to create relation nodes
    // and Sets the attributes of previous created relations
    $.each(json['object properties'],function(i, instance){
        if (instance['Name'] != 'is_a') {
            if (instance['ObjectPropertyDomain'] && instance['ObjectPropertyRange']) {
                $.each(instance['ObjectPropertyDomain'],function(i, domain){
                    $.each(instance['ObjectPropertyRange'],function(i, range){
                        if (domain != instance['Name'] && range != instance['Name']) {
                            createRelationNodeClass(instance['Name'], domain, range);
                        }
                    });
                });
            } else {
                createRelationNode(instance['Name']);
            }
        }
    });

    // Reads all AnnotationAssertion nodes to fill properties on classes and relations
    let properties = json['classes'].concat(json['individuals'], json['object properties']);
    $.each(properties,function(i, propertie){
        if (propertie['Name'] != 'is_a') {
            insertPropertiesOnNode(propertie['Name'], propertie);
        }
    });

    console.log(xmlDoc.documentElement)
    return xmlDoc.documentElement;

 }