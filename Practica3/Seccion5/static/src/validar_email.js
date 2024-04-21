function checkEmail() {
    var email = document.getElementById('client-email').value;
    var errorDiv = document.getElementById('email-error');
    if (!email) {
        errorDiv.innerHTML = '';
        return;
    }
    // Verificar si el email tiene un formato válido
    if (!validateEmail(email)) {
        errorDiv.innerHTML = 'Please enter a valid email address.';
        errorDiv.style.color = 'red';
        return;
    }

    new Ajax.Request('servidor.php', {
        method: 'post',
        parameters: { action: 'checkEmail', email: email },
        onSuccess: function(response) {
            var jsonResponse = response.responseText.evalJSON();
            if (jsonResponse.exists) {
                errorDiv.innerHTML = 'Email is already registered.';
                errorDiv.style.color = 'red'; // Red for error
            } else {
                errorDiv.innerHTML = 'Email is available.';
                errorDiv.style.color = 'green'; // Green for success
            }
        },
        onFailure: function() {
            errorDiv.innerHTML = 'There was an error checking the email.';
            errorDiv.style.color = 'red'; // Red for error
        }
    });
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
