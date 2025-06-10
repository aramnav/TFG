<?php
//Si no se ha iniciado la sesión, iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proceso logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}


?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif !important;
        font-weight: 600 !important;
    }

    header {
        border-bottom: 1px solid #000;
        padding: 20px 0;
        background-color: white;
        position: relative;
    }

    .navbar-brand img {
        z-index: 15;
        position: relative;
        width: 120px;
        height: 120px;
    }

    .buscar {
        position: relative;
        max-width: 280px;
        display: flex;
        align-items: center;
        z-index: 10;
    }

    .buscar input {
        height: 44px;
        padding: 0 24px;
        font-size: 18px;
        color: #222;
        outline: none;
        border: 1px solid black;
        border-radius: 30px;
        transition: all 0.6s ease;
        width: 0;
        background-color: white;
    }

    .btn-buscar {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        z-index: 2;
    }


    .buscar:hover input,
    .buscar input:focus {
        width: 280px;
        padding-right: 50px;
    }

    #login {
        background-color: #12578E;
        font-weight: 700;
        color: white;
        font-size: 18px;
        padding: 10px 20px;
        border-radius: 6px;
    }

    .navbar-nav .nav-link {
        font-size: 18px;
        padding: 10px 15px;
    }

    @media (max-width: 991.98px) {
        .navbar {
            position: relative;
        }

        .navbar-collapse {
            position: absolute !important;
            top: calc(100% + 1px);
            left: 0;
            width: 100%;
            background: white;
            z-index: 20;
            padding: 1rem 1rem 1.5rem 1rem;
            border-top: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand-centered {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 25;
        }

        .navbar-collapse .buscar {
            margin-top: 1rem;
            width: 100%;
            max-width: 100%;
            justify-content: center;
        }

        .buscar:hover input,
        .buscar input:focus {
            width: 100%;
            padding-right: 45px;
        }

        .buscar input {
            width: 100%;
            transition: none;
            font-size: 18px;
            height: 44px;
        }

        .navbar-nav .nav-link {
            font-size: 20px;
            padding: 12px 15px;
        }

        #login {
            font-size: 14px;
            padding: 6px 12px;
        }

    }

    @media (max-width: 991.98px) {
        .dropdown-toggle {
            max-width: 120px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    }
</style>



<header>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid align-items-center px-3 position-relative">
            <button class="navbar-toggler order-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand mx-auto navbar-brand-centered order-2 order-lg-1" href="index.php">
                <img src="recursos/img/Logo_completo_sin_fondo.png" alt="logo" width="100" height="100">
            </a>

            <div class="d-flex align-items-center ms-auto order-3 order-lg-4">
                <div class="buscar d-none d-lg-flex me-3">
                    <input type="text" placeholder="Buscar..." class="form-control form-control-sm" />
                    <div class="btn-buscar">
                        <img src="recursos/icons/buscar.svg" alt="lupa" width="20" height="20">
                    </div>
                </div>
                <?php if (isset($_SESSION['usuario']['nombre'])): ?>

                    <div class="dropdown ms-lg-2">
                        <button class="btn dropdown-toggle d-flex align-items-center px-3 py-2"
                            style="background-color: #12578E; color: white; border-radius: 6px; font-size: 16px;"
                            type="button"
                            id="dropdownUsuario"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                        </button>


                        <ul class="dropdown-menu dropdown-menu-end py-2" aria-labelledby="dropdownUsuario" style="margin-top: 0.25rem;">
                            <?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="vista_admin.php">Panel de administración</a></li>
                            <?php elseif ($_SESSION['usuario']['rol'] === 'profesor'): ?>
                                <li><a class="dropdown-item" href="vista_profe.php">Pasar lista</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="vista_padre.php">Perfil</a></li>
                            <?php endif; ?>
                            <li>
                                <form action="" method="post" class="m-0">
                                    <button type="submit" name="logout" class="dropdown-item text-danger">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>


                    </div>
                <?php else: ?>
                    <a href="login.php">
                        <button id="login" class="btn btn-sm ms-lg-2" style="background-color: #12578E; color: white; font-size: 16px; border-radius: 6px;">
                            LOGIN
                        </button>
                    </a>
                <?php endif; ?>

            </div>

            <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
                <ul class="navbar-nav mx-lg-4">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'sobre_nosotros.php' ? 'active' : ''; ?>" href="sobre_nosotros.php">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'precios.php' ? 'active' : ''; ?>" href="precios.php">Precios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contacto.php' ? 'active' : ''; ?>" href="contacto.php">Contacto</a>
                    </li>
                </ul>

                <div class="buscar d-lg-none mt-3">
                    <input type="text" placeholder="Buscar..." class="form-control form-control-sm" />
                    <div class="btn-buscar">
                        <img src="recursos/icons/buscar.svg" alt="lupa" width="20" height="20">
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>