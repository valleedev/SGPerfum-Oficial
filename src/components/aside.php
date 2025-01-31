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
                        <a href="<?= VIEWS ?>dashboard.php" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                            <span class="menu-text"> Dashboards </span>
                        </a>
                    </li>

                    <li class="menu-title">NAVEGACIÓN</li>


                    <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class='bx bx-spa'></i></i></span>
                            <span class="menu-text"> Gestion de fragancias </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="<?= VIEWS ?>add_perfume.php" class="menu-link">
                                        <span class="menu-text">Añadir una nueva fragancia</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= VIEWS ?>list_perfumes.php" class="menu-link">
                                        <span class="menu-text">Inventario de fragancias</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    
                    <li class="menu-item">
                        <a href="apps-calendar.html" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bxs-user-account"></i></span>
                            <span class="menu-text"> Clientes </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#menuLayouts" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-layout"></i></span>
                            <span class="menu-text"> Existencias </span>
                        </a>
                        <div class="collapse" id="menuLayouts">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="layout-horizontal.html" class="menu-link">
                                        <span class="menu-text">Horizontal</span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="layout-sidenav-light.html" class="menu-link">
                                        <span class="menu-text">Sidenav Light</span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="layout-sidenav-dark.html" class="menu-link">
                                        <span class="menu-text">Sidenav Dark</span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="layout-topbar-dark.html" class="menu-link">
                                        <span class="menu-text">Topbar Dark</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>