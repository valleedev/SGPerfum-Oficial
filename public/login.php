<?php require '../src/config.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPERFUM INGRESO</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="<?= ASSETS ?>css/style.min.css" rel="stylesheet" type="text/css">
    <link href="<?= ASSETS ?>css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="<?= ASSETS ?>js/config.js"></script>
</head>
<body class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a href="#" class="logo-dark">
                                <span><img src="<?= ASSETS ?>images/logo-dark.png" alt="" height="22"></span>
                            </a>

                            <a href="#" class="logo-light">
                                <span><img src="<?= ASSETS ?>images/logo-light.png" alt="" height="22"></span>
                            </a>
                        </div>

                        <form action="login_process.php" method="post">

                            <div class="form-group mb-3">
                                <label class="form-label" for="emailaddress">Gmail</label>
                                <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Ingrese su Correo">
                            </div>

                            <div class="form-group mb-3">
                                <a href="pages-recoverpw.html" class="text-muted float-end"><small></small></a>
                                <label class="form-label" for="password">Contraseña</label>
                                <input class="form-control" name="password" type="password" required="" id="password" placeholder="Ingrese su Contraseña">
                            </div>

                            <div class="form-group mb-3">
                                <div class="">
                                    <input class="form-check-input" type="checkbox" id="checkbox-signin" checked>
                                    <label class="form-check-label ms-2" for="checkbox-signin">Recordarme</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-100" type="submit"> Ingresar </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50"> <a href="pages-register.html" class="text-white-50 ms-1">Haz olvidado tu contraseña?</a></p>
                        <p class="text-white-50">No tienes Cuenta? <a href="pages-register.html" class="text-white font-weight-medium ms-1">Contáctanos</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <script src="<?= ASSETS ?>js/vendor.min.js"></script>
    <script src="<?= ASSETS ?>js/app.js"></script>
</body>
</html>