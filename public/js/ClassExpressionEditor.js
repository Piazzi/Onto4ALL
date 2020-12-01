/**
 * Validates the axiom in the OWL API and returns if
 * the axioms is valid
 * @param id
 * @param classes
 * @param axioms
 */
function validateAxiom(id, classes, axioms)
{
    let userInput = document.getElementById('ClassExpressionEditorInput');
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "https://whispering-gorge-06411.herokuapp.com/webapi/ontologia/valida", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 202)
        {
            let response = this.responseText;
            console.log(response);
            // the axioms is valid
            if(response)
            {
                userInput.style.setProperty('border-color', 'green','important');
                userInput.style.setProperty('color', 'green');
            } else
            {
                userInput.style.setProperty('border-color', 'red','important');
                userInput.style.setProperty('color', 'red');
            }
        }
        else
        {
            userInput.style.setProperty('border-color', '#f39c12','important');
            userInput.style.setProperty('color', '#f39c12');
            return alert('The server is not available at moment, try again later')
        }
    };
    let data =
    {
        "id": "https://onto4alleditor.com/en/ontologies/"+id,
        "formato": "JSON",
        "classes": classes,
        "axiomas": axioms,
        "propriedades": ""
    };
    xhttp.send(JSON.stringify(data));
}

