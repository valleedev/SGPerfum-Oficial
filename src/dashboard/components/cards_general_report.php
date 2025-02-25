<?php
include_once '../business_logic/reportes_logic.php';

function renderCard($title, $value, $badge, $percentage, $progressBarClass, $iconClass) {
    return "
    <div class='col-md-6 col-xl-3'>
        <div class='card'>
            <div class='card-body'>
                <div class='mb-4'>
                    <span class='badge badge-soft-primary float-end'>{$badge}</span>
                    <h5 class='card-title mb-0'>{$title}</h5>
                </div>
                <div class='row d-flex align-items-center mb-4'>
                    <div class='col-8'>
                        <h2 class='d-flex align-items-center mb-0'>{$value}</h2>
                    </div>
                    <div class='col-4 text-end'>
                        <span class='text-muted'>{$percentage}% <i class='mdi {$iconClass}'></i></span>
                    </div>
                </div>
                <div class='progress shadow-sm' style='height: 5px;'>
                    <div class='progress-bar {$progressBarClass}' role='progressbar' style='width: {$percentage}%;'></div>
                </div>
            </div>
        </div>
    </div>";
}

?>
<div class="p-3">
    <div class="row">
        <?php
        echo renderCard('Ventas', number_format($ventasHoy['total_ventas'], 0, ',', '.'), 'Hoy', 100, 'bg-info', 'mdi-arrow-up text-primary');
        echo renderCard('Ingresos en ventas', '$' . number_format($ingresos['ingresos_mes'], 0, '.', ','), 'Este mes', $porcentaje, 'bg-success', 'mdi-arrow-up text-success');
        echo renderCard('Stock Crítico', $stockCritico['total_critical_stock'], 'Todos', $stockCritico['porcentaje_critico'], 'bg-danger', 'mdi-arrow-down text-danger');
        echo renderCard('Total Stock', $stockCritico['total_stock'], 'Todos', $stockCritico['porcentaje_total'], 'bg-info', 'mdi-arrow-up text-primary');
        ?>
    </div>
</div>
