<?php
session_start();
include '../config.php'; 

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = trim($_POST['email']);
        $contrasena = trim($_POST['password']);
        
    
        // Consulta para verificar credenciales
        $sql = "SELECT * FROM usuarios WHERE email = ? AND contrasena = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $correo, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            echo json_encode(["success" => true]);
            exit;
        } else {
            echo json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
            exit;
        }
    } else {
        echo "Error en método";
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>