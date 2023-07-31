$(document).ready(function() {
    $('#example').DataTable();
});

// deletr button
function getDeleteElementId(id) {
    document.getElementById('delete-btn').setAttribute('value', id);
}



// function for password visibilty on eye click
function togglePasswordVisibility(inputId) {
    var x = document.getElementById(inputId);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}



// End set new password js
