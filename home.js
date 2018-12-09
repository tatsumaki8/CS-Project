function validate() {
    var elt = document.getElementById("signup");

    var usernameRegexp = /^[a-zA-Z][a-zA-Z0-9]{5,9}$/;
    var passwordRegexp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,10}$/;

    if ((!usernameRegexp.test(elt.username.value)) || (!passwordRegexp.test(elt.password.value)) || (elt.password.value != elt.rpassword.value)) {
        document.getElementById("signup-response").innerHTML = "Invalid Input. Please try again.";
        return false;
    } else {
        return true;
    }
}

// Slider for Generator
function sliderValue(ID1, ID2) {
    var x = document.getElementById(ID1);
    var y = document.getElementById(ID2);
    y.value = x.value;
    generatePassword();
}

// Generate the actual password based on inputs
function generatePassword() {
    var az_up = document.getElementById("gen_pw_AZ");
    var az_low = document.getElementById("gen_pw_az");
    var num = document.getElementById("gen_pw_num");
    var misc = document.getElementById("gen_pw_misc");
    var length = document.getElementById("gen_pw_length_text").value;

    if (length < 8 || length > 36) {
        return;
    }

    var poss = [];
    if (az_up.checked) {
        for (var i = 0; i < 10; i++) {
            poss.push(i);
        }
    }
    if (az_low.checked) {
        for (var i = 10; i < 20; i++) {
            poss.push(i);
        }
    }
    if (num.checked) {
        for (var i = 20; i < 26; i++) {
            poss.push(i);
        }
    }
    if (misc.checked) {
        for (var i = 26; i < 29; i++) {
            poss.push(i);
        }
    }

    var newpass = "";
    var poss_up = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var poss_low = "abcdefghijklmnopqrstuvwxyz";
    var poss_num = "0123456789";
    var poss_misc = "!@#$%^&*";
    for (var i = 0; i < length; i++) {
        var rand = poss[Math.floor(Math.random() * poss.length)];
        if (rand < 10) {
            newpass += poss_up.charAt(Math.floor(Math.random() * poss_up.length));
        } else if (rand >= 10 && rand < 20) {
            newpass += poss_low.charAt(Math.floor(Math.random() * poss_low.length));
        } else if (rand >= 20 && rand < 26) {
            newpass += poss_num.charAt(Math.floor(Math.random() * poss_num.length));
        } else {
            newpass += poss_misc.charAt(Math.floor(Math.random() * poss_misc.length));
        }
    }
    validatePassword(newpass);
}

// Check to make sure the password contains atleast 1 of each checked selectio
function validatePassword(password) {
    var az_up = document.getElementById("gen_pw_AZ");
    var az_low = document.getElementById("gen_pw_az");
    var num = document.getElementById("gen_pw_num");
    var misc = document.getElementById("gen_pw_misc");

    var regExp = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    if (az_up.checked && !az_low.checked && !num.checked && !misc.checked) {
        regExp = /^(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (az_up.checked && az_low.checked && !num.checked && !misc.checked) {
        regExp = /^(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (az_up.checked && !az_low.checked && num.checked && !misc.checked) {
        regExp = /^(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (az_up.checked && !az_low.checked && !num.checked && misc.checked) {
        regExp = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (az_up.checked && az_low.checked && num.checked && !misc.checked) {
        regExp = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (az_up.checked && !az_low.checked && num.checked && misc.checked) {
        regExp = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (az_up.checked && az_low.checked && !num.checked && misc.checked) {
        regExp = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (az_up.checked && az_low.checked && num.checked && misc.checked) {
        regExp = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (!az_up.checked && az_low.checked && !num.checked && !misc.checked) {
        regExp = /^(?=.*[a-z])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (!az_up.checked && az_low.checked && num.checked && !misc.checked) {
        regExp = /^(?=.*[a-z])(?=.*\d)[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (!az_up.checked && az_low.checked && !num.checked && misc.checked) {
        regExp = /^(?=.*[a-z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (!az_up.checked && az_low.checked && num.checked && misc.checked) {
        regExp = /^(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (!az_up.checked && !az_low.checked && num.checked && !misc.checked) {
        regExp = /^(?=.*\d)[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (!az_up.checked && !az_low.checked && num.checked && misc.checked) {
        regExp = /^(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    } else if (!az_up.checked && !az_low.checked && !num.checked && misc.checked) {
        regExp = /^(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]*$/;
    }


    if (regExp.test(password)) {
        document.getElementById("generated_pw").value = password;
    } else {
        generatePassword();
    }
}

// Copy the password text to the clipboard
function copy() {
    var copyText = document.getElementById("generated_pw");
    copyText.select();
    document.execCommand("copy");
    var success = document.getElementById("copied");
    if (copyText.value != "") {
        success.innerHTML = "Copied to Clipboard!";
        setTimeout(function () {
            success.innerHTML = "";
        }, 5000);
    }

}

// Enable tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})