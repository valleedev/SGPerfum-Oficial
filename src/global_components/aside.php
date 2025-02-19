<div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="<?= SRC ?>views/dashboard.php" class="logo-light">
                    <img src="<?= ASSETS ?>images/logo-light.png" alt="logo" class="logo-lg" height="28">
                    <img src="<?= ASSETS ?>images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.html" class="logo-dark">
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
                        <a href="<?= VIEWS ?>sales.php" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class='bx bx-money-withdraw'></i></span>
                            <span class="menu-text"> Ventas </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class='bx bx-spa'></i></i></span>
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
                        <a href="<?= VIEWS ?>users.php" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class='bx bx-user'></i></span>
                            <span class="menu-text"> Usuarios </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>