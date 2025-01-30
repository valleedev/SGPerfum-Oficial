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
        $house = trim($_POST["house"] ?? '');
        $gender = trim($_POST["gender"] ?? '');
        $familyO = trim($_POST["familyO"] ?? '');
        $size = (int)($_POST["size"] ?? 0);
        $keyB = (int)($_POST["keyB"] ?? 0);

        $targetDir = "../../../public/uploads/perfumes/";
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                die("Error al crear el directorio: " . $targetDir);
            }
        }

        if (!$name || !$house || !$gender || !$familyO || $size <= 0 || $keyB <= 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Datos faltantes o inválidos.',
            ]);
            exit;
        }

        // Consulta de actualización
        $sql = "UPDATE perfumes SET 
                    clave_bouquet = ?, nombre = ?, casa = ?, familia_olfativa = ?, genero = ?, cantidad = ?
                WHERE id_perfume = ?";
        $stmt = $con->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $con->error);
        }

        $stmt->bind_param("issssii", $keyB, $name, $house, $familyO, $gender, $size, $perfume_id);
        $stmt->execute();

        $response = [
            'success' => true,
            'message' => 'Perfume actualizado correctamente.',
        ];

        if ($stmt->affected_rows === 0) {
            $response['message'] = 'No se realizaron cambios en el perfume.';
        }

        $stmt->close();
        /* // No he podido con el error que se genera en esta parte 
        // Subir imagen
        try {
            include 'upload_images.php';
            $imageUpdateMessage = json_decode(updateImage('perfumes', 'imagen', 'id_perfume', $perfume_id, $_FILES['image']));
            $response['image_message'] = $imageUpdateMessage;
        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = 'Error al actualizar la imagen: ' . $e->getMessage();
        }
*/
        echo json_encode($response);

    } else {
        throw new Exception("Método no permitido.");
    }

} catch (Exception $e) {
    // Registrar el error en un archivo de registro
    error_log("Error: " . $e->getMessage() . "\n", 3, 'errors.log');
    echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor: ' . $e->getMessage(),
    ]);
    exit;
}
