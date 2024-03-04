<?php
// Comprueba si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asigna los datos del formulario a variables PHP
    $ciudad = $_POST['ciudad'];
    $hotel = $_POST['hotel'];
    $personas = $_POST['personas'];
    
    $url = "servidor.php?ciudad=" . urlencode($ciudad) . "&hotel=" . urlencode($hotel) . "&personas=" . urlencode($personas);
    header("Location: " . $url);
    exit();
} else {
    // Si el formulario no ha sido enviado, redirigir al formulario de reserva
    header("Location: main_page.html");
    exit();
}
?>
