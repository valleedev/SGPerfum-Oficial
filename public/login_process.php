<?php
session_start();
include '../src/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = trim($_POST['email']);
    $contrasena = trim($_POST['password']);
    

    // Consulta para verificar credenciales
    $sql = "SELECT * FROM usuarios WHERE email = ? AND contraseña = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: ../src/views/dashboard.php"); 
        exit;
    } else {

        echo "Error en credenciales";
        exit;
    }
} else {
    echo "Erro en método";
    exit;
}
?>