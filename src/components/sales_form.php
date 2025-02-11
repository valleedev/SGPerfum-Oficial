<?php
require_once '../config.php';

$keyBFilter = $_GET['keyB'] ?? '';
$nameFilter = $_GET['name'] ?? '';
$houseFilter = $_GET['house'] ?? '';
$familyOFilter = $_GET['familyO'] ?? '';
$genderFilter = $_GET['gender'] ?? '';
$sizeFilter = $_GET['size'] ?? '';

$sql = "SELECT * FROM perfumes WHERE 1=1";

// filtros si se aplican
if (!empty($keyBFilter)) {
    $sql .= " AND clave_bouquet LIKE '%" . $con->real_escape_string($keyBFilter) . "%'";
}
if (!empty($nameFilter)) {
    $sql .= " AND nombre LIKE '%" . $con->real_escape_string($nameFilter) . "%'";
}

$sql .= " ORDER BY id_perfume DESC";

$result = $con->query($sql);
if (!$result) {
    die("Error en la consulta: " . $con->error);
}

?>
<div class="container my-3">
  <form id="saleForm" method="POST" action="procesar_venta.php">
    <!-- Campo oculto con el ID del vendedor -->
    <input type="hidden" name="vendedor" value="ID_DEL_VENDEDOR">
    
    <!-- Una sola tarjeta que contiene todo -->
    <div class="card">
      <div class="card-body">
        <!-- 1. Sección de Búsqueda de fragancia y Fragancia seleccionada -->
        <div class="row g-2 align-items-end">
          <!-- Búsqueda de fragancia -->
          <div class="col-md-5">
            <div class="input-group input-group-sm">
              <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código">
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
              <button type="button" id="btnBuscarFragancia" class="btn btn-primary">Buscar</button>
            </div>
          </div>
          <!-- Fragancia seleccionada (se muestra al buscar) -->
          <div class="col-md-7" id="fraganciaSeleccionada" style="display:none;">
            <div class="d-flex align-items-center">
              <img src="ruta_imagen.jpg" alt="Imagen fragancia" class="img-fluid me-2" style="max-width: 80px;">
              <div>
                <h6 id="fraganciaNombre" class="mb-0">Nombre fragancia</h6>
                <small>Código: <span id="fraganciaCodigo">0000</span></small><br>
                <small>Inventario: <span id="fraganciaInventario">100</span> gr</small>
              </div>
            </div>
          </div>
        </div>

        <hr>

        <!-- 2. Selección de envase y Subtotal -->
        <div class="row g-2 align-items-end">
          <!-- Selección de envase -->
          <div class="col-md-7">
            <label class="form-label">Envase</label>
            <div class="d-flex flex-wrap gap-2">
              <div class="form-check">
                <input class="form-check-input containerOption" type="radio" name="envase" id="envase1" value="30" data-price="20000" data-grams="12" required>
                <label class="form-check-label" for="envase1">$20.000<br><small>12gr - 30ml</small></label>
              </div>
              <div class="form-check">
                <input class="form-check-input containerOption" type="radio" name="envase" id="envase2" value="50" data-price="30000" data-grams="23">
                <label class="form-check-label" for="envase2">$30.000<br><small>23gr - 50ml</small></label>
              </div>
              <div class="form-check">
                <input class="form-check-input containerOption" type="radio" name="envase" id="envase3" value="100" data-price="50000" data-grams="38">
                <label class="form-check-label" for="envase3">$50.000<br><small>38gr - 100ml</small></label>
              </div>
            </div>
          </div>
          <!-- Subtotal resaltado en verde -->
          <div class="col-md-5">
            <label for="subtotalDisplay" class="form-label">Subtotal</label>
            <div class="input-group input-group-sm">
                <span id="subtotalDisplay" class="input-group-text bg-info text-white">$0</span>
            </div>
            </div>

        </div>

        <hr>

        <!-- 3. Gramos adicionales -->
        <div class="row g-2">
          <div class="col-md-6">
            <label for="gramosAdicionales" class="form-label">Gramos adicionales<br><small>($1.500/gr)</small></label>
            <input type="number" name="gramosAdicionales" id="gramosAdicionales" class="form-control form-control-sm" value="0" min="0">
          </div>
        </div>

        <hr>

        <!-- 4. Mensaje de alerta y Botón de Confirmación -->
        <div class="row g-2">
          <div class="col-12">
            <div class="alert alert-warning p-1 d-none" id="inventarioAlert">
              Excede inventario.
            </div>
          </div>
          <div class="col-12">
            <button type="submit" id="confirmarVenta" class="btn btn-success btn-sm w-100" disabled>Confirmar Venta</button>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </form>
</div>

  
  <!-- Bootstrap JS Bundle -->
  <script>
    // Simulación de búsqueda de fragancia (en producción se podría usar AJAX)
    document.getElementById('btnBuscarFragancia').addEventListener('click', function() {
      // Se simulan los datos de la fragancia encontrada
      document.getElementById('fraganciaSeleccionada').style.display = 'block';
      document.getElementById('fraganciaNombre').textContent = 'Fragancia Rápida';
      document.getElementById('fraganciaCodigo').textContent = 'F1234';
      // Se define el inventario disponible para la fragancia (por ejemplo, 100 gr)
      const inventario = 100;
      document.getElementById('fraganciaInventario').textContent = inventario;
      document.getElementById('fraganciaSeleccionada').setAttribute('data-available-grams', inventario);
      
      validateForm();
    });
    
    function calculateSubtotal() {
  const containerOption = document.querySelector('input[name="envase"]:checked');
  let basePrice = 0, containerGrams = 0;
  if (containerOption) {
    basePrice = parseInt(containerOption.getAttribute('data-price'));
    containerGrams = parseInt(containerOption.getAttribute('data-grams'));
  }
  const extraGrams = parseInt(document.getElementById('gramosAdicionales').value) || 0;
  const extraPrice = extraGrams * 1500;
  const subtotal = basePrice + extraPrice;
  
  // Actualiza el subtotal en el <span>
  document.getElementById('subtotalDisplay').textContent = '$' + subtotal.toLocaleString();
  
  return { containerGrams, extraGrams };
}

    
    // Función para validar la disponibilidad de inventario
    function validateInventory() {
      const fraganciaDiv = document.getElementById('fraganciaSeleccionada');
      const availableGrams = parseInt(fraganciaDiv.getAttribute('data-available-grams')) || 0;
      const { containerGrams, extraGrams } = calculateSubtotal();
      const totalGrams = containerGrams + extraGrams;
      if (totalGrams > availableGrams) {
        document.getElementById('inventarioAlert').classList.remove('d-none');
        return false;
      } else {
        document.getElementById('inventarioAlert').classList.add('d-none');
        return true;
      }
    }
    
    // Habilitar o deshabilitar el botón de confirmar según validaciones
    function validateForm() {
      const fraganciaVisible = document.getElementById('fraganciaSeleccionada').style.display !== 'none';
      const containerSelected = document.querySelector('input[name="envase"]:checked') !== null;
      const inventoryOk = validateInventory();
      document.getElementById('confirmarVenta').disabled = !(fraganciaVisible && containerSelected && inventoryOk);
    }
    
    // Eventos para recalcular subtotal y validar
    document.querySelectorAll('input[name="envase"]').forEach(function(el) {
      el.addEventListener('change', function() {
        calculateSubtotal();
        validateForm();
      });
    });
    document.getElementById('gramosAdicionales').addEventListener('input', function() {
      calculateSubtotal();
      validateForm();
    });
  </script>