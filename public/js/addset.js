var survey_options = document.getElementById('set');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');

add_more_fields.onclick = function(){
    var newField = document.createElement('input');
    newField.setAttribute('type','text');
    newField.setAttribute('name','question[]');
    newField.setAttribute('placeholder','question');
    survey_options.appendChild(newField);

    var newField2 = document.createElement('input');
    newField2.setAttribute('type','text');
    newField2.setAttribute('name','answer[]');
    newField2.setAttribute('placeholder','answer');
    survey_options.appendChild(newField2);
}

remove_fields.onclick = function(){
    var input_tags = survey_options.getElementsByTagName('input');
    if(input_tags.length > 2) {
        survey_options.removeChild(input_tags[(input_tags.length) - 1]);
        survey_options.removeChild(input_tags[(input_tags.length) - 1]);
    }
}