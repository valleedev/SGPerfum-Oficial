<?php
require_once '../../config.php';

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

    $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol_id = ? WHERE id_usuario = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssii", $nombre, $email, $rol_id, $id_usuario);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario actualizado correctamente.'); window.location.href=document.referrer;</script>";
    } else {
        throw new Exception("Error al actualizar el usuario.");
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href=document.referrer;</script>";
}
?>