// Password Strength Checker
(function ($) {
    $.fn.extend({
        pwdstr: function (el) {
            return this.each(function () {



                $(this).keyup(function () {
                    $(el).html(getTime($(this).val()));
                });

                function getTime(str) {

                    var chars = 0;
                    var rate = 2800000000;

                    if ((/[a-z]/).test(str)) chars += 26;
                    if ((/[A-Z]/).test(str)) chars += 26;
                    if ((/[0-9]/).test(str)) chars += 10;
                    if ((/[^a-zA-Z0-9]/).test(str)) chars += 32;

                    var pos = Math.pow(chars, str.length);
                    var s = pos / rate;

                    var decimalYears = s / (3600 * 24 * 365);
                    var years = Math.floor(decimalYears);

                    var decimalMonths = (decimalYears - years) * 12;
                    var months = Math.floor(decimalMonths);

                    var decimalDays = (decimalMonths - months) * 30;
                    var days = Math.floor(decimalDays);

                    var decimalHours = (decimalDays - days) * 24;
                    var hours = Math.floor(decimalHours);

                    var decimalMinutes = (decimalHours - hours) * 60;
                    var minutes = Math.floor(decimalMinutes);

                    var decimalSeconds = (decimalMinutes - minutes) * 60;
                    var seconds = Math.floor(decimalSeconds);

                    var time = [];

                    if (years > 0) {
                        if (years == 1)
                            time.push("1 year, ");
                        else
                            time.push(years + " years, ");
                    }
                    if (months > 0) {
                        if (months == 1)
                            time.push("1 month, ");
                        else
                            time.push(months + " months, ");
                    }
                    if (days > 0) {
                        if (days == 1)
                            time.push("1 day, ");
                        else
                            time.push(days + " days, ");
                    }
                    if (hours > 0) {
                        if (hours == 1)
                            time.push("1 hour, ");
                        else
                            time.push(hours + " hours, ");
                    }
                    if (minutes > 0) {
                        if (minutes == 1)
                            time.push("1 minute, ");
                        else
                            time.push(minutes + " minutes, ");
                    }
                    if (seconds > 0) {
                        if (seconds == 1)
                            time.push("1 second, ");
                        else
                            time.push(seconds + " seconds, ");
                    }

                    if (time.length <= 0)
                        time = "less than one second, ";
                    else if (time.length == 1)
                        time = time[0];
                    else
                        time = time[0] + time[1];

                    return time.substring(0, time.length - 2);
                }

            });
        }
    });
})(jQuery);

// Slider for Generator
function sliderValue(ID1, ID2) {
    var x = document.getElementById(ID1);
    var y = document.getElementById(ID2);
    y.value = x.value;
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