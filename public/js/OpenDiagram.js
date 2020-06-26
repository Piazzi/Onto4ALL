var editor = 0;

/**
 * Gets the current Editor from the Actions.js
 * @param editorParam
 */
function setEditor(editorParam)
{
    editor = editorParam;
}

$(document).ready(function () {

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // Fires the Ajax request when the button is clicked
    // Open the selected diagram
    $(".openOntology").click(function () {
        $.ajax({
            /* the route pointing to the post function */
            url: '/openDiagram',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN, id: $(this).attr('id')},
            dataType: 'JSON',
            /* remind that 'data' is the response of the DiagramController */
            success: function (data) {
                let doc = mxUtils.parseXml(data['file']);
                editor.editor.setGraphXml(doc.documentElement);
                console.log(data);
                $("#ontology-name").html('<i class="fa fa-fw fa-object-group"></i> Current Ontology:'+data['name']);
                $("#id").val(data['id']);
                $("#name").val(data['name']);
                $("#publication-date").val(data['publication_date']);
                $("#last-uploaded").val(data['last_uploaded']);
                $("#description").val(data['description']);
                $("#link").val(data['link']);
                $("#domain").val(data['domain']);
                $("#general-purpose").val(data['general_purpose']);
                $("#profile-users").val(data['profile_users']);
                $("#intended-user").val(data['intended_use']);
                $("#type-of-ontology").val(data['type_of_ontology']);
                $("#degree-of-formality").val(data['degree_of_formality']);
                $("#scope").val(data['scope']);
                $("#competence-questions").val(data['competence_questions']);
            }
        })
    });

    // Open the latest diagram

    $("#openRecentDiagram").click(function () {
        $.ajax({
            /* the route pointing to the post function */
            url: '/openRecentDiagram',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            /* remind that 'data' is the response of the DiagramController */
            success: function (data) {
                let doc = mxUtils.parseXml(data['file']);
                editor.editor.setGraphXml(doc.documentElement);
            }
        })
    })
});