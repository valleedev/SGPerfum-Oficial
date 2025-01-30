<?php 
require_once '../../config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $keyB = mysqli_real_escape_string($con, $_POST["keyB"]);
            $name = mysqli_real_escape_string($con, $_POST["name"]);
            $house = mysqli_real_escape_string($con, $_POST["house"]);
            $familyO = mysqli_real_escape_string($con, $_POST["familyO"]);
            $gender = mysqli_real_escape_string($con, $_POST["gender"]);
            $size = (int)$_POST["size"];
 
            $targetDir = "../../../public/uploads/perfumes/";
            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    die("Error al crear el directorio: " . $targetDir);
                }
            }

            $sql = "INSERT INTO perfumes (clave_bouquet, nombre, casa, familia_olfativa, genero, cantidad)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);

            if (!$stmt) {
                die("Error al preparar la consulta: " . $con->error);
            }

            $stmt->bind_param("issssi", $keyB, $name, $house, $familyO, $gender, $size);
            $stmt->execute();
            $perfumeId = $stmt->insert_id; 
            $stmt->close();
            
            // Llamar a la función uploadImage para manejar la carga de la imagen
            include './upload_images.php';
            // Parámetros: nombre de la tabla, columna de imagen, columna de ID, ID del perfume, archivo de imagen
            uploadImage('perfumes', 'imagen', 'id_perfume', $perfumeId, $_FILES['image']);
        } else {
            echo "No se subió ningún archivo o hubo un error al subirlo.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
