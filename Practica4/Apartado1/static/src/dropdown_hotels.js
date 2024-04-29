$(document).ready(function() {
    $.ajax({
        url: './static/src/hoteles.json',
        dataType: 'json',
        success: function(hoteles) {
            const hotelSelector = $('#hotel-selector');
            populateHotelSelector(hotelSelector, hoteles);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al cargar la lista de hoteles:', errorThrown);
        }
    });
});

function populateHotelSelector(selector, hoteles) {
    selector.empty(); // Limpia las opciones existentes
    $.each(hoteles, function(index, hotel) {
        var option = $('<option></option>').val(hotel.nombre).text(hotel.nombre);
        selector.append(option);
    });

    // JQUERYUI
    selector.selectmenu({
        width: 300
    });
}
