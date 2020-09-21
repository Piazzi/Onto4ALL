
/**
 * This file is responsible for the warning console in the editor page
 * The main function is the movementCompiler()
 * The other ones are helper functions to make the code cleaner (DRY)
 */

var classes = [], relations = [], instances = [];

/**
 * Gets the XML from the editor after any change is made.
 * And finds any measurable error.
 * @param xml
 */
function movementCompiler(xml)
{

    // Updates the save file button
    $("#save-ontology").removeClass("saved").addClass("unsaved");

    if(getLanguage() === 'pt')
        $("#save-ontology").html('<i class="fa fa-fw fa-save"></i> Alterações não salvas. Clique aqui para salvar');
    else
        $("#save-ontology").html('<i class="fa fa-fw fa-save"></i> Unsaved changes. Click here to save');

    // Removes the previous error messages
    $(".direct-chat-messages").empty();

    let xmlDoc, missingClassProperties = "", missingRelationProperties = "", classesCount = 0, relationsCount = 0, instancesCount = 0, warningsCount = 0, basicErrorsCount = 0, conceptualErrorsCount = 0;
    xmlDoc = new DOMParser().parseFromString(xml, "text/xml");

    //console.log(xmlDoc.getElementsByTagName("mxCell"));


    // Starts the XML interpretation send by the editor
    // Each mxCell element is compared to each other to find any measurable error
    // This compiler is made of three parts, the first one is to compare elements with the
    // MxCell tag in it. The second one to compare elements with MxCell and Object
    // and the third one to compare elements with the Object tag only
    // For this i used the getValueOrLabel function.
    // Complexity: O(n^2)
    for (let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++) {

        try {
            // Checks if the mxCell element is valid, if is not, goes to the next iteration
            if(!mxCellIsValid(xmlDoc.getElementsByTagName("mxCell")[i]))
                continue;

            if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") != null)
            {
                relationsCount++;
                relations.push(xmlDoc.getElementsByTagName("mxCell")[i]);
            }
            else if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('ellipse'))
            {
                classesCount++;
                classes.push(xmlDoc.getElementsByTagName("mxCell")[i]);
            }
            else if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('Instance'))
            {
                instancesCount++;
                instances.push(xmlDoc.getElementsByTagName("mxCell")[i]);
            }
            else
                continue;

        } catch (e) {
            console.log(e);
            continue;
        }

        //console.log(xmlDoc.getElementsByTagName("mxCell")[i]);

        // Checks if the mxCell element is a relation by looking at the "edge" attribute
        if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") !== null && (
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") === null ||
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") === null))
        {
            basicErrorsCount++;
            if(getLanguage() === 'pt')
                warningMessage('A relação '+ getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) + ' (ID: '+ getElementId(xmlDoc.getElementsByTagName("mxCell")[i])+') não está conectada a duas classes', 9, 'Erro Basico');
            else
                warningMessage('The relation '+ getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) +' (ID: '+getElementId(xmlDoc.getElementsByTagName("mxCell")[i])+')  it is not fully connected to 2 classes', 9, 'Basic Error');
        }

        // If the mxCell is a Instance, start searching for his relations. If any relation belonging to the instance it's not a instance_of
        // relation, shows a error message
        if (isInstance(xmlDoc.getElementsByTagName("mxCell")[i]))
        {
            for (let k = 0; k < xmlDoc.getElementsByTagName("mxCell").length; k++)
            {
                if (xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("edge") != null &&
                    getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[k]) !== 'instance_of' && getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[k]) !== 'instancia_um')
                {
                    if (xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("source") === getElementId(xmlDoc.getElementsByTagName("mxCell")[i]) ||
                        xmlDoc.getElementsByTagName("mxCell")[k].getAttribute("target") === getElementId(xmlDoc.getElementsByTagName("mxCell")[i]))
                    {
                        conceptualErrorsCount++;
                        if(getLanguage() === 'pt')
                            warningMessage("Você só poder ter uma relação instancia_um entre uma classe e uma instância","", ' Erro Conceitual');
                        else
                            warningMessage("You can only have a instance_of relation between a class and a instance","",' Conceptual Error');
                    }
                }
            }

        }

        // Shows a error message if two classes has been connected with the instance_of relation
        if (getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) === 'instance_of' || getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) === 'instancia_um' &&
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") !== null &&
            xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !== null)
        {
            // get the ids from the mxCells in the relation
            let domainId = xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source");
            let rangeId = xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target");
            let domainClass, rangeClass;

            // Look for the two mxCells using the ids
            for (let k = 0; k < xmlDoc.getElementsByTagName("mxCell").length; k++)
            {
                if(!mxCellIsValid(xmlDoc.getElementsByTagName("mxCell")[k]))
                    continue;
                if (getElementId(xmlDoc.getElementsByTagName("mxCell")[k]) === domainId)
                    domainClass = xmlDoc.getElementsByTagName("mxCell")[k];
                if (getElementId(xmlDoc.getElementsByTagName("mxCell")[k]) === rangeId)
                    rangeClass = xmlDoc.getElementsByTagName("mxCell")[k];

            }

            // shows a error if the mxCells are two classes
            if (isClass(domainClass) && isClass(rangeClass))
            {
                conceptualErrorsCount++;
                if(getLanguage() === 'pt')
                    warningMessage("Você não pode ter uma relação instancia_um entre duas classes. A relação precisa estar entre uma classe e uma instância. ","", " Erro Conceitual");
                else
                    warningMessage("You cant have a instance_of relation between two classes. It must be between one class and one instance. ","", " Conceptual Error");
            }
        }


        let name = removeSpaces(getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]));
        // Check if the Name is in Plural or singular
        /*
        if(isClass(xmlDoc.getElementsByTagName("mxCell")[i]) && name.charAt(name.length-1) === 's' || name.charAt(name.length-1) === 'S')
        {
            warningsCount++;
            if(getLanguage() === 'pt')
                warningMessage("É recomendável que os nomes estejam no singular e não no plural.",'','Má Prática');
            else
                warningMessage("It is recommended that the names be in the singular and not in the plural",'','Bad Practice')
        }*/

        // Check if the name contains a Acronym
        // /([a-z]{1}\.)/gi
        // /^([a-z]\.)+/i
        // /^([a-z]\.)+$/i
        if(/^([a-z]\.)+/i.test(name))
        {
            warningsCount++;
            if(getLanguage() === 'pt')
                warningMessage("É recomendável que os nomes não tenham acrônimos.",'','Má Prática');
            else
                warningMessage("It is recommended that the names do not have acronyms",'','Bad Practice');
        }

        // Check if the name is all on uppercase
        if(/^[^a-z]*$/.test(removeSpaces(name)))
        {
            warningsCount++;
            if(getLanguage() === 'pt')
                warningMessage("É recomendável que os nomes sejam escritos em letras minúsculas.",'','Má Prática');
            else
                warningMessage("It is recommended that names are written in lowercase letters",'','Bad Practice');
        }

        for (let j = i + 1; j < xmlDoc.getElementsByTagName("mxCell").length; j++)
        {
            // Shows a error message if two classes has the same name
            if ((getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) ===
                 getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[j])) && (
                 getElementId(xmlDoc.getElementsByTagName("mxCell")[i]) !==
                 getElementId(xmlDoc.getElementsByTagName("mxCell")[j])) &&
                getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) != null &&
                getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[j]) != null)
                {
                    if (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") == null &&
                        xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("edge") == null &&
                        xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("style").includes('ellipse') &&
                        xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("style").includes('ellipse'))
                    {
                        conceptualErrorsCount++;
                        if(getLanguage() === 'pt')
                            warningMessage("Você não pode ter duas classes com o mesmo nome, você tem duas classes chamadas "+(getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i])).bold()+".",1, 'Erro Conceitual');
                        else
                            warningMessage("You can not have two classes with the same name, you have two classes named "+(getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i])).bold()+".",1, 'Conceptual Error');
                }
            }


            // Shows a error message if two classes has the same relation between them more than one time
            if (getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) ===
                getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[j]) &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) != null &&
                getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[j]) != null &&
                (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") != null))
            {
                basicErrorsCount++;
                if(getLanguage() === 'pt')
                    warningMessage("Você não pode ter duas relações iguais apontando para as mesmas classes. Esse erro ocorre nas seguintes classes: "+
                        getCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +
                        " e "+ getCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target")) +".", 'Erro Básico');
                else
                    warningMessage("You can't have 2 equal relations pointing to the same classes. This error occurs in the following classes: "+
                    getCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +
                    " and "+ getCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target")) +".", 'Basic Error');
            }


            /*
            // Shows a error message if a class has more than one relation attached to it
            if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("edge") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("edge") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") != null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") != null &&
                (xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source")))
            {
               warningMessage("You can only have 1 relation between 2 classes. This error occurs between these two classes: "+getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target")) +" and "+
                     getMxCellName(xmlDoc, xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source"))+" .", "", 8);
                excessOfRelationsWarning++;
            }*/

            //Shows a error if a class has multiple inheritance
            if(getLanguage() === 'en' && getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) === "is_a" &&
                getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[j])=== "is_a" &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !==
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") !== null )
            {
                warningMessage("A class can't have multiple inheritance. Your "+getCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) +"(ID: "+ xmlDoc.getElementsByTagName("mxCell")[i].getAttribute('id') +") class can't be the domain of more than one is_a relation",8, 'Bad Practice');
                warningsCount++;
            }
            else if (getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]) === "é_um" &&
                getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[j])=== "é_um" &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") ===
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !==
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("target") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") !== null &&
                xmlDoc.getElementsByTagName("mxCell")[j].getAttribute("source") !== null )
            {
                warningMessage("Classes não podem ter herança múltipla. Sua classe "+getCellName(xmlDoc,xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source")) + "(ID: "+ xmlDoc.getElementsByTagName("mxCell")[i].getAttribute('id') +") não pode ser o domínio de mais de uma relação is_a",8, 'Má Prática');
                warningsCount++;
            }

        }


    }

    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // Search for 'object' elements in the XML
    for (let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++){

        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null ){
            // Show the inverse of error if the relation and the inverse Of property have the same name
            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") === xmlDoc.getElementsByTagName("object")[i].getAttribute("inverseOf")) {
                conceptualErrorsCount++;
                if(getLanguage() === 'pt')
                    warningMessage("Na relação "+xmlDoc.getElementsByTagName("object")[i].getAttribute("label") +", a propriedade inverse_of não pode ter o mesmo nome que a relação","",'Erro Conceitual');
                else
                    warningMessage("In the "+xmlDoc.getElementsByTagName("object")[i].getAttribute("label") +" relation, the Inverse Of property can't have the same name of the relation","",'Conceptual Error');

            }

        }

        if(isClass(xmlDoc.getElementsByTagName("object")[i]))
        {
            // Search for missing properties in each class element
            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("definition") === "")
                missingClassProperties = missingClassProperties + ' definition,';


            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf") === "")
                missingClassProperties = missingClassProperties + ' SubClassOf,';


            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("exampleOfUsage") === "")
                missingClassProperties = missingClassProperties + ' exampleOfUsage';

            if(missingClassProperties !== "")
            {
                basicErrorsCount++;
                if(getLanguage() === 'pt')
                    warningMessage('Na classe '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+ ', você não preencheu as seguintes propriedades: ' + missingClassProperties.bold()+ '',"",'Erro Básico');
                else
                    warningMessage('In the '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold() +' Class, you did not fill the following properties: ' + missingClassProperties.bold()+ '',"",'Basic Error');
                missingClassProperties = "";
            }
        }

        // Search for missing properties in each relation element
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("domain") === "")
            missingRelationProperties = missingRelationProperties  + ' domain,';


        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("range") === "")
            missingRelationProperties = missingRelationProperties  + ' range,';

        /*
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("inverseOf") === "")
            missingRelationProperties = missingRelationProperties  + ' inverseOf';*/

        if(missingRelationProperties  !== "")
        {
           basicErrorsCount++;
            if(getLanguage() === 'pt')
                warningMessage('Na relação '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold()+ '(ID: '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("id").bold() +')' +', você não preencheu as seguintes propriedades: ' + missingRelationProperties.bold()+ '',"",'Erro Básico');
            else
                warningMessage('In the '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold() + '(ID: '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("id").bold() +')' +' Relation, you did not fill the following properties: ' + missingRelationProperties.bold()+ '',"",'Basic Error');
            missingRelationProperties  = "";
        }

        // Throws a error if the domain and range properties are equal
        if(isRelation(xmlDoc.getElementsByTagName("object")[i]) &&
            xmlDoc.getElementsByTagName("object")[i].getAttribute("domain") ===
            xmlDoc.getElementsByTagName("object")[i].getAttribute("range"))
        {
            basicErrorsCount++;
            if (getLanguage() === 'pt')
                warningMessage('As propriedades domain e range da relaçao '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold() + ' não podem ser iguais.', "",'Erro Básico');
            else
                warningMessage('The properties domain and range from the '+ xmlDoc.getElementsByTagName("object")[i].getAttribute("label").bold() + ' relation cannot be equal.', "",'Basic Error');
        }

    }

    // Update the counters on front end
    $("#warnings-count").text(warningsCount);
    $("#error-count").text(basicErrorsCount + conceptualErrorsCount);
    $("#classes-count").text(classesCount);
    $("#relations-count").text(relationsCount);
    $("#instances-count").text(instancesCount);


    // Checks if have any warnings, errors or bad practices and then updates the front end
    if (basicErrorsCount + conceptualErrorsCount === 0)
        $('#errors')[0].style.setProperty('background-color','#00a65a','important');
    else
        $('#errors')[0].style.setProperty('background-color','indianred','important');

    if(warningsCount === 0)
        $('#warnings')[0].style.setProperty('background-color','#00a65a','important');
    else
        $('#warnings')[0].style.setProperty('background-color','#f39c12','important');

    if(basicErrorsCount + conceptualErrorsCount > 0)
    {
        $('#warnings-console')[0].style.setProperty('border-color','indianred','important');
    }
    else if (warningsCount > 0)
    {
        $('#warnings-console')[0].style.setProperty('border-color','#f39c12','important');
    }
    else if (warningsCount + basicErrorsCount + conceptualErrorsCount === 0)
    {
        $('#warnings-console')[0].style.setProperty('border-color','#00a65a','important');
        if(getLanguage() === 'pt')
            $(".direct-chat-messages").append('<img id="no-warning-img" class="direct-chat-img" src="/css/images/LogoMini.png" alt="Message User Image"><div id="no-warning-text" class="direct-chat-text">Voce não tem nenhum aviso.</div>');
        else
            $(".direct-chat-messages").append('<img id="no-warning-img" class="direct-chat-img" src="/css/images/LogoMini.png" alt="Message User Image"><div id="no-warning-text" class="direct-chat-text">You dont have any warnings.</div>');
    }

    console.log(getClassesNames());
    console.log(getRelationsNames());

}

