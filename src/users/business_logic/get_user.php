<?php
require_once '../../config.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id_usuario']) || !is_numeric($_GET['id_usuario'])) {
        throw new Exception("ID de usuario inválido.");
    }

    $id_usuario = intval($_GET['id_usuario']);

    // Obtener datos del usuario
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("Usuario no encontrado.");
    }

    $user = $result->fetch_assoc();

    // Obtener roles
    $roles_sql = "SELECT * FROM roles";
    $roles_result = $con->query($roles_sql);
    $roles = [];
    while ($role = $roles_result->fetch_assoc()) {
        $roles[] = $role;
    }

    echo json_encode(["success" => true, "user" => $user, "roles" => $roles]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>