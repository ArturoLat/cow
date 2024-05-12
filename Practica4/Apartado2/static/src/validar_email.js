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
        data: { action: 'showHotel', zone_selector: zone },
        dataType: 'json',  // Asegúrate de especificar que esperas un JSON
        success: function(response) {
            displayHotels(response);  // Si es JSON válido, jQuery lo parsea automáticamente
        },
        error: function(xhr, status, error) {
            console.error('Error cargando los hoteles:', error);
            $('#hotel-table').html('<p>Error al cargar los hoteles. Verifique la consola para más detalles.</p>').css('color', 'red');
        }
    });
    
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
    