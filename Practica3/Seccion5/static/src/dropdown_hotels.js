document.addEventListener('DOMContentLoaded', function() {
    fetch('./static/src/hoteles.json')
    .then(response => response.json())
    .then(hoteles => {
        
        const hotelSelector = document.getElementById('hotel-selector');
        populateHotelSelector(hotelSelector, hoteles);
    })
    .catch(error => {
        console.error('Error al cargar la lista de hoteles:', error);
    });
});

function populateHotelSelector(selector, hoteles) {
    selector.innerHTML = '';
    hoteles.forEach(hotel => {
        var option = document.createElement('option');
        option.value = hotel.nombre;
        option.textContent = hotel.nombre;
        selector.appendChild(option);
    });
}