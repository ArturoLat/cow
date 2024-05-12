<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'checkEmail') {
    $email = $_POST['email'] ?? '';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "simpsons";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo '<response><error>Connection failed: ' . $conn->connect_error . '</error></response>';
        exit;
    }

    $stmt = $conn->prepare("SELECT id, Name FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $responseXML = new SimpleXMLElement('<response></response>');
    $responseXML->addChild('exists', $stmt->num_rows > 0);

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name);
        $stmt->fetch();
        $database = $responseXML->addChild('database');
        $database->addChild('Name', $name);
    }

    // Imprimir la respuesta XML
    header('Content-type: text/xml');
    echo $responseXML->asXML();

    $stmt->close();
    $conn->close();
    exit; 
}
?>




<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'showHotel') {
  // Asegúrate de que la entrada está saneada y validada
  $zonaSeleccionada = filter_input(INPUT_POST, 'zone_selector', FILTER_SANITIZE_SPECIAL_CHARS);

  // Carga el JSON
  $hoteles = json_decode(file_get_contents('./static/src/hoteles.json'), true);

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "world";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT cities.name FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name = ? ORDER BY cities.population DESC LIMIT 15";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $zonaSeleccionada);
  $stmt->execute();
  $result = $stmt->get_result();

  $cities = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['name'];
    }
  } else {
      $cities = [];
  }

  $filteredHotels = array_filter($hoteles, function ($hotel) use ($cities) {
      return in_array($hotel['ciudad'], $cities);
  });


  header('Content-Type: application/json');
  
  echo json_encode(array_values($filteredHotels));


  $stmt->close();
  $conn->close();

  exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="./static/images/logo_ub.jpg">
  <title>UB Booking</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-
    Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-
    J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

    
  <script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

</head>

