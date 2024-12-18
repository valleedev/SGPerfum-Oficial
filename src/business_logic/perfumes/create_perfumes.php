<?php 
require_once '../../config.php';
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
            $fechaRegistro = date('Y-m-d H:i:s');

            $targetDir = "../../../public/uploads/perfumes/";
            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    die("Error al crear el directorio: " . $targetDir);
                }
            }

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
            
            // Llamar a la función uploadImage para manejar la carga de la imagen
            include '../upload_images.php';
            // Parámetros: nombre de la tabla, columna de imagen, columna de ID, ID del perfume, archivo de imagen
            uploadImage('perfumes', 'imagen', 'id', $perfumeId, $_FILES['image']);
        } else {
            echo "No se subió ningún archivo o hubo un error al subirlo.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
