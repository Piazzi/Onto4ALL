
// AJAX request to open an ontology
$(document).ready(function () {

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   
    // Fires the Ajax request when the button is clicked
    // Open the selected ontology
    $(".openOntology").click(function () {
        $.ajax({
            /* the route pointing to the post function */
            url: '/openOntology',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN, id: $(this).attr('id')},
            dataType: 'JSON',
            /* remind that 'data' is the response of the OntologyController */
            success: function (data) {
                let doc = mxUtils.parseXml(data['file']);
                editor.setGraphXml(doc.documentElement);
                //console.log(data);
                $("#ontology-name").html('Current Ontology:'+data['name']);
                $("#id").val(data['id']);
                $("#name").val(data['name']);
                $("#publication-date").val(data['publication_date']);
                $("#last-uploaded").val(data['last_uploaded']);
                $("#description").val(data['description']);
                $("#link").val(data['link']);
                $("#ontology-domain").val(data['domain']);
                $("#general-purpose").val(data['general_purpose']);
                $("#profile-users").val(data['profile_users']);
                $("#intended-use").val(data['intended_use']);
                $("#type-of-ontology").val(data['type_of_ontology']);
                $("#degree-of-formality").val(data['degree_of_formality']);
                $("#scope").val(data['scope']);
                $("#competence-questions").val(data['competence_questions']);
                $("#created-by").val(data['owner_name']);
                $("title").text($("#name").val() + ' | Onto4ALL - Ontology Graphical Editor');

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

    // Open the last updatead ontology
    $('#open-last-updated-ontology').click(function () {
        $.ajax({
            /* the route pointing to the post function */
            url: '/openLastUpdatedOntology',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN, id: $(this).attr('id')},
            dataType: 'JSON',
            /* remind that 'data' is the response of the OntologyController */
            success: function (data) {
                let doc = mxUtils.parseXml(data['file']);
                editor.setGraphXml(doc.documentElement);
                //console.log(data);
                $("#ontology-name").html('Current Ontology:'+data['name']);
                $("#id").val(data['id']);
                $("#name").val(data['name']);
                $("#publication-date").val(data['publication_date']);
                $("#last-uploaded").val(data['last_uploaded']);
                $("#description").val(data['description']);
                $("#link").val(data['link']);
                $("#ontology-domain").val(data['domain']);
                $("#general-purpose").val(data['general_purpose']);
                $("#profile-users").val(data['profile_users']);
                $("#intended-use").val(data['intended_use']);
                $("#type-of-ontology").val(data['type_of_ontology']);
                $("#degree-of-formality").val(data['degree_of_formality']);
                $("#scope").val(data['scope']);
                $("#competence-questions").val(data['competence_questions']);
                $("#created-by").val(data['owner_name']);
                $("title").text($("#name").val() + ' | Onto4ALL - Ontology Graphical Editor');

                // Select the namespace on the <select> tag
                $('#collaborators-select').val(data['collaborators']).trigger('change');
                
                // Select the collaborators on the <select> tag
                $('#collaborators-select').val(data['collaborators']).trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                alert('The following error has occurred: ' + JSON.stringify(jqXHR));
            }
        })
    });

});


// AJAX Request to save the current ontology 
$(document).ready(function () {

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // Fires the Ajax request when the button is clicked

    $("#save-ontology").on('click',function () {

        $("#save-ontology").html('<div  class="overlay"><i style="color: white !important;" class="fa fa-refresh fa-spin"></i></div>');
        $("#save-ontology").css('background-color','#00a65a');
        $("#save-ontology").css('border-color','#00a65a');
        $.ajax({
            /* the route pointing to the post function */
            url: '/' + getLanguage() + '/updateOrCreate',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                id: $("#id").val(),
                xml_string: new XMLSerializer().serializeToString(editor.getGraphXml()),
                name: $("#name").val(),
                publication_date: $("#publication-date").val(),
                last_uploaded: $("#last-uploaded").val(),
                description: $("#description").val(),
                link: $("#link").val(),
                domain: $("#ontology-domain").val(),
                general_purpose: $("#general-purpose").val(),
                profile_users: $("#profile-users").val(),
                intended_use: $("#intended-use").val(),
                type_of_ontology: $("#type-of-ontology").val(),
                degree_of_formality: $("#degree-of-formality").val(),
                scope: $("#scope").val(),
                competence_questions: $("#competence-questions").val(),
                namespace: $("#namespace-select").val().toString(),
                collaborators: $("#collaborators-select").val()
            },

            dataType: 'JSON',
            /* remind that 'data' is the response of the OntologyController */
            success: function (data) {
                updateSaveButtonInFrontEnd(true);
                $("#ontology-name").html('<i class="fa fa-fw fa-object-group"></i> Current Ontology:'+$("#name").val());
                $("#id").val(data['id']);
                $("title").text($("#name").val() + ' | Onto4ALL - Ontology Graphical Editor');
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
$(document).ready(function () {
    $('#download-ontology-report').click(function () {

        // get the XML document from the editor
        let xmlDoc = editor.getGraphXml();
        let report = '/************* Ontology Report *************/ \n\nClasses:';

        // Starts the XML interpretation
        for (let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
        {
            if(!elementIsValid(xmlDoc.getElementsByTagName("mxCell")[i]))
                continue;
            if(isClass(xmlDoc.getElementsByTagName("mxCell")[i]))
            {
                report = report + '\n       '+labelFilter(getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]));
                // check if the properties are filled
                if(filledProperties(xmlDoc.getElementsByTagName("mxCell")[i]))
                {
                    report = report + '\n       Properties:';
                    let parentNode = xmlDoc.getElementsByTagName("mxCell")[i].parentNode;
                    // write the properties
                    for(let i = 0; i < parentNode.attributes.length; i++)
                    {
                        report = report + '\n           - '+parentNode.attributes[i].name+': '+ labelFilter(parentNode.attributes[i].value);
                    }
                }

                report = report+ '\n    ----------------------------------------';


            }
        }
        report = report + '\nRelations: ';

        for (let i = 0; i < xmlDoc.getElementsByTagName("mxCell").length; i++)
        {
            if(!elementIsValid(xmlDoc.getElementsByTagName("mxCell")[i]))
                continue;
            if(isRelation(xmlDoc.getElementsByTagName("mxCell")[i]))
            {
                if(xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source") != null &&
                    xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target") != null)
                {
                    let domainId = xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("source");
                    let rangeId =  xmlDoc.getElementsByTagName("mxCell")[i].getAttribute("target");
                    report = report + '\n       '+labelFilter(findNameById(xmlDoc.getElementsByTagName("mxCell"),domainId))+' '+labelFilter(getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i])+' '+labelFilter(findNameById(xmlDoc.getElementsByTagName("mxCell"), rangeId)));
                }
                else
                    report = report + '\n       '+labelFilter(getValueOrLabel(xmlDoc.getElementsByTagName("mxCell")[i]));

                // check if the properties are filled
                if(filledProperties(xmlDoc.getElementsByTagName("mxCell")[i]))
                {
                    report = report + '\n       Properties:';
                    let parentNode = xmlDoc.getElementsByTagName("mxCell")[i].parentNode;
                    for(let i = 0; i < parentNode.attributes.length; i++)
                    {
                        report = report + '\n           - '+parentNode.attributes[i].name+': '+labelFilter(parentNode.attributes[i].value);
                    }
                }

                report = report+ '\n    ---------------------------------------- ';


            }
        }
        report = report + '\n\n/************ Made with Onto4ALL ************/';
        console.log(report);
        $('#download-ontology-report').attr("href", "data:text/plain;charset=UTF-8," + encodeURIComponent(report));

    })

});

// Downloads a .txt file containing all the errors that the user made in the current ontology
$('#download-errors-txt').click(function () {
    let texts = $('.direct-chat-text').text();
    this.href = "data:text/plain;charset=UTF-8," + encodeURIComponent(texts);
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