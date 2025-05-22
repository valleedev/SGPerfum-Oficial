<?php
// Asegúrate de iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario_id = $_SESSION['usuario_id']; 
$usuario = obtenerDatosUsuario($con, $usuario_id);
if (!$usuario) {
    echo "Error al obtener los datos del usuario.";
    exit;
}
//Obtener el rol id
$user_rol = $usuario['rol_id'];
?>
<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="<?= SRC ?>dashboard/views/dashboard.php" class="logo-light">
            <img src="<?= ASSETS ?>images/logo-light.png" alt="logo" class="logo-lg" height="28">
            <img src="<?= ASSETS ?>images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="<?= SRC ?>dashboard/views/dashboard.php" class="logo-dark">
            <img src="<?= ASSETS ?>images/logo-dark.png" alt="dark logo" class="logo-lg" height="28">
            <img src="<?= ASSETS ?>images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">MENU</li>

            <li class="menu-item">
                <a href="<?= DASH_VIEWS ?>dashboard.php" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                </a>
            </li>

            <li class="menu-title">NAVEGACIÓN</li>

            <li class="menu-item">
                <a href="<?= SALE_VIEWS ?>sales.php" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class='bx bx-money-withdraw'></i></span>
                    <span class="menu-text"> Ventas </span>
                </a>
            </li>

            <?php if ($user_rol == 1): ?>
                <!-- Mostrar todos los links para rol 1 -->
                <li class="menu-item">
                    <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class='bx bx-spa'></i></span>
                        <span class="menu-text"> Gestion de fragancias </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuExpages">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="<?= PERF_VIEWS ?>add_perfume.php" class="menu-link">
                                    <span class="menu-text">Añadir una nueva fragancia</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?= PERF_VIEWS ?>list_perfumes.php" class="menu-link">
                                    <span class="menu-text">Inventario de fragancias</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item"> 
                    <a href="<?= USERS_VIEWS ?>users.php" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class='bx bx-user'></i></span>
                        <span class="menu-text"> Usuarios </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bxs-report"></i></span>
                        <span class="menu-text"> Reportes </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuIcons">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="<?= REPORTS_VIEWS ?>users_reports.php" class="menu-link">
                                    <span class="menu-text">Por vendedor</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php else: ?>
                <!-- Mostrar solo la mitad de los links para otros roles -->
                <li class="menu-item"> 
                    <a href="<?= PERF_VIEWS ?>list_perfumes.php" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class='bx bx-spa'></i></span>
                        <span class="menu-text"> Inventario de fragancias </span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>