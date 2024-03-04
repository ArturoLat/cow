<?php
// Comprueba si hay datos de reserva en la URL (GET request)
if (isset($_GET['ciudad']) && isset($_GET['hotel']) && isset($_GET['personas'])) {
    // Asignacion de los datos
    $ciudad = $_GET['ciudad'];
    $hotel = $_GET['hotel'];
    $personas = $_GET['personas'];
    // Mostrar confirmación de la reserva al usuario
    echo "<h1>Confirmación de Reserva</h1>";
    echo "<p>Tu reserva para <strong>$hotel</strong> en <strong>$ciudad</strong> ha sido realizada con éxito.</p>";
    echo "<p>Número de personas: <strong>$personas</strong>.</p>";
} else {
    // Si no se reciben los datos esperados, mostrar un mensaje de error o redirigir al formulario de reserva
    echo "<p>Error: Datos de reserva no recibidos.</p>";
}
?>