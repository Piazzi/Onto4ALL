// create the xml document
let xmlDoc = document.implementation.createDocument(null, "mxGraphModel", null);

// Defines the id counter that will be used every time a element is added
// to the xml document. The counter starts at 2 because of the two elements
// that were inserted before the conversion starts
let idCounter = 2;

// Defines the array that will hold the positions of the elements
let positions = [];
let positionCounter = 0;

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
 * Converts a OWL file to a mxgraph XML File
 * @param owlDoc
 */
function owlToXml(owlDoc)
{
    clearXmlDocument();
    setMxGraphModelAttributes();
    createRootAndMxCellNodes();
    generatePositions(owlDoc.getElementsByTagName("Declaration").length);

    // Starts the conversion of the OWL file by reading all declaration nodes
    // Each of this nodes will become a class, relation or instance node on the XML file
    for(let i = 0; i < owlDoc.getElementsByTagName("Declaration").length; i++)
    {
        // Reads all the Declaration nodes and create the new nodes after that
        if(owlDoc.getElementsByTagName("Declaration")[i].childNodes[1].nodeName === 'Class')
           createClassNode(owlDoc.getElementsByTagName("Declaration")[i].childNodes[1].getAttribute("IRI"));
        else if(owlDoc.getElementsByTagName("Declaration")[i].childNodes[1].nodeName === 'ObjectProperty')
           createRelationNode(owlDoc.getElementsByTagName("Declaration")[i].childNodes[1].getAttribute("IRI"));
    }

    // Reads all SubClassOf nodes to create is_a relation nodes
    // and Sets the attributes of previous created relations
    for(let i = 0; i < owlDoc.getElementsByTagName("SubClassOf").length; i++)
    {
        if(owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[1].nodeName === 'Class' &&
           owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[3].nodeName === 'Class')
        {

            // Create a is_a relation and set the source and target attributes
            let isA = createRelationNode("is_a");
            let source = getNode(owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[1].getAttribute("IRI"));
            let target = getNode(owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[3].getAttribute("IRI"));
            isA.setAttribute("source", source.getAttribute("id"));
            isA.setAttribute("target", target.getAttribute("id"));

        }
        else if(owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[1].nodeName === 'Class' && (
                owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[3].nodeName === 'ObjectSomeValuesFrom' ||
                owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[3].nodeName === 'ObjectAllValuesFrom'))
        {
            // finds the relation and set the source and target attributes
            let relation = getNode(owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[3].childNodes[1].getAttribute("IRI"));
            let source = getNode(owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[1].getAttribute("IRI"));
            let target = getNode(owlDoc.getElementsByTagName("SubClassOf")[i].childNodes[3].childNodes[3].getAttribute("IRI"));
            relation.setAttribute("source", source.getAttribute("id"));
            relation.setAttribute("target", target.getAttribute("id"));

        }
    }


    // Reads all AnnotationAssertion nodes to fill properties on classes and relations
    for(let i = 0; i < owlDoc.getElementsByTagName("AnnotationAssertion").length;i++)
    {
        if(owlDoc.getElementsByTagName("AnnotationAssertion")[i].childNodes[1].getAttribute("IRI"))
        {
            let propertyLabel = owlDoc.getElementsByTagName("AnnotationAssertion")[i].childNodes[1].getAttribute("IRI").split("#").pop();
            let nodeName = owlDoc.getElementsByTagName("AnnotationAssertion")[i].childNodes[3].childNodes[0].nodeValue;
            let propertyValue = owlDoc.getElementsByTagName("AnnotationAssertion")[i].childNodes[5].childNodes[0].nodeValue;
            //console.log("LABEL", propertyLabel, "NODE NAME", cleanString(nodeName), "VALUE", propertyValue);
            insertPropertyOnNode(cleanString(nodeName), propertyLabel, propertyValue);

        }

    }

    console.log(xmlDoc.documentElement);
    return xmlDoc.documentElement;
}

/**
 * Converts a RDF/XML file to mxgraph XML
 * @param owlDoc
 */
