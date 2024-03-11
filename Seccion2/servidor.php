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
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              Hoteles
            </button>
            <div class="dropdown-menu">
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
                    10% <img src='../images/descuento-image.png' alt='Descuento' class="img-fluid" style="width: 20px; height: 20px;">
                  </td>
                </tr>
                <tr>
                  <td>Hotel Mandarin Oriental</td>
                  <td>
                    20% <img src='../images/descuento-image.png' alt='Descuento' class="img-fluid" style="width: 20px; height: 20px;">
                  </td>
                </tr>
              </tbody>
            </table>
        </aside>
        <!-- Cambio de "center" por bootstrap -->
        <section class="col-sm-12 col-md-6">
            <h2>Busqueda d'Hotels</h2>
            <form action="https://www.google.com/search" method="get" target="_blank" class="input-group mb-3">
                <input type="text" name="q" placeholder="Buscar hotel" class="form-control" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary">Buscar a Google</button>
                </div>
            </form>
            <div class="hotel-listing">
              <!-- Cambio de "hotel-entry" por bootstrap -->
              <div class="media mb-4 p-3 bg-white shadow-sm">
                <a href="#" class="thumbnail">
                  <img src="../images/hotel_vela.jpg" alt="Hotel W" class="mr-3 align-self-center img-fluid" style="width: 150px; height: auto; border-radius: 4px; margin-right: 15px;">
                
                </a>
        
                <div class="media-body">
                  <!-- Cambio de "hotel-info" por bootstrap -->
                  <h5 class="mt-0">W Barcelona</h5>
                  <p>Barcelona, España - Zona: Ciutat Vella</p>
                  <form action="https://www.google.com/search" method="get" class="form-inline" target="_blank">
                    <label for="personas-dropdown" class="mr-2">Persones:</label>
                    <select class="custom-select mr-2" id="personas-dropdown">
                        <option selected>0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4 o más</option>
                    </select>
                    <input type="hidden" name="q" value="W Barcelona">
                    <button type="submit" class="btn btn-primary">Reservar</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="hotel-listing">
              <div class="media mb-4 p-3 bg-white shadow-sm">
                <a href="#" class="thumbnail">
                  <img src="../images/hotel_mandarin.jpg" alt="Hotel Mandarin Oriental" class="mr-3 align-self-center img-fluid" style="width: 150px; height: auto; border-radius: 4px; margin-right: 15px;">
                </a>
                  <!-- Cambio de "hotel-entry" por bootstrap -->
                <div class="media-body">
                  <!-- Cambio de "hotel-info" por bootstrap -->
                  <h5 class="mt-0">Hotel Mandarin Oriental</h5>
                  <p>Barcelona, España - Zona: Passeig de Gracia</p>
                  <form action="https://www.google.com/search" method="get" class="form-inline" target="_blank">
                    <label for="personas-dropdown" class="mr-2">Persones:</label>
                    <select class="custom-select mr-2" id="personas-dropdown" required>
                        <option selected>0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4 o más</option>
                    </select>
                    <input type="hidden" name="q" value="Hotel Mandarin Oriental">
                    <button type="submit" class="btn btn-primary">Reservar</button>
                  </form>
                </div>
              </div>
            </div>
        </section>
        <!-- Cambio de "right" por bootstrap -->
        <aside class="col-sm-12 col-md-3 mb-3">
          <h2>Client</h2>
          <?php

            // Verificar si el formulario ha sido enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = $_POST['client_name'];
                $email = $_POST['client_email'];
                $password = $_POST['client_password'];
                $fechaEntrada = $_POST['client_entry_date'];
                $fechaSalida = $_POST['client_departure_date'];
                $hotelSeleccionado = $_POST['hotel_selector'];

                
                $valido = true;

                // Valida el nombre --> Solo Espacios blanco y letras
                if (!preg_match("/^[a-zA-Z ]*$/", $nombre)) {
                    $valido = false;
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "<h6 class=\"mt-0 d-inline-block\"> Error: </h6> Solo letras y espacios blancos permitidos en el nombre.<br>";
                    echo "</div>";
                }

                //Comprobacion de las fechas
                $entradaDateTime = new DateTime($fechaEntrada);
                $salidaDateTime = new DateTime($fechaSalida);
                if ($salidaDateTime <= $entradaDateTime) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "<h6 class=\"mt-0 d-inline-block\"> Error: </h6> La fecha de salida debe ser posterior a la fecha de entrada.<br>";
                    echo "</div>";
                    $valido = false;
                } 

                
                // Si sigue pasando los ifs, muestra los datos introducidos
                if ($valido) {
                    echo "<h6 class=\"mt-0 d-inline-block\">Nombre:</h6><input type=\"hidden\" name=\"q\"> $nombre<br>";
                    echo "<br>";
                    echo "<h6 class=\"mt-0 d-inline-block\"> Email:</h6><input type=\"hidden\" name=\"q\"> $email<br>";
                    echo "<br>";
                    echo "<h6 class=\"mt-0 d-inline-block\"> Fecha de Entrada:</h6><input type=\"hidden\" name=\"q\"> $fechaEntrada<br>";
                    echo "<br>";
                    echo "<h6 class=\"mt-0 d-inline-block\"> Fecha de Salida:</h6><input type=\"hidden\" name=\"q\"> $fechaSalida<br>";
                    echo "<br>";
                    echo "<h6 class=\"mt-0 d-inline-block\"> Hotel Seleccionado: </h6><input type=\"hidden\" name=\"q\"> $hotelSeleccionado<br>";
                    echo "<br>";
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
</body>
</html>


