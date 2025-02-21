<?php
require_once '../../config.php'; 
// Reporte de ventas totales en un rango de fechas
function obtenerVentasTotales($con, $fecha_inicio, $fecha_fin) {
    $query = "SELECT COUNT(*) as total_ventas FROM ventas WHERE fecha_hora BETWEEN ? AND ?;";
    $stmt = $con->prepare($query); 
    $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
//Reporte de ingresos totales en el més actual
function obtenerIngresos($con, $fecha_inicio, $fecha_fin) {
    // Consulta para obtener los ingresos del mes
    $query_mes = "SELECT SUM(valor_venta) AS total_ingresos 
                  FROM (
                      SELECT v.id_venta, MAX(dv.valor_venta) AS valor_venta
                      FROM ventas v
                      JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
                      WHERE v.fecha_hora BETWEEN ? AND ?  
                      GROUP BY v.id_venta
                  ) AS ventas_agrupadas;";

    $stmt = $con->prepare($query_mes);
    $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_mes = $result->fetch_assoc();
    $stmt->close();

    $ingresos_mes = $row_mes['total_ingresos'] ?? 0; // Si es NULL, asigna 0

    // Consulta para obtener los ingresos totales sin filtro de fecha
    $query_total = "SELECT SUM(valor_venta) AS total_ingresos_totales 
                    FROM (
                        SELECT v.id_venta, MAX(dv.valor_venta) AS valor_venta
                        FROM ventas v
                        JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
                        GROUP BY v.id_venta
                    ) AS ventas_agrupadas;";

    $stmt = $con->prepare($query_total);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_total = $result->fetch_assoc();
    $stmt->close();

    $ingresos_totales = $row_total['total_ingresos_totales'] ?? 1; // Evitar división por 0

    // Calcular el porcentaje
    $porcentaje = ($ingresos_mes / $ingresos_totales) * 100;

    // Retornar los resultados
    return [
        'ingresos_mes' => $ingresos_mes,
        'ingresos_totales' => $ingresos_totales,
        'porcentaje' => round($porcentaje, 2) // Redondeamos a 2 decimales
    ];
}
// Reporte de stock crítico (productos con bajo stock)
function obtenerCantidadStock($con, $min_stock = 50) {
    // Obtener la cantidad de perfumes en stock crítico
    $queryCritico = "SELECT SUM(cantidad) AS total_critical_stock FROM perfumes WHERE cantidad <= ?";
    $stmtCritico = $con->prepare($queryCritico);
    $stmtCritico->bind_param("i", $min_stock);
    $stmtCritico->execute();
    $resultCritico = $stmtCritico->get_result();
    $dataCritico = $resultCritico->fetch_assoc();
    $total_critical_stock = $dataCritico['total_critical_stock'] ?? 0;

    // Obtener el stock total
    $queryTotal = "SELECT SUM(cantidad) AS total_stock FROM perfumes";
    $stmtTotal = $con->prepare($queryTotal);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $dataTotal = $resultTotal->fetch_assoc();
    $total_stock = $dataTotal['total_stock'] ?? 1; // Evitar división por cero

    // Calcular el porcentaje
    $porcentaje_critico = ($total_critical_stock / $total_stock) * 100;

    return [
        'total_critical_stock' => $total_critical_stock,
        'total_stock' => $total_stock,
        'porcentaje_critico' => round($porcentaje_critico, 2) // Redondeado a 2 decimales
    ];
}

// Reporte de ventas por vendedor
function obtenerVentasPorVendedor($con, $fecha_inicio, $fecha_fin) {
    $query = "SELECT u.nombre AS vendedor, SUM(v.total) as total_ventas 
              FROM ventas v 
              JOIN usuarios u ON v.vendedor_id = u.id 
              WHERE v.fecha BETWEEN ? AND ? 
              GROUP BY v.vendedor_id";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt->execute();
    return $stmt->get_result();
}

// Reporte de productos más vendidos
function obtenerProductosMasVendidos($con, $limite = 5) {
    $query = "SELECT p.nombre, SUM(dv.cantidad) as cantidad_vendida 
              FROM detalle_ventas dv 
              JOIN productos p ON dv.producto_id = p.id 
              GROUP BY dv.producto_id 
              ORDER BY cantidad_vendida DESC 
              LIMIT ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $limite);
    $stmt->execute();
    return $stmt->get_result();
}





?>
