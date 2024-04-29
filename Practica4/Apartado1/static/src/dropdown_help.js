$(document).ready(function() {
    var dropdownButton = $('#dropdownMenuButton');
    var dropdownMenu = $('.dropdown-menu').first();
    var isDropdownOpen = false;

    // Mostrar el menú desplegable al pasar el ratón sobre el botón
    dropdownButton.mouseenter(function(event) {
        if (!isDropdownOpen) {
            dropdownMenu.show('slide', {direction: 'down'}, 300);
            isDropdownOpen = true;
        }
    });

    // Ocultar el menú desplegable al sacar el ratón del botón
    dropdownButton.mouseleave(function(event) {
        if (isDropdownOpen) {
            dropdownMenu.hide('slide', {direction: 'up'}, 300);
            isDropdownOpen = false;
        }
    });

    // Cerrar el menú desplegable al hacer clic fuera de él
    $(document).click(function(event) {
        if (!$(event.target).closest('#dropdownMenuButton').length && !$(event.target).closest('.dropdown-menu').length) {
            dropdownMenu.hide('slide', {direction: 'up'}, 300);
            isDropdownOpen = false;
        }
    });

    // Cambiar el texto del botón al hacer clic en un elemento del menú desplegable
    $('.dropdown-menu a').click(function(e) {
        var text = $(this).text();
        dropdownButton.text(text);
        dropdownMenu.hide('slide', {direction: 'up'}, 300);
        isDropdownOpen = false;
        e.preventDefault();
    });
});
