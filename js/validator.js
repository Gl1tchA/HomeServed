function validateEmail() {
    var email = document.getElementById('email').value;
    if (email.length == 0 || !email.match(/^[A-Za-z\._\-[0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)) {
        producePrompt('Email Invalid', 'email-error', 'red');
        return false;
    }
    else{
        producePrompt('', 'email-error', 'green');
        return true;
    }
    producePrompt('Valid', 'email-error', 'green');
    return true;
}

function producePrompt(message, promptLocation, color) {
    document.getElementById(promptLocation).innerHTML = message;
    document.getElementById(promptLocation).style.color = color;
}
function validatePassword() {
    var password = document.getElementById('password').value;
    var errorMessage = '';
    var valid = true;

    // Check for minimum length (optional, if you want it to be at least 8 characters)
    if (password.length < 8) {
        errorMessage = 'Password must be at least 8 characters long.';
        valid = false;
    }

    // Check for uppercase letter
    if (!/[A-Z]/.test(password)) {
        errorMessage = 'Password must contain at least one uppercase letter.';
        valid = false;
    }

    // Check for number
    if (!/[0-9]/.test(password)) {
        errorMessage = 'Password must contain at least one number.';
        valid = false;
    }

    // Check for special character
    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errorMessage = 'Password must contain at least one special character.';
        valid = false;
    }

    if (valid) {
        producePrompt('', 'password-error', 'green');
        return true;
    } else {
        producePrompt(errorMessage, 'password-error', 'red');
        return false;
    }
}
function validatePhone() {
    var phone = document.getElementById('phone').value;
    var errorMessage = '';
    var valid = true;

    // Check if the phone number is empty
    if (phone.length == 0) {
        errorMessage = 'Phone number is required.';
        valid = false;
    }
        // Check if the phone number contains only digits
        else if (!phone.match(/^[0-9]{12}$/)) {
            errorMessage = 'Phone number must only contain digits.';
            valid = false;
        }
    // Check for correct phone length (e.g., 12 digits including area code)
    else if (phone.length != 12) {
        errorMessage = 'Phone number must include area code (e.g. 63).';
        valid = false;
    }



    // If everything is valid, show success message
    if (valid) {
        producePrompt('', 'phone-error', 'green');
        return true;
    } else {
        producePrompt(errorMessage, 'phone-error', 'red');
        return false;
    }
}