<body>
  <!-- Cambio de "main-body" por bootstrap -->
  <div class="container-fluid">
    <!-- Cambio de "header" por bootstrap -->
    <!-- PY: Padding en Y | MB: Margen Botton -->
    <header class="col-sm-12 text-center bg-dark text-white py-3 mb-3">
        <h1>UB Booking</h1>
        <nav class="navbar navbar-default justify-content-center" role="navigation">
          
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hoteles
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="#hotels" class="dropdown-item">Hoteles</a>
                <a href="#booking" class="dropdown-item">Reserves</a>
                <a href="#contact" class="dropdown-item">Contacte</a>
            </div>
          </div>


        </nav>
    </header>
    <div class="row">
      <!-- Cambio de "left" por bootstrap -->
        <aside class="col-sm-12 col-md-3 mb-3">
            <h2>Ofertes Especials</h2>
            <p>Descubreix les millors ofertes.</p>
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Hotel</th>
                  <th>Descompte</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Hotel Vela</td>
                  <td>
                    10% <img src='./static/images/descuento-image.png' alt='Descuento' class="img-fluid" style="width: 20px; height: 20px;">
                  </td>
                </tr>
                <tr>
                  <td>Hotel Mandarin Oriental</td>
                  <td>
                    20% <img src='./static/images/descuento-image.png' alt='Descuento' class="img-fluid" style="width: 20px; height: 20px;">
                  </td>
                </tr>
              </tbody>
            </table>
        </aside>
        <!-- Cambio de "center" por bootstrap -->
        
        <section class="col-sm-12 col-md-6">
          <h2>Busqueda de Hoteles</h2>
          <div class="autocomplete-container" style="position: relative;">
            <input type="text" id="search-hotel" placeholder="Buscar hotel por nombre o ciudad" class="form-control mb-3">
            <div id="search-suggestions" class="search-suggestions" style="display: none; position: absolute; background-color: #ffffff; border: 1px solid #d4d4d4; border-top: none; z-index: 99; width: 100%;"></div>
          </div>
          <div class="hotel-listing"></div>
          <div class="cities-listing">
          <?php
              
              // Parámetros de conexión a la base de datos
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "world";

              // Crear conexión
              $conn = new mysqli($servername, $username, $password, $dbname);

              // Verificar conexión
              if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
              }
              // Verificar si el formulario ha sido enviado
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Cogemos la zona seleccionada del formulario
                $zonaSeleccionada = $_POST['zone_selector'];

                // Consulta SQL donde cogemos el nombre, distrito y population de cities donde pertenezcan a la zona seleccionada
                $sql = "SELECT cities.name, cities.district, cities.population 
                        FROM cities 
                        JOIN countries ON cities.country_code = countries.code 
                        WHERE countries.name = '$zonaSeleccionada' 
                        ORDER BY cities.population DESC 
                        LIMIT 15";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  
                  echo "<h2 class='mt-0'>Top 15 Cities from $zonaSeleccionada</h2>";
                  echo "<table class='table table-hover'><tr><th>Ranking</th><th>Nom</th><th>Districte</th><th>Població</th></tr>";
                  $ranking = 1;
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr><td>".$ranking."</td><td>".$row["name"]."</td><td>".$row["district"]."</td><td>".$row["population"]."</td></tr>";
                      $ranking++;
                  }
                  echo "</table>";
                  
                  
                } else {
                  echo "No s'han trobat ciutats per la zona seleccionada.";
                }

                  
                // Cerrar conexión
                $conn->close();
              } else {
                echo "Acceso no permitido.";
              }
              ?>

          </div>
        </section>
        <!-- Cambio de "right" por bootstrap -->
        <aside class="col-sm-12 col-md-3 mb-3">
          <h2>Client</h2>
          <?php
            // Verificar si el formulario ha sido enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $valido = true;
              if(isset($_POST['actualizar_nombre'])){
                $email = $_POST['email'];
                $nombre_nuevo = $_POST['nombre_nuevo'];
              }else{
                $nombre = $_POST['client_name'];
                $email = $_POST['client_email'];
              }

              $password = $_POST['client_password'];
              $fechaEntrada = $_POST['client_entry_date'];
              $fechaSalida = $_POST['client_departure_date'];
              $hotelSeleccionado = $_POST['hotel_selector'];
              $zonaSeleccionada = $_POST['zone_selector'];
            

            
              
              // Si sigue pasando los ifs, muestra los datos introducidos
              if ($valido) {
                  // Conexión a la base de datos (ajusta según tus credenciales)
                  $servername = "localhost";
                  $username = "root";
                  $passwordDB = "";
                  $dbname = "simpsons";

                  $conn = new mysqli($servername, $username, $passwordDB, $dbname);
                  
                  if ($conn->connect_error) {
                      die("Conexió fallida: " . $conn->connect_error);
                  }
                  if(isset($_POST['actualizar_nombre'])){
                    $email = $_POST['email'];
                    $nombre_nuevo = $_POST['nombre_nuevo'];
                    
                    // Actualizar el nombre en la base de datos
                    $updateSql = "UPDATE students SET name = '$nombre_nuevo' WHERE email = '$email'";
                    if ($conn->query($updateSql) === TRUE) {
                        echo "<div class='alert alert-success' role='alert'>Nom actualitzat amb exit.</div>";
                        // Mostrar los datos introducidos
                        echo "<h6 class=\"mt-0 d-inline-block\">Nou nom:</h6> $nombre_nuevo<br>";
                        echo "<h6 class=\"mt-0 d-inline-block\">Email:</h6> $email<br>";
                        echo "<h6 class=\"mt-0 d-inline-block\">Fecha d'Entrada:</h6> $fechaEntrada<br>";
                        echo "<h6 class=\"mt-0 d-inline-block\">Fecha de Sortida:</h6> $fechaSalida<br>";
                        echo "<h6 class=\"mt-0 d-inline-block\">Hotel Seleccionat:</h6> $hotelSeleccionado<br>";
                        echo "<h6 class=\"mt-0 d-inline-block\">Zona Seleccionada:</h6> $zonaSeleccionada<br>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Error al actualizar el nom: " . $conn->error . "</div>";
                    }
                  }else{


                    // Comprobar si el usuario ya existe
                    $sql = "SELECT name, password FROM students WHERE email = '$email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // El usuario existe, comprobar nombre y contraseña
                        $row = $result->fetch_assoc();
                        if ($row['password'] !== $password) {
                          // Contraseña no coincide
                          echo "<div class='alert alert-danger' role='alert'>No s'ha iniciat sessio correctament: contrasenya incorrecta.</div>";
                        } else if ($row['name'] !== $nombre) {
                          // Nombre diferente, ofrecer actualizar el nombre
                          echo "<div id='dialog-confirm' title='Confirmar actualización'>";
                          echo "<p><span class='ui-icon ui-icon-alert' style='float:left; margin:12px 12px 20px 0;'></span>";
                          echo "El nombre en la cuenta es diferente. ¿Deseas actualizarlo con el nombre ingresado?</p>";
                          echo "<form id='form-update-name' method='post'>";
                          echo "<input type='hidden' name='email' value='$email'>";
                          echo "<input type='hidden' name='nombre_nuevo' value='$nombre'>";
                          echo "<input type='hidden' name='client_password' value='$password'>";
                          echo "<input type='hidden' name='client_entry_date' value='$fechaEntrada'>";
                          echo "<input type='hidden' name='client_departure_date' value='$fechaSalida'>";
                          echo "<input type='hidden' name='hotel_selector' value='$hotelSeleccionado'>";
                          echo "<input type='hidden' name='zone_selector' value='$zonaSeleccionada'>";
                          echo "<input type='hidden' name='actualizar_nombre' value='true'>";
                          echo "</form>";
                          echo "</div>";
                                            
                        }else {
                          // Inicio de sesión correcto
                          echo "<div class='alert alert-success' role='alert'>Inicio de sessió correcte.</div>";
                          // Mostrar los datos introducidos
                          echo "<h6 class=\"mt-0 d-inline-block\">Nom:</h6> $nombre<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Email:</h6> $email<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Fecha d'Entrada:</h6> $fechaEntrada<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Fecha de Sortida:</h6> $fechaSalida<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Hotel Seleccionat:</h6> $hotelSeleccionado<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Zona Seleccionada:</h6> $zonaSeleccionada<br>";
                      }
                    } else {
                        $query = "SELECT MAX(id) as maxId FROM students";
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        $nextId = $row['maxId'] + 1;
                        // El usuario no existe, insertar nuevo registro
                        $insertSql = "INSERT INTO students (id, name, email, password) VALUES ($nextId, '$nombre', '$email', '$password')";
                        
                        if ($conn->query($insertSql) === TRUE) {
                          echo "<div class='alert alert-success' role='alert'>Nou estudiant registrat amb exit.";
                          // Mostrar los datos introducidos
                          echo "<h6 class=\"mt-0 d-inline-block\">Nom:</h6> $nombre<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Email:</h6> $email<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Fecha d'Entrada:</h6> $fechaEntrada<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Fecha de Sortida:</h6> $fechaSalida<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Hotel Seleccionat:</h6> $hotelSeleccionado<br>";
                          echo "<h6 class=\"mt-0 d-inline-block\">Zona Seleccionada:</h6> $zonaSeleccionada<br>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
                        }
                    }

                    $conn->close();
                  }
                    
                } else {
                }
            } else {
                //Sino se envia el formulario, sale un error
                echo "Acceso no permitido.";
            }

            ?>
        </aside>
    </div>
    <!-- Cambio de "footer" por bootstrap -->
    <footer class="bg-dark text-white text-center py-3">
      <p>&copy; 2024 Reserves d'Hotels. Tots els drets reservats.</p>
    </footer>
      
  </div>


  <!-- Latest compiled and minified JavaScript -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="./static/src/load_hotel.js"></script>
  <script src="./static/src/dropdown_help.js"></script>
  <script src="./static/src/update_name.js"></script>
</body>
</html>


