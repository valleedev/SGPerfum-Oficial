<?php
require_once '../config.php';
?>
<div class="container my-3">
  <form id="saleForm" method="POST" action="../business_logic/perfumes/process_sale.php">
    <div class="card">
      <div class="card-body">
        <!-- 1. Sección de Búsqueda de fragancia -->
        <div class="row g-2 align-items-end">
          <div class="container my-3">
            <div class="input-group input-group-sm">
              <input type="number" id="clave" name="clave" class="form-control" placeholder="Código">
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
              <button type="button" class="btn btn-primary" onclick="searchFragancia()">Buscar</button>
            </div>
          </div>
        </div>
        <hr>
        <!-- 2. Sección del formulario dinámico para cada fragancia -->
        <div id="saleDetails"></div>
        <!-- Campo oculto que almacenará el detalle de la venta en JSON -->
        <input type="hidden" id="sale_data" name="sale_data" value="">
        <!-- 3. Total acumulado de la venta -->
        <div class="mt-3">
          <h4>Total de la Venta: $<span id="totalSale">0.00</span></h4>
        </div>
        <!-- Botón para procesar la venta -->
        <div class="mt-3">
          <button type="submit" class="btn btn-success">Procesar Venta</button>
        </div>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </form>
</div>
<script src="<?= ASSETS ?>js/perfumes/salesJS.js"></script>