/**
 * Checks if the properties from a given
 * element is filled
 * @param element
 * return integer
 */
function filledProperties(element) {
    return element.parentNode.getAttribute('label') !== null && element.parentNode.nodeName === 'object' || element.nodeName === 'object';
}

/**
 * Returns if the given element is a relation or not
 * @returns {boolean}
 */
function isRelation(element) {
    if(filledProperties(element))
       return element.childNodes[0].getAttribute('edge') != null;
    else
        return element.getAttribute('edge') != null
       // ||// element.childNodes[0].getAttribute("style").includes('Relation');
}

/**
 * Returns if the given element is a class or not
 * @returns {boolean}
 */
function isClass(element) {
    console.log(element);
    if(filledProperties(element))
        return element.childNodes[0].getAttribute("style").includes('ellipse');  // element.childNodes[0].getAttribute("style").includes('Class')
    else
        return element.getAttribute("style").includes('ellipse');
}

/**
 * Returns if the given element is a instance or not
 * @returns {boolean}
 */
function isInstance(element) {
    return element.getAttribute("edge") === null &&
        element.getAttribute("style").includes('Instance');
}

/**
 * Initializes the modal animation of the given error
 * @param modal
 */
function warningAnimation(modal) {
    modal.show();
    modal.animate({opacity: '0.4'}, "slow");
    modal.animate({opacity: '0.8'}, "slow");
}

