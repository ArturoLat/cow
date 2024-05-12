$(document).ready(function() {
    $.getJSON('./static/src/hoteles.json', function(hoteles) {
        const searchInput = $('#search-hotel');
        const suggestionsContainer = $('#search-suggestions');
        renderHotels(hoteles);

        searchInput.on('input', function() {
            const inputText = $(this).val().toLowerCase();
            const filteredHotels = hoteles.filter(hotel =>
                hotel.nombre.toLowerCase().includes(inputText) ||
                hotel.ciudad.toLowerCase().includes(inputText)
            );
            updateSuggestions(inputText, filteredHotels, suggestionsContainer);
            renderHotels(filteredHotels);
        });

        // Asegurarse de ocultar las sugerencias cuando se haga clic en cualquier lugar del documento
        $(document).click(function(e) {
            if (!searchInput.is(e.target)) {
                suggestionsContainer.hide();
            }
        });
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error('Error al cargar la lista de hoteles:', errorThrown);
    });
});

function renderHotels(hoteles) {
    const hotelList = $('.hotel-listing');
    hotelList.empty();
    
    $.each(hoteles, function(index, hotel) {
        const html = `
            <div class="media mb-4 p-3 bg-white shadow-sm">
            <a href="#" class="thumbnail">
                <img src="${hotel.imagen}" alt="${hotel.nombre}" class="mr-3 align-self-center img-fluid" style="width: 150px; height: auto; border-radius: 4px; margin-right: 15px;">
            </a>
            <div class="media-body">
                <h5 class="mt-0">${hotel.nombre}</h5>
                <p>${hotel.ciudad}</p>
                <div class="form-inline">
                    <form action="https://www.google.com/search" method="get" class="form-inline" target="_blank">
                        <label for="personas-dropdown-${index}" class="mr-2">Personas:</label>
                        <select class="custom-select mr-2 personas-dropdown" id="personas-dropdown-${index}">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="other">Otra cantidad...</option>
                        </select>
                        <input type="hidden" name="q" value="${hotel.nombre}">
                        <button type="submit" class="btn btn-primary">Reservar</button>
                    </form>
                    <button class="details-toggle btn btn-info ml-3">Show Details</button>
                </div>
                <div class="hotel-details mt-2" style="display: none;">
                    <p>${hotel.descripcion}</p>
                </div>
            </div>
        </div>
        `;
        hotelList.append(html);
    });

    // Añadir interacción para mostrar detalles
    $('.details-toggle').click(function() {
        var details = $(this).closest('.media-body').find('.hotel-details');
        details.slideToggle(600);
    });

    //Otra cantidad...
    $('.personas-dropdown').change(function() {
        var selected = $(this).val();
        var nextElement = $(this).nextAll('input.number-input');
        if (selected === 'other' && nextElement.length === 0) {
            // Si se selecciona "Otra cantidad..." y no existe aún el input, añadirlo
            $(this).after(`<input type="number" class="form-control number-input ml-2 mr-2" placeholder="Especificar cantidad" style="width: auto;">`);
        } else if (selected !== 'other' && nextElement.length > 0) {
            // Si no se selecciona "Otra cantidad..." y el input existe, eliminarlo
            nextElement.remove();
        }
    });
}

function updateSuggestions(inputText, hoteles, suggestionsContainer) {
    suggestionsContainer.empty();

    if (inputText.length > 0 && hoteles.length > 0) {
        suggestionsContainer.show();
        $.each(hoteles, function(index, hotel) {
            var suggestionButton = $('<button>', {
                type: 'button',
                'class': 'suggestion-button btn btn-light btn-block',
                text: hotel.nombre + ', ' + hotel.ciudad,
                click: function() {
                    $('#search-hotel').val(hotel.nombre);
                    suggestionsContainer.hide();
                    renderHotels([hotel]);
                }
            });
            suggestionsContainer.append(suggestionButton);
        });
    } else {
        suggestionsContainer.hide();
    }
}
