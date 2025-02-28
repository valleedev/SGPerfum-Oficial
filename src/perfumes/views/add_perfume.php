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
$title = 'Añadir Fragancias | SGPERFUM';
include '../../global_components/head.php'; 
?>


<body>

    <!-- Begin page -->
    <div class="layout-wrapper">
        <?php include '../../global_components/aside.php' ?>
        
        <div class="page-content">
        
            <?php 
                include '../../global_components/header.php' ;
                $title = 'Añadir una fragancia nueva';
                $page = 'Añadir una nueva fragancia';
                $extraPage = 'Gestion de perfumes';
                include '../../global_components/starter.php';
                // Formulario
                include '../components/form.php' ;
                $inputs = [
                    ['label' => 'Código', 'name' => 'keyB', 'type' => 'number', 'col' => 'col-md-2'],
                    ['label' => 'Nombre', 'name' => 'name', 'type' => 'text', 'col' => 'col-md-10'],
                    ['label' => 'Casa', 'name' => 'house', 'type' => 'text', 'col' => 'col-md-6'],
                    ['label' => 'Familia Olfativa', 'name' => 'familyO', 'type' => 'text', 'col' => 'col-md-6'], 
                    ['label' => 'Genero', 'name' => 'gender', 'type' => 'select', 'col' => 'col-md-6', 'options' => ['Masculino', 'Femenino', 'Unisex']],
                    ['label' => 'Gramos', 'name' => 'size', 'type' => 'number', 'col' => 'col-md-6'],
                    ['label' => 'imagen', 'name' => 'image', 'type' => 'file', 'col' => 'col-md-12'],
                ];
                generateForm('create_perfumes.php', $inputs, 'Añadir Perfume', 'Añadir');
                //Footer
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
        document.getElementById("form").addEventListener("submit", function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);
            // Realizamos la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?= PERF_BL ?>create_perfumes.php", true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var myModal = new bootstrap.Modal(document.getElementById('success-alert-modal'));
                    myModal.show();
                    document.getElementById("form").reset();
                } else {
                    var mySecondModal = new bootstrap.Modal(document.getElementById('danger-alert-modal'));
                    mySecondModal.show();
                    document.getElementById("form").reset();
                }
            }; 

            xhr.send(formData);
        });

        document.getElementById('image').addEventListener('change', (event) =>{
        const imgPermitidas = ['image/jpg', 'image/jpeg', 'image/jfif', 'image/pjpeg', 'image/pjp', 'image/png'];
        const permitidasUsuario = ['jpg', 'jpeg', 'jfif', 'pjpeg', 'pjp', 'png'];
        let file = event.target.files;

        for (let i = 0; i < file.length; i++){
            if (file && !(imgPermitidas.includes(file[i].type))){
            alert('No se permite el tipo de imagen seleccionado.');
            alert('Lista de tipos de imagenes permitidas \n '+permitidasUsuario);
            event.target.value = '';
            break;
            }
        }
    });
    </script>
</body>

</html>