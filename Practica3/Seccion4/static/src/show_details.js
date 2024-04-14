document.observe('dom:loaded', function() {
    $$('.details-toggle').each(function(button) {
        button.observe('click', function(event) {
            var details = button.up('.media-body').down('.hotel-details'); // Cambio aquí
            if (details && details.getStyle('display') === 'none') {
                new Effect.SlideDown(details, {duration: 0.6});
            } else if (details) {
                new Effect.SlideUp(details, {duration: 0.6});
            }
            event.stop();
        });
    });
});
