$(document).ready(function () {

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // Fires the Ajax request when the button is clicked

    $("#save-ontology").click(function () {

        $("#save-ontology").html('<div  class="overlay"><i style="color: white !important;" class="fa fa-refresh fa-spin"></i></div>');
        $("#save-ontology").css('background-color','#00a65a');
        $("#save-ontology").css('border-color','#00a65a');

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
                $("#save-ontology").removeClass('unsaved').addClass('saved');
                if(window.location.pathname.split('/')[1] === 'pt')
                    $("#save-ontology").html('<i class="fa fa-fw fa-save"></i>' + data['message-pt']);
                else
                    $("#save-ontology").html('<i class="fa fa-fw fa-save"></i>' + data['message-en']);

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