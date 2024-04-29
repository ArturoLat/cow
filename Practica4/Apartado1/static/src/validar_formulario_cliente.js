$(document).ready(function() {
    const nombreInput = $('#client-name');
    const errorMessagesDiv = $('#errorMessages');
    const form = $('#client-area-form');
    
    // Función para mostrar el error
    function mostrarError(mensaje, elemento) {
        errorMessagesDiv.html(mensaje).show();
        if (elemento) {
            elemento.effect("highlight", {color: '#ff9999'}, 3000);
        } else {
            console.log('El elemento no existe en el DOM.');
        }
        setTimeout(function() {
            errorMessagesDiv.hide();
        }, 5000);
    }
  
    // Función para ocultar el error
    function ocultarError() {
        errorMessagesDiv.hide();
    }
  
    // Función para validar el campo del nombre
    function validarNombre() {
        var valorNombre = nombreInput.val();
        if (!/^[a-zA-Z ]*$/.test(valorNombre)) {
            mostrarError("<div class='alert alert-danger' role='alert'> <h6 class=\"mt-0 d-inline-block\"> Error: </h6> Unicament lletres i espais en blanc permessos en el nom.<br></div>", nombreInput);
            nombreInput.attr('aria-invalid', 'true');
            return false;
        } else {
            nombreInput.attr('aria-invalid', 'false');
            ocultarError();
            return true;
        }
    }
  
    // Validar en tiempo real el nombre
    nombreInput.on('input', validarNombre);
  
    // Validar al momento de enviar el formulario
    form.on('submit', function(event) {
        var esNombreValido = validarNombre();

        if (!esNombreValido) {
            event.preventDefault(); // Evitar el envío del formulario si el nombre no es válido
        }
    });

});
