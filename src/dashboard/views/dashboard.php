<?php
session_start();
include '../../config.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id']; 
$usuario = obtenerDatosUsuario($con, $usuario_id);
if (!$usuario) {
    echo "Error al obtener los datos del usuario.";
    exit;
}

// HEADER
$title = 'Dashboard | SGPERFUM';
include '../../global_components/head.php'; 
?>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">
        <?php include '../../global_components/aside.php' ?>
        
        <div class="page-content">
            <?php include "../../global_components/header.php";
                $title = 'Dashboard';
                $page = 'Dashboard';
                $extraPage = 'SGPERFUM';
                include '../../global_components/starter.php';
                include '../business_logic/reportes_logic.php';
                include '../components/cards_general_report.php';
                include '../components/sales_today.php';
                include '../../global_components/footer.php';
            ?>
            
        </div>
    </div>

    <!-- App js -->
    <script src="../../../public/assets/js/vendor.min.js"></script>
    <script src="../../../public/assets/js/app.js"></script>

    <!-- Knob charts js -->
    <script src="../../../public/assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <!-- Sparkline Js-->
    <script src="../../../public/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="../../../public/assets/libs/morris.js/morris.min.js"></script>

    <script src="../../../public/assets/libs/raphael/raphael.min.js"></script>

    <!-- Dashboard init-->
    <script src="../../../public/assets/js/pages/dashboard.js"></script>

</body>

</html>