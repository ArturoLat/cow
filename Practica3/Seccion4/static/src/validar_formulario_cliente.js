document.observe('dom:loaded', function() {
    const nombreInput = $('client-name');
    const entradaDateInput = $('client-entry-date');
    const salidaDateInput = $('client-departure-date');
    const errorMessagesDiv = $('errorMessages');
    const form = $('client-area-form');
    
    //Funcio per a que surti l'error
    function mostrarError(mensaje, elemento) {
        errorMessagesDiv.update(mensaje).show();
        if (elemento) {
            new Effect.Highlight(elemento, { startcolor: '#ff9999' });
        } else {
            console.log('El elemento no existe en el DOM.');
        }
        setTimeout(function() {
            ocultarError();
        }, 5000);
    }
  
    // Funció per amager l'error
    function ocultarError() {
        errorMessagesDiv.hide();
    }
  
    // Función para validar el campo del nombre
    function validarNombre() {
        var valorNombre = nombreInput.value;
        if (!/^[a-zA-Z ]*$/.test(valorNombre)) {
            mostrarError("<div class='alert alert-danger' role='alert'> <h6 class=\"mt-0 d-inline-block\"> Error: </h6> Unicament lletres i espais en blanc permessos en el nom.<br></div>", nombreInput);
            nombreInput.writeAttribute('aria-invalid', 'true');
            return false;
        } else {
            nombreInput.writeAttribute('aria-invalid', 'false');
            ocultarError()
            return true;
        }
    }
  
    // Validacio de fechas
    function validarFechas() {
        var fechaEntrada = new Date(entradaDateInput.value);
        var fechaSalida = new Date(salidaDateInput.value);

        if (fechaSalida <= fechaEntrada) {
            mostrarError("<div class='alert alert-danger' role='alert'> <h6 class=\"mt-0 d-inline-block\"> Error: </h6> La sortida ha de ser posterior a l'entrada.<br></div>", salidaDateInput);
            return false;
        }
        return true;
    }
  
    // Validar en temps real el nom
    nombreInput.observe('input', validarNombre);
  
    // Validar a l'hora d'enviar el formulari
    form.observe('submit', function(event) {
        Event.stop(event);
        var esNombreValido = validarNombre();
        var sonFechasValidas = validarFechas();

        if (esNombreValido && sonFechasValidas) {
            form.submit();
        }
    });
  });
  

