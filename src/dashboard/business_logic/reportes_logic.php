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

// Reporte de stock crítico (productos con bajo stock)
function obtenerStockCritico($con, $min_stock = 10) {
    $query = "SELECT nombre, stock FROM productos WHERE stock < ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $min_stock);
    $stmt->execute();
    return $stmt->get_result();
}



?>
