<?php 
require_once '../../config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $roleOption = $_POST['role'];
        $role = ($roleOption == 'admin') ? 1 : 2;

        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, contrasena, rol_id)
                VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if (!$stmt) {
            echo json_encode(["success" => false, "message" => "Error al preparar la consulta."]);
            exit;
        }
        $stmt->bind_param("sssi", $name, $email, $hashedPassword, $role);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Usuario creado exitosamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al ejecutar la consulta."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Método no permitido."]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>
