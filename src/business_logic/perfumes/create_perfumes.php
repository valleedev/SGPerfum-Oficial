<?php 
require_once '../../config.php';

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $brand = mysqli_real_escape_string($con, $_POST["brand"]);
        $gender = mysqli_real_escape_string($con, $_POST["gender"]);
        $price = (double)$_POST["price"];
        $size = (int)$_POST["size"];
        $concentration = mysqli_real_escape_string($con, $_POST["concentration"]);
        
        $targetDir = "../../../public/uploads/perfumes/";
        
        // Crear el directorio si no existe
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                die("Error al crear el directorio: " . $targetDir);
            }
        }

        $fechaRegistro = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO perfumes (nombre, marca, genero, precio, tamano, concentracion, fecha_registro)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        
        if (!$stmt) {
            die("Error al preparar la consulta: " . $con->error);
        }

        $stmt->bind_param("sssdsis", $name, $brand, $gender, $price, $size, $concentration, $fechaRegistro);
        $stmt->execute();
        $perfumeId = $stmt->insert_id; 
        $stmt->close();
        
        // Generar un nombre único para la imagen utilizando el ID del perfume
        $imageExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $targetFile = $targetDir . "perfume_" . $perfumeId . "." . $imageExtension;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Actualizar la base de datos con el nombre de la imagen
            $sqlUpdate = "UPDATE perfumes SET imagen = ? WHERE id = ?";
            $stmtUpdate = $con->prepare($sqlUpdate);
            
            if (!$stmtUpdate) {
                die("Error al preparar la consulta de actualización: " . $con->error);
            }
            
            $stmtUpdate->bind_param("si", $targetFile, $perfumeId);
            $stmtUpdate->execute();
            $stmtUpdate->close();
            
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    } else {
        echo "No se subió ningún archivo o hubo un error al subirlo.";
    }
}
}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
