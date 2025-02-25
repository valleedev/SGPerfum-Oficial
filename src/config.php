<?php
//Conection
$con = mysqli_connect("localhost", "root", "", "sgperfumdb");

if (!$con) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    exit;
} 
// Constantes re ruta base
define('ASSETS', '/sgperfum/public/assets/');
define('UPLOADS', '/sgperfum/public/uploads/');
define('PUB', '/sgperfum/public/');
define('SRC', '/sgperfum/src/');
define('DASH_VIEWS', '/sgperfum/src/dashboard/views/');
define('PERF_BL', '/sgperfum/src/perfumes/business_logic/');
define('PERF_VIEWS', '/sgperfum/src/perfumes/views/');
define('SALE_VIEWS', '/sgperfum/src/sales/views/');
define('USERS_VIEWS', '/sgperfum/src/users/views/');
define('COMP', '/sgperfum/src/components/');
define('VIEWS', '/sgperfum/src/views/');

function obtenerDatosUsuario($con, $usuario_id) {
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
 
?>