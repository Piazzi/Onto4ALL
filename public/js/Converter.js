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
 * @param rx (the radius along X-axis)
 * @param ry (the radius along Y-axis.)
 */
function generatePositions(n, rx, ry)
{
    let frags = 360 / n;
    let theta = [];
    for (let i = 0; i <= n; i++) {
        theta.push((frags / 180) * i * Math.PI);
    }

    for(let j = 0; j < n; j++)
    {
        positions.push({
            x: 500 + Math.round(rx * (Math.cos(theta[j]))),
            y: Math.round(ry * (Math.sin(theta[j])))
        });
      // positions[j].x =  Math.round(rx * (Math.cos(theta[j])));
      // positions[j].y = Math.round(ry * (Math.sin(theta[j])));

    }

}


/**
 * Converts a OWL file to a XML File
 * @param owlDoc
 */
function owlToXml(owlDoc)
{
    // set the default attributes for the mxGraphModel node.
    // mxGraphModel is the underlying object that stores the data structure of our graph.
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

    generatePositions(owlDoc.getElementsByTagName("Declaration").length, 500,500);

    // Starts the conversion of the OWL file by reading all declaration nodes
    // Each of this nodes will become a class, relation or instance node on the XML file
    for(let i = 0; i < owlDoc.getElementsByTagName("Declaration").length; i++)
    {
        if(owlDoc.getElementsByTagName("Declaration")[i].childNodes[1].nodeName === 'Class')
           createClassNode(owlDoc.getElementsByTagName("Declaration")[i].childNodes[1]);
    }


    console.log(xmlDoc.documentElement);
    return xmlDoc.documentElement;
}

/**
 * Creates a Class Node for the XML file
 * @param node
 */
function createClassNode (node)
{
    let classNode = xmlDoc.createElement("mxCell");

    classNode.setAttribute("id", idCounter);
    idCounter++;

    // Sets each attribute following the default pattern of the editor
    classNode.setAttribute("value", cleanString(node.getAttribute("IRI")));
    classNode.setAttribute("style", "ellipse;whiteSpace=wrap;html=1;aspect=fixed;");
    classNode.setAttribute("vertex", "1");
    classNode.setAttribute("parent", "1");
    classNode.appendChild(createMxGeometryNode("class"));

    // append the class node to the root node
    xmlDoc.getElementsByTagName("root")[0].appendChild(classNode);
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
    if(parentNode === "class")
    {
        mxGeometry.setAttribute("x", positions[positionCounter].x);
        mxGeometry.setAttribute("y", positions[positionCounter].y);
        positionCounter++;
        mxGeometry.setAttribute("height", "80");
    }
    else
    {

    }
    return mxGeometry;
}