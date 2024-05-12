$(document).ready(function() {
    var lastZone = ''; // Variable para almacenar la última zona seleccionada

    $('#show-hotels').click(function() {
        var zone = $('#zone-selector').val();

        // Comprueba si se debe toggle la visibilidad o cargar nuevos datos
        if ($('#hotel-table').is(':visible') && zone === lastZone) {
            $('#hotel-table').fadeOut(500); // Cambia el toggle a fadeOut para una desaparición suave
        } else {
            lastZone = zone; // Actualiza la última zona seleccionada
            $.ajax({
                url: 'servidor.php',
                type: 'POST',
                data: { action: 'showHotel', zone_selector: zone },
                dataType: 'json',
                success: function(hotels) {
                    displayHotels(hotels);
                    $('#hotel-table').hide().fadeIn(500); // Usa hide() para asegurar que la tabla está oculta antes de fadeIn
                },
                error: function(xhr, status, error) {
                    console.error('Error carregant els hotels:', error);
                    console.error('Response was:', xhr.responseText);
                    $('#hotel-table').html('<p>Error al carregar els hotels.</p>').show().fadeOut(5000);
                }
            });
        }
    });
});

function displayHotels(hotels) {
    if (hotels.length === 0) {
        // Mensaje claro y directo para cuando no hay hoteles disponibles
        $('#hotel-table').html('<p>No hi ha cap hotel al pais indicat.</p>').show(); // Muestra el mensaje sin animación de desaparición
    } else {
        var tableHtml = '<table class="table"><thead><tr><th>Nombre</th><th>Ciudad</th></tr></thead><tbody>';
        hotels.forEach(function(hotel) {
            tableHtml += `<tr><td>${hotel.nombre}</td><td>${hotel.ciudad}</td></tr>`;
        });
        tableHtml += '</tbody></table>';
        $('#hotel-table').html(tableHtml);
    }
}



