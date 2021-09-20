var ontologyName = document.getElementById("ontology-name");
// Request to open an ontology
document.addEventListener("DOMContentLoaded", function() { 
    let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
   
    // Fires the Ajax request when the button is clicked
    // Open the selected ontology
    $(".openOntology").click(function () {
        $.ajax({
            /* the route pointing to the post function */
            url: '/openOntology',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN, id: this.getAttribute('id')},
            dataType: 'JSON',
            /* remind that 'data' is the response of the OntologyController */
            success: function (data) {
                let doc = mxUtils.parseXml(data['file']);
                editor.setGraphXml(doc.documentElement);
                //console.log(data);
                if(getLanguage() =='en')
                    ontologyName.innerHTML = '<i class="fa fa-fw fa-object-group"></i> Current Ontology:' + data['name'];
                else
                    ontologyName.innerHTML = '<i class="fa fa-fw fa-object-group"></i> Ontologia Atual:' + data['name'];
                document.getElementById('id').value = data['id'];
                document.getElementById('name').value = data['name'];
                document.getElementById('publication-date').value = data['publication_date'];
                document.getElementById('last-uploaded').value = data['last_uploaded'];
                document.getElementById('description').value = data['description'];
                document.getElementById('link').value = data['link'];
                document.getElementById('ontology-domain').value = data['domain'];
                document.getElementById('general-purpose').value = data['general_purpose'];
                document.getElementById('profile-users').value = data['profile_users'];
                document.getElementById('intended-use').value = data['intended_use'];
                document.getElementById('type-of-ontology').value = data['type_of_ontology'];
                document.getElementById('degree-of-formality').value = data['degree_of_formality'];
                document.getElementById('scope').value = data['scope'];
                document.getElementById('competence-questions').value = data['competence_questions'];
                document.getElementById('created-by').value = data['owner_name'];
                document.querySelector("title").textContent = document.getElementById('name').value + ' | Onto4ALL - Ontology Graphical Editor';

                // Select the namespaces on the <select> tag
                $('#namespace-select').val(data['namespace']).trigger('change');

                
                // Select the collaborators on the <select> tag
                $('#collaborators-select').val(data['collaborators']).trigger('change');

                updateSaveButtonInFrontEnd(true);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                alert('The following error has occurred: ' + JSON.stringify(jqXHR));
            }
        })
    });
});


// Request to save the current ontology 
document.addEventListener("DOMContentLoaded", function() { 

    let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Fires the Ajax request when the button is clicked

    document.getElementById('save-ontology').addEventListener('click', function () {
        document.getElementById('save-ontology').innerHTML='<div  class="overlay"><i style="color: white !important;" class="fa fa-refresh fa-spin"></i></div>';
        document.getElementById('save-ontology').style.backgroundColor = "#00a65a";
        document.getElementById('save-ontology').style.borderColor = "#00a65a";
        $.ajax({
            /* the route pointing to the post function */
            url: '/' + getLanguage() + '/updateOrCreate',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                id: document.getElementById('id').value,
                xml_string: new XMLSerializer().serializeToString(editor.getGraphXml()),
                name: document.getElementById('name').value,
                publication_date: document.getElementById('publication-date').value,
                last_uploaded: document.getElementById('last-uploaded').value,
                description: document.getElementById('description').value,
                link: document.getElementById('link').value,
                domain: document.getElementById('ontology-domain').value,
                general_purpose: document.getElementById('general-purpose').value,
                profile_users: document.getElementById('profile-users').value,
                intended_use: document.getElementById('intended-use').value,
                type_of_ontology: document.getElementById('type-of-ontology').value,
                degree_of_formality: document.getElementById('degree-of-formality').value,
                scope: document.getElementById('scope').value,
                competence_questions: document.getElementById('competence-questions').value,
                namespace: $("#namespace-select").val().toString(),
                collaborators: $("#collaborators-select").val()
            },

            dataType: 'JSON',
            /* remind that 'data' is the response of the OntologyController */
            success: function (data) {
                updateSaveButtonInFrontEnd(true);
                document.getElementById('ontology-name').innerHTML='<i class="fa fa-fw fa-object-group"></i> Current Ontology:'+ document.getElementById('name').value;
                document.getElementById('id').value=data['id'];
                document.getElementById('title').textContent = document.getElementById('name').value + ' | Onto4ALL - Ontology Graphical Editor';
            },

            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                alert('The following error has occurred: ' + JSON.stringify(jqXHR));
            }
        })
    });

});


// Reads the current ontology XML and then writes the report on a string for download
document.addEventListener("DOMContentLoaded", function() { 
    document.getElementById('download-ontology-report').addEventListener('click', function () {

        let report = '/************* Ontology Report *************/ \n\nClasses:';

        // write the classes in the document
        classes.forEach(ontologyClass => {
            report = report + '\n       Class: '+ ontologyClass.value.attributes['label'].value + ' | ID: ' + ontologyClass.id;
            report = report + '\n       Properties:';
            for (let i = 0; i < ontologyClass.value.attributes.length; i++) 
                report = report + '\n           - '+ontologyClass.value.attributes[i].name+': '+ ontologyClass.value.attributes[i].value;
            report = report+ '\n    ----------------------------------------';
        });

        report = report + '\nRelations: ';

        // write the relations in the document
        relations.forEach(relation => {
            report = report + '\n      Relation:  '+ relation.value.attributes['label'].value + ' | ID: ' + relation.id;
            report = report + '\n       Properties:';
            for (let i = 0; i < relation.value.attributes.length; i++) 
                report = report + '\n           - '+relation.value.attributes[i].name+': '+ relation.value.attributes[i].value;
            report = report+ '\n    ----------------------------------------';
        });
       
        report = report + '\n\n/************ Made with Onto4ALL ************/';
        document.getElementById('download-ontology-report').setAttribute("href", "data:text/plain;charset=UTF-8," + encodeURIComponent(report));
    })

});

// Downloads a .txt file containing all the errors that the user made in the current ontology
document.getElementById('download-errors-txt').addEventListener('click', function(){
    // let texts = document.querySelectorAll(".direct-chat-text").textContent;
    let consoleMessages = document.getElementsByClassName('direct-chat-text');
    let txts;
    for (let i = 0; i < consoleMessages.length; i++) 
        txts = txts + consoleMessages[i].textContent;
    this.href = "data:text/plain;charset=UTF-8," + encodeURIComponent(txts);
});

/**
 * Filter the given text, removing HTML tags
 * @param text
 */
function labelFilter(text) {
    try {
        return text.replace(/<[^>]*>/g, '');
    }
    catch (e) {
        console.log(e);
    }
}