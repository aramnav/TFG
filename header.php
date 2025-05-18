<style>
    header {
        color: black;
        text-align: center;
        border-bottom: 1px solid #2c3e50;
        font-size: large;
    }

    .buscar {
        position: relative;
        max-width: 240px;
        display: flex;
        align-items: center;
    }

    .buscar input {
        width: 0;
        height: 40px;
        padding: 0 20px;
        font-size: 16px;
        color: #222;
        outline: none;
        border: 1px solid black;
        border-radius: 30px;
        transition: all 0.6s ease;
        width: 0;
    }

    .btn-buscar {
        position: absolute;
        right: 0px;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .buscar:hover input,
    .buscar input:focus {
        width: 240px;
        padding-right: 45px;
    }

    #login {
        background-color: #12578E;
        font-weight: 700;
    }
</style>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="recursos/img/Logo_completo_sin_fondo.png" alt="logo" width="100" height="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="d-flex justify-content-between align-items-center w-100">

                        <!-- Menú navegación -->
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sobre nosotros</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#">Precios</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#">Contacto</a>
                            </li>
                        </ul>

                        <!-- Búsqueda y login -->
                        <div class="d-flex align-items-center">
                            <div class="buscar me-3">
                                <input type="text" placeholder="Buscar..." class="form-control form-control-sm" />
                                <div class="btn-buscar ms-2">
                                    <img src="recursos/icons/buscar.svg" alt="lupa" width="20" height="20">
                                </div>
                            </div>
                            <button id="login" class="btn btn-primary" type="button">LOGIN</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</body>