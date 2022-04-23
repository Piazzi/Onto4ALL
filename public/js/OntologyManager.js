var ontologyName = document.getElementById("ontology-name");


// Request to open an ontology
document.addEventListener("DOMContentLoaded", function () {
    let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Fires the Ajax request when the button is clicked
    // Open the selected ontology

    function updateOntology(id) {
        $.ajax({
            /* the route pointing to the post function */
            url: '/openOntology',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: { _token: CSRF_TOKEN, id: id },
            dataType: 'JSON',
            /* remind that 'data' is the response of the OntologyController */
            success: function (data) {
                let doc = mxUtils.parseXml(data['file']);
                editor.setGraphXml(doc.documentElement);

                document.getElementsByClassName('name-input').value = data['name'];

                document.getElementById('id').value = data['id'];
                document.getElementById('name-input').value = data['name'];
                document.getElementById('ontology-iri').value = "https://onto4alleditor.com/en/ontologies/" + data['id'];
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
                document.querySelector("title").textContent = document.getElementById('name-input').value + ' | Onto4ALL - Ontology Graphical Editor';

                // Select the namespaces on the <select> tag
                $('#namespace-select').val(data['namespace']).trigger('change');


                // Select the collaborators on the <select> tag
                $('#collaborators-select').val(data['collaborators']).trigger('change');

                $('#message').removeAttr("disabled");
                $('#send_msg').removeAttr("disabled");
                
                //Allow to click on the IRI input and set route
                document.getElementById('ontology-iri').disabled =false;
                document.getElementById('iri-link').setAttribute("href", "https://onto4alleditor.com/en/ontologies/"+data['id']);
                
                //Show when the ontology was last updated
                document.getElementById('last-update').innerHTML = '<span class="time"><i class="fa fa-clock-o"></i> ' + 'Last update: ' + data['last_update'];
                //Update the little star on the navbar
                if (data['favourite'] == 1)
                    document.getElementById('favorite-ontology').innerHTML = '<i style="color:#f39c12" class="fa fa-fw fa-star"></i>';
                else
                    document.getElementById('favorite-ontology').innerHTML = '<i class="fa fa-fw fa-star-o"></i>';
                updateSaveButtonInFrontEnd(true);

                updateChat(data['id']);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                updateSaveButtonErrorInFrontEnd();
            }
        })
    }

    $(".openOntology").click(function () {
        updateOntology(this.getAttribute('id'));
    });

    function openOntology(id) {
        updateOntology(id);
    }

    if (window.location.origin == ip_address) {
        let socket = io(ip_address + ":" + socket_port);

        socket.on('updateOntology', (ontologyID) => {
            if (ontologyID == document.getElementById('id').value) {
                updateOntology(document.getElementById('id').value);
            }
        });
    }
});
