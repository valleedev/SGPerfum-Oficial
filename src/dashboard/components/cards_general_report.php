<?php
include_once '../business_logic/reportes_logic.php';
$ventas = obtenerVentasTotales($con, "2020-01-01", "2045-02-20");
?>
<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <select span class="badge-soft-primary border-none  float-end" name="selec" id="select">
                    <option value="Todas">Todas</option>
                    <option value="Todas">último mes</option>
                    <option value="Todas">último año</option>
                </select>
                <h5 class="card-title mb-0">Ventas</h5>
            </div>
            <div class="row d-flex align-items-center mb-4">
                <div class="col-8">
                    <h2 class="d-flex align-items-center mb-0"><?php echo number_format($ventas['total_ventas'], 0, ',', '.'); ?></h2>
                </div>
                <div class="col-4 text-end">
                    <span class="text-muted">100% <i class="mdi mdi-arrow-down text-danger"></i></span>
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