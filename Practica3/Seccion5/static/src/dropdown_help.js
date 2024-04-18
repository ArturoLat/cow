document.observe('dom:loaded', function() {
    var dropdownButton = $('dropdownMenuButton');
    var dropdownMenu = $$('.dropdown-menu')[0];

    // Obrir el menu quan passem el mouse per sobre
    dropdownButton.observe('mouseover', function(event) {
        if (dropdownMenu.hasClassName('show')) {
            new Effect.SlideUp(dropdownMenu, {duration: 0.3}); // Efecte cap adalt
            dropdownMenu.removeClassName('show');
        } else {
            new Effect.SlideDown(dropdownMenu, {duration: 0.3}); // Efecte cap abaix
            dropdownMenu.addClassName('show');
        }
        event.stop();
    });

    // Tancar dropdown al tocar fora
    document.observe('click', function(event) {
        if (!event.findElement('#dropdownMenuButton') && !event.findElement('.dropdown-menu')) {
            dropdownMenu.removeClassName('show');
        }
    });

    // Cambiar el nom del dropdown pel seleccionat
    $$('.dropdown-menu a').each(function(link) {
        link.observe('click', function(e) {
            var text = e.target.innerHTML;
            dropdownButton.update(text);
            new Effect.SlideUp(dropdownMenu, {duration: 0.3});
            dropdownMenu.removeClassName('show');
            e.stop();
        });
    });
});
