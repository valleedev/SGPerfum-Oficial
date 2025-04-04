<?php
require_once '../../config.php';

header('Content-Type: application/json'); // Establecer el encabezado para JSON

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido.");
    }

    if (!isset($_POST['id_usuario'], $_POST['nombre'], $_POST['email'], $_POST['rol_id'])) {
        throw new Exception("Datos incompletos.");
    }

    $id_usuario = intval($_POST['id_usuario']);
    $nombre = trim($_POST['nombre']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $rol_id = intval($_POST['rol_id']);
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Construir la consulta SQL dinámicamente
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol_id = ?";
    $params = ["ssi", $nombre, $email, $rol_id];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql .= ", contrasena = ?";
        $params[0] .= "s"; // Añadir el tipo de dato para el hash
        $params[] = $hashed_password;
    }

    $sql .= " WHERE id_usuario = ?";
    $params[0] .= "i"; // Añadir el tipo de dato para id_usuario
    $params[] = $id_usuario;

    $stmt = $con->prepare($sql);
    $stmt->bind_param(...$params);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Usuario actualizado correctamente."]);
    } else {
        throw new Exception("Error al actualizar el usuario.");
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>