function checkEmail() {
    var email = $('#email').val();
    var errorDiv = $('#email-error');

    errorDiv.html(''); // Limpiar mensajes anteriores

    if (!email) {
        return; // Si no hay email, simplemente regresa
    }

    // Verificar si el email tiene un formato válido
    if (!validateEmail(email)) {
        errorDiv.html('Please enter a valid email address.').css('color', 'red');
    }else{
        errorDiv.html('Email is correct').css('color', 'green')
    }

    
}

function checkName(){
    
    var email = $('#email').val();
    var minombre = $('#minombre').val();
    var minombreDiv = $('#minombre-error');

    if (!minombre) {
        return; // Si no hay email, simplemente regresa
    }

    
    minombreDiv.html(''); 

    $.ajax({
        url: 'servidor.php',
        type: 'POST',
        data: { action: 'checkName', minombre: minombre, email:email},
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.exists) {
                
                minombreDiv.html('USUARIO REGISTRADO').css('color', 'green');
            } else {
                minombreDiv.html('USUARIO NO REGISTRADO').css('color', 'red');
            }
        },
        failure: function() {
            minombreDiv.innerHTML = 'There was an error checking the name.';
            minombreDiv.style.color = 'red';
        }
    });
}



function validateEmail(email) {
    var re = /^[a-zA-Z]+@[a-zA-Z]+\.[a-zA-Z]{3}$/;
    return email.match(re);
}
    