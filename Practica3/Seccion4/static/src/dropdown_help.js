document.observe('dom:loaded', function() {
    var dropdownButton = $('dropdownMenuButton');
    var dropdownMenu = $$('.dropdown-menu')[0];

    // Manejar el clic en el botón para mostrar/ocultar el menú
    dropdownButton.observe('mouseover', function(event) {
        if (dropdownMenu.hasClassName('show')) {
            new Effect.SlideUp(dropdownMenu, {duration: 0.3}); // Efecto de deslizar hacia arriba
            dropdownMenu.removeClassName('show');
        } else {
            new Effect.SlideDown(dropdownMenu, {duration: 0.3}); // Efecto de deslizar hacia abajo
            dropdownMenu.addClassName('show');
        }
        event.stop();
    });

    // Cerrar el dropdown al hacer clic fuera
    document.observe('click', function(event) {
        if (!event.findElement('#dropdownMenuButton') && !event.findElement('.dropdown-menu')) {
            dropdownMenu.removeClassName('show');
        }
    });

    // Cambiar el texto del botón cuando se selecciona un ítem del dropdown
    $$('.dropdown-menu a').each(function(link) {
        link.observe('click', function(e) {
            var text = e.target.innerHTML; // Obtiene el texto del enlace clickeado
            dropdownButton.update(text); // Actualiza el botón con el nuevo texto
            new Effect.SlideUp(dropdownMenu, {duration: 0.3}); // Cierra el menú
            dropdownMenu.removeClassName('show');
            e.stop(); // Detiene la propagación para evitar que se dispare el evento de clic del documento
        });
    });
});
