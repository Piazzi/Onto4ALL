$(document).ready(function () {

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // Fires the Ajax request when the button is clicked

    $("#save-ontology").click(function () {
        $("#save-ontology").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.ajax({
            /* the route pointing to the post function */
            url: '/updateOrCreate',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                id: $("#id").val(),
                file: new XMLSerializer().serializeToString(editor.editor.getGraphXml()),
                name: $("#name").val(),
                publication_date: $("#publication-date").val(),
                last_uploaded: $("#last-uploaded").val(),
                description: $("#description").val(),
                link: $("#link").val(),
                domain: $("#domain").val(),
                general_purpose: $("#general-purpose").val(),
                profile_users: $("#profile-users").val(),
                intended_use: $("#intended-use").val(),
                type_of_ontology: $("#type-of-ontology").val(),
                degree_of_formality: $("#degree-of-formality").val(),
                scope: $("#scope").val(),
                competence_questions: $("#competence-questions").val(),
            },

            dataType: 'JSON',
            /* remind that 'data' is the response of the OntologyController */
            success: function (data) {
                $("#save-ontology").removeClass('unsaved');
                $("#save-ontology").addClass('saved');
                $("#save-ontology").html('<i class="fa fa-fw fa-save"></i>' + data['message']);
                $("#ontology-name").html('<i class="fa fa-fw fa-object-group"></i> Current Ontology:'+$("#name").val());
                $("#id").val(data['id']);
                console.log(data);

            },

            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        })
    });

});