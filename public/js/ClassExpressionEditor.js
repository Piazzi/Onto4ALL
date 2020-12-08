/**
 * Validates the axiom in the OWL API and returns if
 * the axioms is valid
 */
function validateAxiom() {
    let userInput = document.getElementById('ClassExpressionEditorInput');

    if (userInput.value === "")
    {
        changeHelpText('empty');
        changeInputColor(userInput, 'black');
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "https://cors-anywhere.herokuapp.com/https://whispering-gorge-06411.herokuapp.com/webapi/ontologia/valid", true);
    xhttp.setRequestHeader('Access-Control-Allow-Origin', '*');
    xhttp.setRequestHeader('Access-Control-Allow-Methods', 'POST');
    xhttp.setRequestHeader('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
    xhttp.setRequestHeader("Content-Type", "application/json");

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 202) {
            if (this.responseText === "true") {
                changeInputColor(userInput, "green");
                changeHelpText(true);
            } else {
                changeInputColor(userInput, "red");
                changeHelpText(false);
            }
        } else {
            changeInputColor(userInput, "yellow");
            //return alert('The server is not available at moment, try again later')
        }
    };
    let data =
        {
            "id": "https://onto4alleditor.com/en/ontologies/" + document.getElementById('id').value,
            "formato": "JSON",
            "classes": getElementsNames(),
            // split the axioms after each ';' and then remove empty/whitespace strings from the array
            "axiomas": userInput.value.split(';').filter(e => String(e).trim()),
            "propriedades": ""
        };
    xhttp.send(JSON.stringify(data));
}

/**
 * Change the text and border color from the user input
 * @param userInput
 * @param color
 */
function changeInputColor(userInput, color) {
    switch (color) {
        case "yellow":
            userInput.style.setProperty('color', '#f39c12');
            userInput.style.setProperty('border-color', '#f39c12');
            break;
        case "green":
            userInput.style.setProperty('color', 'green');
            userInput.style.setProperty('border-color', 'green');
            break;
        case "red":
            userInput.style.setProperty('color', 'red');
            userInput.style.setProperty('border-color', 'red');
            break;
        case "black":
            userInput.style.setProperty('color', 'black');
            userInput.style.setProperty('border-color', 'black');
            break;
    }
}

/**
 * Change the help text/icon and its color
 * @param axiomIsValid
 */
function changeHelpText(axiomIsValid) {
    let helpText = document.getElementById('help-text');
    let helpTextIcon = document.getElementById('help-text-icon');
    if (!helpText)
        return;
    let language = getLanguage();
    switch (axiomIsValid) {
        case true:
            if (language === 'en')
                helpText.childNodes[1].nodeValue = 'The axioms are valid!'; // get only the text node, not the other inner HTML tags
            else
                helpText.childNodes[1].nodeValue = 'Os axiomas são válidos!';
            helpText.style.color = 'green';
            helpTextIcon.className = "fa fa-fw fa-check";
            break;
        case false:
            if (language === 'en')
                helpText.childNodes[1].nodeValue = 'The axioms are not valid!';
            else
                helpText.childNodes[1].nodeValue = 'Os axioma não são válidos!';
            helpText.style.color = 'red';
            helpTextIcon.className = "fa fa-fw fa-close";
            break;
        case 'empty':
            if (language === 'en')
                helpText.childNodes[1].nodeValue = 'None axiom to check!';
            else
                helpText.childNodes[1].nodeValue = 'Nenhum axioma para checar!';
            helpText.style.color = 'black';
            helpTextIcon.className = "fa fa-fw fa-info-circle";
            break;
    }
}