<?php
session_start();
include_once '../../config.php'; 

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
$title = 'Usuarios | SGPERFUM';
include '../../global_components/head.php'; 
?>


<body>

    <!-- Begin page -->
    <div class="layout-wrapper">
        <?php include '../../global_components/aside.php' ?>
        
        <div class="page-content">
            <?php 
                include '../../global_components/header.php';
                $title = 'Usuarios';
                $page = 'Listado de Usuarios';
                $extraPage = 'Navegación';
                include '../../global_components/starter.php';
                include '../components/table_users.php';
                include '../../global_components/footer.php' 
            ?>
        </div>
                <!--Modal Success-->
        <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-success">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="bx bx-check-double h1 text-white"></i>
                            <h4 class="mt-2 text-white">Perfume añadido correctamente!</h4>
                            <p class="mt-3 text-white">El perfume se ha almacenado en la base de datos exitosamente</p>
                            <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal Error-->
        <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="bx bx-aperture h1 text-white"></i>
                            <h4 class="mt-2 text-white">Oh No!</h4>
                            <p class="mt-3 text-white">Algo ha salido mal al añadir el perfume vuelve a intentarlo.</p>
                            <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
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
    <script>
        document.getElementById("createUserForm").addEventListener("submit", function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);
            // Realizamos la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?= USERS_BL ?>create_user.php", true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var mySecondModal = new bootstrap.Modal(document.getElementById('success-alert-modal'));
                        mySecondModal.show();
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Recargar después de 2 segundos
                    } else {
                        var mySecondModal = new bootstrap.Modal(document.getElementById('danger-alert-modal'));
                        mySecondModal.show();
                    }
                } else {
                    console.error("Error: " + xhr.status);
                }
                document.getElementById("createUserForm").reset();
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>