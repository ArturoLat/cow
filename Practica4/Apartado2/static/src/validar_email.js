function checkEmail() {
    var email = $('#client-email').val();
    var errorDiv = $('#email-error');
    errorDiv.html(''); // Limpiar mensajes anteriores

    if (!email) {
        return; // Si no hay email, simplemente regresa
    }

    // Verificar si el email tiene un formato válido
    if (!validateEmail(email)) {
        errorDiv.html('Please enter a valid email address.').css('color', 'red');
        return;
    }

    $.ajax({
        url: 'servidor.php',
        type: 'POST',
        data: { action: 'checkEmail', email: email },
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.exists) {
                errorDiv.html('Email is already registered.').css('color', 'red');
            } else {
                errorDiv.html('Email is available.').css('color', 'green');
            }
        },
        error: function() {
            errorDiv.html('There was an error checking the email.').css('color', 'red');
        }
    });
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
