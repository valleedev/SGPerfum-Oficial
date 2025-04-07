<?php
session_start();
include '../config.php'; 

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $contrasena = trim($_POST['password']);
        
        // Consulta para obtener el usuario por correo
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();

            // Verificar la contraseña encriptada
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                echo json_encode(["success" => true]);
                exit;
            }
        }
        // Mensaje genérico para credenciales inválidas
        echo json_encode(["success" => false, "message" => "Credenciales inválidas"]);
        exit;
    } else {
        echo json_encode(["success" => false, "message" => "Método no permitido"]);
        exit;
    }
} catch (mysqli_sql_exception $e) {
    error_log("Error: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Error interno del servidor"]);
    exit;
}
?>