<?php
//Conection
$con = mysqli_connect("localhost:3307", "root", "123456", "sgperfumdb");

if (!$con) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    exit;
} 
// Constantes re ruta base
define('ASSETS', '/sgperfum/public/assets/');
define('UPLOADS', '/sgperfum/public/uploads/');
define('PUB', '/sgperfum/public/');
define('SRC', '/sgperfum/src/');
define('COMP', '/sgperfum/src/components/');
define('VIEWS', '/sgperfum/src/views/');

?>