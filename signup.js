function validate() {
    var elt = document.getElementById("signup");

    var usernameRegexp = /^[a-zA-Z0-9][a-zA-Z0-9]{3,29}$/;
    var passwordRegexp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,30}$/;

    if ((!usernameRegexp.test(elt.username.value)) || (!passwordRegexp.test(elt.password.value)) || (elt.password.value != elt.rpassword.value)) {
        document.getElementById("signup-response").innerHTML = "Invalid Input. Please try again.";
        return false;
    } else {
        return true;
    }
}

// Enable tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})