document.addEventListener('DOMContentLoaded', function() {
    fetch('./static/src/hoteles.json')
    .then(response => response.json())
    .then(hoteles => {
        const hotelList = document.querySelector('.hotel-listing');
        const hotelSelector = document.getElementById('hotel-selector');
        renderHotels(hoteles);
        populateHotelSelector(hotelSelector, hoteles);

        const searchInput = document.getElementById('search-hotel');
        searchInput.addEventListener('input', function() {
            const filteredHotels = hoteles.filter(hotel => 
                hotel.nombre.toLowerCase().includes(this.value.toLowerCase()) ||
                hotel.ciudad.toLowerCase().includes(this.value.toLowerCase())
            );
            renderHotels(filteredHotels);
        });
    })
    .catch(error => {
        console.error('Error al cargar la lista de hoteles:', error);
    });
});

function renderHotels(hoteles) {
    const hotelList = document.querySelector('.hotel-listing');
    hotelList.innerHTML = '';
    
    hoteles.forEach((hotel, index) => {
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
                        <select class="custom-select mr-2" id="personas-dropdown-${index}">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4 o más</option>
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
        hotelList.innerHTML += html;
    });

    // Añadimos el show_details aqui
    $$('.details-toggle').each(function(button) {
        button.observe('click', function(event) {
            var details = button.up('.media-body').down('.hotel-details');
            if (details && details.getStyle('display') === 'none') {
                new Effect.SlideDown(details, {duration: 0.6});
            } else if (details) {
                new Effect.SlideUp(details, {duration: 0.6});
            }
            event.stop();
        });
    });
}


function populateHotelSelector(selector, hoteles) {
    selector.innerHTML = '';
    hoteles.forEach(hotel => {
        var option = document.createElement('option');
        option.value = hotel.nombre;
        option.textContent = hotel.nombre;
        selector.appendChild(option);
    });
}