$(document).ready(function() {
    $('#example').DataTable();
});

function getDeleteElementId(id) {
    document.getElementById('delete-btn').setAttribute('value', id);
}

function getRemoveElementId(id) {
    document.getElementById('remove-btn').setAttribute('value', id);
}

function getAddAdminElementId(id) {
    document.getElementById('addadmin-btn').setAttribute('value', id);
}

function togglePasswordVisibility() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

// recover email file js
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function myFunction1() {
    var x = document.getElementById("myInput1");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
