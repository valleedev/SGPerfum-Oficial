<?php 
require_once '../../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Validar el ID del usuario recibido
        if (!isset($_GET['id_usuario']) || !is_numeric($_GET['id_usuario'])) {
            throw new Exception("ID de usuario inválido.");
        }

        $id_usuario = intval($_GET['id_usuario']);

        // Preparar la consulta para eliminar el usuario
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Usuario eliminado correctamente.'); window.location.href=document.referrer;</script>";
            } else {
                throw new Exception("No se encontró el usuario con el ID proporcionado.");
            }
        } else {
            throw new Exception("Error al ejecutar la consulta.");
        }
    } else {
        throw new Exception("Método no permitido.");
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href=document.referrer;</script>";
}
?>