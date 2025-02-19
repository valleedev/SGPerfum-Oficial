<?php
//Este archivo lo vamos a usar para las visualizaciones de precios desde la base de datos
require_once '../../config.php'; 

header('Content-Type: application/json');

try {
    // Verificar la conexión
    if (!$con) {
        echo json_encode(["error" => "Error de conexión a la base de datos"]);
        exit;
    }

    // Consultar los precios desde la base de datos
    $query = "SELECT capacidad_mls, precio FROM envases";
    $result = $con->query($query);

    $prices = [];
    while ($row = $result->fetch_assoc()) {
        $prices[$row['capacidad_mls']] = (float) $row['precio'];
    }

    echo json_encode(["success" => true, "prices" => $prices]);
} catch (Exception $e) {
    echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
    exit;
}
?>