/**
 * Creates a new warning message in the warning console for the given text
 * @param text
 * @param warningId
 * @param type
 */
function warningMessage(text, warningId, type)
{
    if(type === 'Bad Practice' || type === 'Má Prática')
    {
        $(".direct-chat-messages").append(' <div class="direct-chat-msg ">' +
            '<div class="direct-chat-info clearfix">' +
            '<span class="direct-chat-name pull-right">' +
            '<i class="fa fa-warning"></i>' +
            '<strong> '+ type+'  </strong>' +
            '</span>' +
            '<span class="direct-chat-timestamp pull-left">' + new Date().toLocaleString() + '</span>' +
            '</div>' +
            '<img class="direct-chat-img" src="/css/images/warningIcon.png" alt="Warning Message">' +
            '<div style="background-color: #f39c12; color: white; border-color: #f39c12" class="direct-chat-text"> ' + text + '</div>' +
            '</div>');
    }
    else
    {
        $(".direct-chat-messages").append(' <div class="direct-chat-msg ">' +
            '<div class="direct-chat-info clearfix">' +
            '<span class="direct-chat-name pull-right">' +
            '<i class="fa fa-close"></i>' +
            '<strong> '+ type +' </strong>' +
            '</span>' +
            '<span class="direct-chat-timestamp pull-left">' + new Date().toLocaleString() + '</span>' +
            '</div>' +
            '<img class="direct-chat-img" src="/css/images/error-icon.png" alt="ErrorMessage">' +
            '<div style="background-color: indianred; color: white; border-color: indianred" class="direct-chat-text"> ' + text + '</div>' +
            '</div>');

    }

    warningAnimation($(".direct-chat-msg"));
    warningAnimation($("#warning-count"));
}

