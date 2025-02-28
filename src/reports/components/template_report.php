<?php
include 'get_user_date.php';
?> 
<div class="container-fluid">

  <!-- Sección de Reporte (estilo factura) -->
  <div id="reporteInvoice" class="p-3 border">
    <!-- Encabezado de la factura -->
    <div class="clearfix mb-5">
      <div class="float-start m-2">
        <img src="<?= ASSETS ?>images/logo-sm.png" alt="Logo" height="30">
      </div>
      <div class="float text-center">
        <h3 >Perfumería Palomino</h3>
        <h6 >Reporte de ventas por Usuario</h6>
      </div>
    </div>

    <!-- Información de la factura -->
    <div class="row mb-3 mt-5">
      <div class="col-md-12 text-md-end">
        <p>Desde <span id="startDate">...</span> Hasta <span id="endDate">...</span></p>
      </div>
    </div>

    <!-- Tabla con el reporte -->
    <div class="table-responsive">
      <table class="table table-centered">
        <thead class="table">
          <tr>
            <th>Fecha</th>
            <th>ID Venta</th>
            <th>Nombre Vendedor</th>
            <th>Clave Fragancias</th>
            <th>Envase Fragancias</th>
            <th>Gramos Fragancia</th>
            <th>Total Gramos</th>
            <th>Total Venta</th>
          </tr>
        </thead>
        <tbody id="tablaReporte">
          <!-- Aquí se inyectará dinámicamente el contenido con los datos de la base -->
          <!-- Ejemplo de fila:
          <tr>
            <td>2025-02-26</td>
            <td>00123</td>
            <td>Juan Pérez</td>
            <td>F123</td>
            <td>Botella</td>
            <td>50</td>
            <td>500</td>
            <td>$1500</td>
          </tr>
          -->
        </tbody>
      </table>
    </div>

    <!-- Totales y Notas -->
    <div class="row mt-3">
      <div class="col-sm-6">
        <p class="text-muted"><small>Notas: Se muestran los registros filtrados</small></p>
      </div>
      <div class="col-sm-6 text-end">
        <h5 id="totalGeneral" class="px-3">$0.00</h5>
      </div>
    </div>

    <!-- Botón para imprimir -->
    <div class="text-end d-print-none mt-3">
      <button type="button" class="btn btn-primary" onclick="window.print()">
        <i class="mdi mdi-printer me-1"></i> Imprimir
      </button>
    </div>
  </div>
</div>

<script src="../../../public/assets/js/reports/reportsPerUser.js"></script>
