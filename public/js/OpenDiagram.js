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