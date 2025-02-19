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
define('COMP', '/sgperfum/src/components/');
define('VIEWS', '/sgperfum/src/views/');

?>