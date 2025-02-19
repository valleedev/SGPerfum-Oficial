<?php
require_once '../../config.php';

header('Content-Type: application/json'); // Establecer encabezado JSON

try {
    // Manejo de errores de conexión
    if (!$con) {
        http_response_code(500);
        echo json_encode(["error" => "Error de conexión a la base de datos"]);
        exit;
    }

    // Verificar si se recibe clave
    if (isset($_GET['clave'])) {
        $id = $_GET['clave'];

        $stmt = $con->prepare("SELECT * FROM perfumes WHERE clave_bouquet = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        if (!$usuario) { 
            http_response_code(404);
            echo json_encode(["error" => "No se encontró ningún perfume con esa clave."]);
            exit;
        }

        echo json_encode(["success" => true, "data" => $usuario]);
        exit;
    } 
    // Verificar si se recibe nombre
    else if (isset($_GET['nombre'])) {
        $name = $_GET['nombre'];

        $stmt = $con->prepare("SELECT * FROM perfumes WHERE nombre = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        if (!$usuario) { 
            http_response_code(404);
            echo json_encode(["error" => "No se encontró ningún perfume con ese nombre."]);
            exit;
        }

        echo json_encode(["success" => true, "data" => $usuario]);
        exit;
    }

    // Si no se recibe ninguna clave o nombre
    http_response_code(400);
    echo json_encode(["error" => "Parámetro inválido. Se requiere 'clave' o 'nombre'."]);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
    exit;
}
?>
