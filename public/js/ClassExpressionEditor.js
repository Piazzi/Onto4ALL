
let connectives = [
    'and',
    'or',
    'not',
    'some',
    'only',
    'min',
    'max',
    'exactly',
    'value',
    'cardinality',
    'self',

];
// Detects when the user starts writing something
$(document).on('input', '#ClassExpressionEditorInput', function(){

    let classesNames = getClassesNames();
    let relationsNames = getRelationsNames();
    console.log($(this).val());

    if (connectives.some(v => $(this).val().includes(v)))
    {
        // There's at least one
        console.log($(this));
        $(this)[0].style.setProperty('border-color', 'red','important');
        $(this).css('color', 'red');

    }
    else
    {
        $(this)[0].style.setProperty('border-color', 'green','important');
        $(this).css('color', 'green');
    }





});

