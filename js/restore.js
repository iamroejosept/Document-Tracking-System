function updateLabel() {
    var input = document.getElementById("backup_file_input");
    var label = document.getElementById("backup_file_label");
    var fileName = input.files[0].name;
    label.innerHTML = fileName;
}

$(document).ready(function() {


});