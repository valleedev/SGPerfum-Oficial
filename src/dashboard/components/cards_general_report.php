<?php
include_once '../business_logic/reportes_logic.php';
$ventas = obtenerVentasTotales($con, "2020-01-01", date("Y-m-d H:i:s"));

$fecha_inicio = date("Y-m-01"); // Primer día del mes actual
$fecha_fin = date("Y-m-d H:i:s"); // Fecha y hora actual
$ingresos = obtenerIngresos($con, $fecha_inicio, $fecha_fin);
$porcentaje = number_format($ingresos['porcentaje'], 0, ',', '.');

$stockCritico = obtenerCantidadStock($con);
$porcentaje_critico = $stockCritico['porcentaje_critico'];
?>
<div class="p-3">
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <span class="badge badge-soft-primary float-end">Todas</span>
                        <h5 class="card-title mb-0">Ventas</h5>
                    </div>
                    <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0"><?php echo number_format($ventas['total_ventas'], 0, ',', '.'); ?></h2>
                    </div>
                    <div class="col-4 text-end">
                        <span class="text-muted">100% <i class="mdi mdi-arrow-up text-primary"></i></span>
                    </div>
                </div>
                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%;"></div>
                </div>
            </div>
            <!--end card body-->
        </div>
        <!-- end card-->
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">Este mes</span>
                    <h5 class="card-title mb-0">Ingresos en ventas</h5>
                </div>
                    <div class="row d-flex align-items-center mb-4">
                      <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">$<?php echo number_format($ingresos['ingresos_mes'], 0, ',', '.'); ?></h2>
                      </div>
                      <div class="col-4 text-end">
                        <span class="text-muted"
                          ><?php echo $porcentaje ?>%<i class="mdi mdi-arrow-up text-success"></i
                        ></span>
                      </div>
                    </div>

                    <div class="progress shadow-sm" style="height: 5px;">
                      <?php echo "<div
                        class='progress-bar bg-success'
                        role='progressbar'
                        style='width: {$porcentaje}%;'
                      ></div>"?>
                    </div>
                  </div>
                  <!--end card body-->
                </div>
                <!-- end card-->
              </div>
              <!-- end col-->

              <div class="col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="mb-4">
                      <span class="badge badge-soft-primary float-end"
                        >Todos</span
                      >
                      <h5 class="card-title mb-0">Stock Crítico</h5>
                    </div>
                    <div class="row d-flex align-items-center mb-4">
                      <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0"><?php echo $stockCritico['total_critical_stock']; ?></h2>
                      </div>
                      <div class="col-4 text-end">
                        <span class="text-muted"
                          ><?php echo $porcentaje_critico ?>% <i class="mdi mdi-arrow-down text-danger"></i
                        ></span>
                      </div>
                    </div>

                    <div class="progress shadow-sm" style="height: 5px;">
                      <div
                        class="progress-bar bg-danger"
                        role="progressbar"
                        style="width: 57%;"
                      ></div>
                    </div>
                  </div>
                  <!--end card body-->
                </div>
                <!-- end card-->
              </div>
              <!-- end col-->

              <div class="col-md-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="mb-4">
                      <span class="badge badge-soft-primary float-end"
                        >Per Month</span
                      >
                      <h5 class="card-title mb-0">Expenses</h5>
                    </div>
                    <div class="row d-flex align-items-center mb-4">
                      <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">$784.62</h2>
                      </div>
                      <div class="col-4 text-end">
                        <span class="text-muted"
                          >57% <i class="mdi mdi-arrow-up text-success"></i
                        ></span>
                      </div>
                    </div>

                    <div class="progress shadow-sm" style="height: 5px;">
                      <div
                        class="progress-bar bg-warning"
                        role="progressbar"
                        style="width: 57%;"
                      ></div>
                    </div>
                  </div>
                  <!--end card body-->
                </div>
                <!--end card-->
              </div>
              <!-- end col-->

              <!-- end col-->
            </div>
</div>
