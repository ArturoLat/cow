function checkEmail() {
    var email = $('#client-email').val();
    var errorDiv = $('#email-error');
    errorDiv.fadeOut();  

    if (!email) {
        return;
    }

    if (!validateEmail(email)) {
        errorDiv.html('Please enter a valid email address.').css('color', 'red').fadeIn(); 
        return;
    }

    $.ajax({
        url: 'servidor.php',
        type: 'POST',
        data: { action: 'checkEmail', email: email },
        dataType: 'xml',  
        success: function(responseXML) {
            var exists = $(responseXML).find('exists').text(); 
            //Email existe
            if (exists === '1') {
                var databaseName = $(responseXML).find('Name').text();
                var tableHtml = '<table><tr><th>Email</th><th>&nbsp;</th><th>Nom</th></tr>';
                tableHtml += '<tr><td>' + email + '</td><td>&nbsp;</td><td>' + databaseName + '</td></tr></table>';
                errorDiv.html(tableHtml).css('color', 'black').fadeIn(); 
            } else {
                // El email no existe en la base de datos
                errorDiv.html('Email is available.').css('color', 'green').fadeIn(); 
            }
        },
        error: function(xhr, status, error) {
            console.error('Error checking email:', error);
            errorDiv.html('Error checking email.').css('color', 'red').fadeIn(); 
        }
    });
}




function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
    