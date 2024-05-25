<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'checkName') {
    
    $minombre = $_POST['minombre'] ?? '';
    $email =  $_POST['email'] ?? '';  
            
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "simpsons";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    //Consulta del nombre en la BD
    $stmt = $conn->prepare("SELECT name FROM students WHERE name = ?");
    $stmt->bind_param("s", $minombre);
    $stmt->execute();

    if ($stmt->error) {
        echo json_encode(['error' => 'Error en la consulta: ' . $stmt->error]);
        exit;
    }

    $stmt->store_result();
    echo json_encode(['exists' => $stmt->num_rows > 0]);

    $stmt->close();
    $conn->close();
    exit; 
}
?>

