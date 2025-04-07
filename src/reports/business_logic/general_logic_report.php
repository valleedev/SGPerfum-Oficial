<?php
require_once '../../config.php';
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if (!$con) {
        error_log("Error de conexión a la base de datos");
        die(json_encode(["status" => "error", "message" => "Error de conexión a la base de datos"]));
    }

    // Recibir parámetros
    $vendedor    = $_POST['vendedor'] ?? '';
    $fechaFiltro = $_POST['fecha'] ?? '';
    $fechaInicio = $_POST['fecha_inicio'] ?? '';
    $fechaFin    = $_POST['fecha_fin'] ?? '';

    // Log de parámetros recibidos
    error_log("Parámetros recibidos: " . json_encode($_POST));

    $whereClauses = [];
    $params = [];

    // Filtro por vendedor
    if (!empty($vendedor)) {
        $whereClauses[] = "v.id_usuario = ?";
        $params[] = $vendedor;
    }

    // Determinar fechas de inicio y fin
    if ($fechaFiltro === 'hoy') {
        $fechaInicio = $fechaFin = date('Y-m-d');
        $whereClauses[] = "DATE(v.fecha_hora) = CURDATE()";
    } elseif ($fechaFiltro === 'mes') {
        $fechaInicio = date('Y-m-01');
        $fechaFin = date('Y-m-t');
        $whereClauses[] = "MONTH(v.fecha_hora) = MONTH(CURDATE()) AND YEAR(v.fecha_hora) = YEAR(CURDATE())";
    } elseif ($fechaFiltro === 'año') {
        $fechaInicio = date('Y-01-01');
        $fechaFin = date('Y-12-31');
        $whereClauses[] = "YEAR(v.fecha_hora) = YEAR(CURDATE())";
    } elseif ($fechaFiltro === 'personalizado' && !empty($fechaInicio) && !empty($fechaFin)) {
        $whereClauses[] = "DATE(v.fecha_hora) BETWEEN ? AND ?";
        $params[] = $fechaInicio;
        $params[] = $fechaFin;
    }

    $whereSQL = count($whereClauses) > 0 ? " WHERE " . implode(" AND ", $whereClauses) : "";

    // Consulta SQL
    $sql = "SELECT v.fecha_hora, v.id_venta, u.nombre AS nombre_vendedor, 
            GROUP_CONCAT(DISTINCT f.clave_bouquet ORDER BY f.clave_bouquet ASC SEPARATOR ', ') AS clave_fragancias, 
            GROUP_CONCAT(DISTINCT e.capacidad_mls ORDER BY e.capacidad_mls ASC SEPARATOR ', ') AS envace_fragancias, 
            GROUP_CONCAT(dv.gramos_en_venta ORDER BY dv.gramos_en_venta ASC SEPARATOR ', ') AS gramos_fragancia, 
            SUM(dv.gramos_en_venta) AS total_gramos, 
            SUM(dv.valor_venta) AS total_venta 
            FROM ventas v 
            JOIN usuarios u ON v.id_usuario = u.id_usuario 
            JOIN detalle_ventas dv ON v.id_venta = dv.id_venta 
            JOIN perfumes f ON dv.id_perfume = f.id_perfume 
            JOIN envases e ON dv.id_envase = e.id_envase" 
            . $whereSQL . 
            " GROUP BY v.fecha_hora, v.id_venta, u.nombre 
              ORDER BY v.fecha_hora DESC";

    // Log de la consulta generada antes de ejecutarla
    error_log("Consulta SQL: " . $sql);

    // Preparar la consulta
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $con->error);
    }

    // Vincular parámetros si existen
    if (!empty($params)) {
        $tipos = '';
        foreach ($params as $param) {
            $tipos .= is_numeric($param) ? 'i' : 's';
        }

        error_log("Tipos de parámetros: " . $tipos);
        error_log("Valores de parámetros: " . json_encode($params));

        $stmt->bind_param($tipos, ...$params);
    }

    // Ejecutar consulta
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    // Obtener resultados
    $resultados = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    error_log("Número de resultados obtenidos: " . count($resultados));

    echo json_encode([
        "status" => "success",
        "data" => $resultados,
        "fecha_inicio" => $fechaInicio,
        "fecha_fin" => $fechaFin
    ]);
} catch (Exception $e) {
    http_response_code(500);
    error_log("Excepción capturada: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