/**
 * Returns the value (property) of a mxCell Tag or the label (property) of a object Tag
 * This function is used during the comparisons
 * @param element
 * return a string
 */
function getValueOrLabel(element)
{
    return element.getAttribute("value") ? element.getAttribute("value") : element.parentNode.getAttribute('label')
}

/**
 * Returns the id from a mxCell Tag or a object Tag
 * @param element
 * return integer
 */
function getElementId(element)
{
    return element.getAttribute("id") ? element.getAttribute("id") : element.parentNode.getAttribute('id')
}

/**
 * Returns the value(name)/label for the given id
 * This functions works for both object and mxCell Tags
 * @param xmlDoc
 * @param id
 * @returns {*}
 */
function getCellName(xmlDoc, id)
{
    for(let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
    {
        if(filledProperties(xmlDoc.getElementsByTagName("mxCell")[i]))
        {
            if(xmlDoc.getElementsByTagName("mxCell")[i].parentNode.getAttribute("id") === id)
                return getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]);
        }
        else
            if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("id") === id)
                return getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]);
    }
}

/**
 * Get the language by looking at the pathname
 * @returns {string}
 */
function getLanguage()
{
    return window.location.pathname.split('/')[1]
}

/**
 * Check if the mxCell is valid (have the necessary attributes for the compiler to read)
 * @param mxCell
 * @returns {boolean}
 */
function mxCellIsValid(mxCell)
{
    return mxCell.hasAttribute('style') && mxCell.hasAttribute('parent');
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
function getClassesNames()
{
    let names = [];
    for(let i = 0; i < classes.length; i++)
        names.push(removeSpaces(getValueOrLabel(classes[i])));
    classes = [];
    return names;
}

/**
 * Gets all relations names in the current diagram
 * @returns {Array}
 */
function getRelationsNames ()
{
    let names = [];
    for(let i = 0; i < relations.length; i++)
        names.push(removeSpaces(getValueOrLabel(relations[i])));
    relations = [];
    return names;
}

/**
 * Cleans the given string, removing white spaces and trash
 * @param string
 * @returns {*}
 */
function removeSpaces(string)
{
    if(string === '' || string === null)
        return '';
    string = string.replace(/[&]nbsp[;]/gi," ");
    string = string.replace(/[<]br[^>]*[>]/gi,"");
    return string.replace(/\s/g, '');
}