function rdfToXml(owlDoc)
{
    clearXmlDocument();
    setMxGraphModelAttributes();
    createRootAndMxCellNodes();
    let numberOfElements = 0;

    // Gets the total number of elements
    for(let i = 0; i < owlDoc.getElementsByTagName("owl:Class").length; i++)
        if(owlDoc.getElementsByTagName("owl:Class")[i].parentNode.nodeName === 'rdf:RDF')
            numberOfElements++;

    for(let i = 0; i < owlDoc.getElementsByTagName("owl:ObjectProperty").length; i++)
        if(owlDoc.getElementsByTagName("owl:ObjectProperty")[i].parentNode.nodeName === 'rdf:RDF')
            numberOfElements++;

    generatePositions(numberOfElements);
    console.log(numberOfElements);

    // Creates the Class and relations nodes
    try
    {
        for(let i = 0; i < owlDoc.getElementsByTagName("owl:Class").length; i++)
        {
            if(owlDoc.getElementsByTagName("owl:Class")[i].parentNode.nodeName === 'rdf:RDF' && owlDoc.getElementsByTagName("owl:Class")[i].childNodes.length !== 0)
            {
                console.log(owlDoc.getElementsByTagName("owl:Class")[i].childNodes[1].textContent);
                createClassNode(owlDoc.getElementsByTagName("owl:Class")[i].childNodes[1].textContent);
            }
        }

        for(let i = 0; i < owlDoc.getElementsByTagName("owl:ObjectProperty").length;i++)
        {
            if(owlDoc.getElementsByTagName("owl:ObjectProperty")[i].parentNode.nodeName === 'rdf:RDF' && owlDoc.getElementsByTagName("owl:ObjectProperty")[i].childNodes.length !== 0)
            {
                console.log(owlDoc.getElementsByTagName("owl:ObjectProperty")[i].childNodes[1].textContent);
                createRelationNode(owlDoc.getElementsByTagName("owl:ObjectProperty")[i].childNodes[1].textContent);
            }
        }
    } catch (e) {
        console.log(e);
    }

    console.log(xmlDoc.documentElement);
    return xmlDoc.documentElement;
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
    classNode.setAttribute("value", cleanString(name));
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
 * @param name (optional parameter)
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
        relationNode.setAttribute("value", cleanString(name));

    relationNode.setAttribute("style", "html=1;verticalAlign=bottom;endArrow=block;Relation;");
    relationNode.setAttribute("edge", "1");
    relationNode.setAttribute("parent", "1");
    relationNode.appendChild(createMxGeometryNode("relation"));

    // append the relation node to the root node
    xmlDoc.getElementsByTagName("root")[0].appendChild(relationNode);

    return relationNode;
}

/**
 * Removes the # of the IRI attribute in nodes
 * from OWL file
 * @param string
 * @returns {*}
 */
function cleanString(string)
{
    return string.replace('#','');
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
    for(let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
        if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("value") === cleanString(name))
            return xmlDoc.getElementsByTagName("mxCell")[i];
}

/**
 * Inserts a property on a given node.
 * @param nodeName
 * @param label
 * @param value
 */
function insertPropertyOnNode(nodeName, label, value)
{
    let node = getNode(nodeName);
    //When the properties are not filled yet this function creates a new node
    // called 'object' and sets the given node as a child
    if(node.parentNode.nodeName !== 'object')
    {
        let object = xmlDoc.createElement("object");
        // Sets the attributes for the new node following the mxGraph pattern.
        // The object receives the value and id properties from the node. This attributes
        // are removed from the original node after that.
        object.setAttribute("label", node.getAttribute("value"));
        object.setAttribute("id", node.getAttribute("id"));
        object.setAttribute(label, value);
        node.removeAttribute("value");
        node.removeAttribute("id");

        // sets the remaining properties
        object.setAttribute(label, value);

        object.appendChild(node);
        xmlDoc.getElementsByTagName("root")[0].appendChild(object);
    }
    else
    {
        // finds the object node and set the attributes
        for(let i = 0; xmlDoc.getElementsByTagName("object").length;i++)
            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") === nodeName)
                xmlDoc.getElementsByTagName("object")[i].setAttribute(label,value);
    }

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
function getCurrentOntologyInJSON() {
    let ontologyId = document.getElementById("id").value;
    if(ontologyId == '') {
        document.getElementById("save-ontology").click()
        ontologyId = document.getElementById("id").value;
    }

    let ontology = {
        "id": "https://onto4all.com/en/ontologies/"+ ontologyId,
        "filetype": "OWL",
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
    return JSON.stringify(cleanObject(ontology));
}

function downloadFile(owlString) {

    const link = window.document.createElement('a');
    link.href = window.URL.createObjectURL(new Blob([owlString], {type: 'text/plain;charset=utf-8;'}));
    link.download = 'ontology.owl';

    document.body.appendChild(link);
    link.click();

    document.body.removeChild(link);
}

function xmlToOwl() {

    (async () => {
        const rawResponse = await fetch(
            "https://onto4all.repesq.ufjf.br/owlapi/webapi/ontology/format",
            {
                method: "POST",
                headers: {
                    Accept: "text/plain, */*",
                    "Content-Type": "text/plain",
                },
                body: getCurrentOntologyInJSON(),
            }
        );
        console.log(rawResponse);
        const content = await rawResponse.text();
        console.log(content);
        downloadFile(content);

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
