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
        </section>

        <!-- Cambio de "right" por bootstrap -->
        <aside class="col-sm-12 col-md-3 mb-3">
          <h2>Client</h2>
          <form id="client-area-form"  action="servidor.php" method="post">
            <div id="errorMessages"></div>
            <div class="form-group">
              <label for="client-name">Nom:</label>
              <input type="text" id="client-name" name="client_name" class="form-control">
              <small id="client-name-help" class="form-text text-muted">Solament lletres i espais en blanc.</small>
            </div>
            <div class="form-group">
              <label for="client-email">Email:</label>
              <input type="email" id="client-email" name="client_email" class="form-control" required onblur="checkEmail()">
              <div id="email-error"></div>
            </div>
            <div class="form-group">
              <label for="client-password">Contrasenya:</label>
              <input type="password" id="client-password" name="client_password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="client-entry-date">Fecha d'entrada:</label>
              <input type="date" id="client-entry-date" name="client_entry_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="client-departure-date">Fecha de sortida:</label>
                <input type="date" id="client-departure-date" name="client_departure_date" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="hotel-selector">Seleccionar Hotel:</label>
              <select id="hotel-selector" name="hotel_selector" class="form-control" required></select>
            </div>
            <div class="form-group">
              <label for="zone-selector">Seleccionar Zona:</label>
              <select id="zone-selector" name="zone_selector" class="form-control" required>
                  <option value="Spain">Spain</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Sweden">Sweden</option>
                  <option value="United States">United States</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </aside>
    </div>
    <!-- Cambio de "footer" por bootstrap -->
    <footer class="bg-dark text-white text-center py-3">
      <p>&copy; 2024 Reserves d'Hotels. Tots els drets reservats.</p>
    </footer>
      
  </div>


  <!-- Latest compiled and minified JavaScript -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="./static/src/validar_formulario_cliente.js"></script>
  <script src="./static/src/dropdown_hotels.js"></script>
  <script src="./static/src/validar_email.js"></script>
  <script src="./static/src/load_hotel.js"></script>
  <script src="./static/src/dropdown_help.js"></script>
</body>
</html>