document.getElementById("signup").onsubmit = validate;

function validate() {
    var elt = document.getElementById("signup");

    var usernameRegexp = /^[a-zA-Z][a-zA-Z0-9]{5,9}$/;
    var passwordRegexp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,10}$/;

    if ((!usernameRegexp.test(elt.userName.value)) || (!passwordRegexp.test(elt.password.value)) || (elt.password.value != elt.rpassword.value)) {
        window.alert("Invalid Input");
        return false;
    } else {
        return true;
    }
}