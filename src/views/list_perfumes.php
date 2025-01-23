<?php
session_start();
include '../config.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id']; 
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $usuario = $result->fetch_assoc(); // Obtener los datos del usuario
} else {
    echo "Error al obtener los datos del usuario.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Inventario | SGPERFUM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Administrador de perfumeria" name="description" />
    <meta content="Sebastian Valle" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= ASSETS ?>images/favicon.ico">

    <link href="<?= ASSETS ?>libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?= ASSETS ?>css/style.min.css" rel="stylesheet" type="text/css">
    <link href="<?= ASSETS ?>css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="<?= ASSETS ?>js/config.js"></script>
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">
        <?php include '../components/aside.php' ?>
        
        <div class="page-content">
        
            <?php 
                include '../components/header.php' ;
                $title = 'Inventario de fragancias';
                $page = 'Inventario fragancias';
                $extraPage = 'Gestion de fragancias';
                include '../components/starter.php';
                ?>
                <div class="row p-3 flex">
                    <?php include '../business_logic/perfumes/catalog_products.php'; ?>
                </div>
                <?php
                include '../components/footer.php' 
                ?>
        </div>
    <!-- App js -->
    <script src="../../public/assets/js/vendor.min.js"></script>
    <script src="../../public/assets/js/app.js"></script>

    <!-- Knob charts js -->
    <script src="../../public/assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <!-- Sparkline Js-->
    <script src="../../public/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="../../public/assets/libs/morris.js/morris.min.js"></script>

    <script src="../../public/assets/libs/raphael/raphael.min.js"></script>

    <!-- Dashboard init-->
    <script src="../../public/assets/js/pages/dashboard.js"></script>
</body>

</html>