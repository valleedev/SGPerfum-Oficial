<?php 
require_once '../../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $perfume_id = $_POST['id'] ?? null;

        if (!$perfume_id || !is_numeric($perfume_id)) {
            echo json_encode([
                'success' => false,
                'message' => 'ID de perfume inválido o no proporcionado.',
            ]);
            exit;
        }

        // Validar y sanitizar los valores
        $name = trim($_POST["name"] ?? '');
        $brand = trim($_POST["brand"] ?? '');
        $gender = trim($_POST["gender"] ?? '');
        $price = (double)($_POST["price"] ?? 0);
        $size = (int)($_POST["size"] ?? 0);
        $concentration = trim($_POST["concentration"] ?? '');

        if (!$name || !$brand || !$gender || !$concentration || $price <= 0 || $size <= 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Datos faltantes o inválidos.',
            ]);
            exit;
        }

        // Consulta de actualización
        $sql = "UPDATE perfumes SET 
                    nombre = ?, marca = ?, genero = ?, precio = ?, tamano = ?, concentracion = ? 
                WHERE id = ?";
        $stmt = $con->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $con->error);
        }

        $stmt->bind_param("sssdisi", $name, $brand, $gender, $price, $size, $concentration, $perfume_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Perfume actualizado correctamente.',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se realizaron cambios en el perfume.',
            ]);
        }

        $stmt->close();
    } else {
        throw new Exception("Método no permitido.");
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
    ]);
}
