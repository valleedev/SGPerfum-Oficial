<?php 
require_once '../../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $perfume_id = $_GET['id'] ?? null;
        if (!$perfume_id) {
            // Redirigir si no hay ID
            header("Location: ../views/perfume_detail.php");
            exit;
        }

        // Asignación de valores
        $name = $_POST["name"];
        $brand = $_POST["brand"];
        $gender = $_POST["gender"];
        $price = (double)$_POST["price"];
        $size = (int)$_POST["size"];
        $concentration = $_POST["concentration"];

        // Consulta de actualización
        $sql = "UPDATE perfumes SET 
                    nombre = ?, marca = ?, genero = ?, precio = ?, tamano = ?, concentracion = ? 
                WHERE id = ?;";
        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Error al preparar la consulta: " . $con->error);
        }

        $stmt->bind_param("sssdisi", $name, $brand, $gender, $price, $size, $concentration, $perfume_id);
        $stmt->execute();

        // Comprobación de éxito
        if ($stmt->affected_rows > 0) {
            echo "Perfume actualizado correctamente.";
        } else {
            echo "No se realizaron cambios.";
        }

        $stmt->close();
    } else {
        die("Método no permitido.");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
