<?php
session_start();
require 'const/conexion.php';

$error = "";

if (isset($_POST['btnLogin'])) {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // CONSULTA BD
    $consulta = "SELECT * FROM usuarios WHERE email = ? AND activo = 1 LIMIT 1";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$email]);
    $resultado = $sentencia->get_result();
    $usuario = $resultado->fetch_assoc();

    var_dump($usuario);

    //COMPRUEBA CONTRASEÑA Y REDIRECCIONA
    if (!$usuario) {
        $error = "Usuario o contraseña incorrectos.";
    } else if ($usuario['activo'] == 0) {
        $error = "Tu cuenta está bloqueada. Contacta con el administrador.";
    } else {
        if (password_verify($password, $usuario['contrasenya'])) {
            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol'] = $usuario['rol'];
            $_SESSION['LAST_ACTIVITY'] = time();

            switch ($usuario['rol']) {
                case 'admin':
                    header("Location: vista_admin.php");
                    break;
                case 'profesor':
                    header("Location: vista_profe.php");
                    break;
                default:
                    header("Location: vista_padre.php");
            }
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
</style>

<body>
    <?php
    include 'header.php';
    ?>

    <h1 style="padding: 20px;">Iniciar Sesión</h1>
    <div class="container-fluid position-relative p-0" style="min-height: 100vh; background: url('recursos/img/foto_login.webp') no-repeat center center; background-size: cover;">

        <div class="position-absolute start-50 translate-middle-x w-100 d-flex justify-content-center px-3" style="top: 5%;">
            <div class="bg-white p-5 rounded shadow w-100" style="max-width: 500px;">
                <!-- Mensaje de sesión expirada -->
                <?php if (isset($_GET['expirada']) && $_GET['expirada'] == 1): ?>
                    <div class="alert alert-warning text-center mt-3" role="alert">
                        Tu sesión ha expirado por inactividad.
                    </div>
                <?php endif; ?>

                <!-- Mensaje de error -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-4" style="color: #12578e;">
                        <label for="email" class="form-label fs-5">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Introduce tu correo" required
                            style="border: 1px solid black; border-radius: 10px; font-size: 1.1rem; padding: 0.75rem;" value="<?= htmlspecialchars($email ?? '') ?>">
                    </div>

                    <div class="mb-4" style="color: #12578e; position: relative;">
                        <label for="password" class="form-label fs-5">Contraseña</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Introduce tu contraseña" required
                            style="border: 1px solid black; border-radius: 10px; font-size: 1.1rem; padding: 0.75rem; padding-right: 40px;">

                        <!-- Icono para mostrar/ocultar contraseña -->
                        <img id="togglePassword" src="recursos/icons/eye.svg" alt="Mostrar contraseña"
                            style="position: absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; width: 24px; height: 24px; user-select: none;">
                    </div>

                    <!-- <div class="mb-3 text-center">
                        <a href="#" class="small" style="color: #12578e;">¿Olvidaste tu contraseña?</a>
                    </div> -->

                    <button type="submit" name="btnLogin" class="btn px-5 py-3 w-100" style="background-color: #12578e; color: white; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem;">
                        Acceder
                    </button>
                </form>
            </div>
        </div>

    </div>


    <?php
    include 'footer.php';
    ?>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const isPassword = password.getAttribute('type') === 'password';
            password.setAttribute('type', isPassword ? 'text' : 'password');

            // Cambia la imagen
            this.src = isPassword ? 'recursos/icons/eye-slash.svg' : 'recursos/icons/eye.svg';
            this.alt = isPassword ? 'Ocultar contraseña' : 'Mostrar contraseña';
        });

        //Cierra el mensaje de sesión expirada después de 3 segundos
        const params = new URLSearchParams(window.location.search);
        if (params.has('expirada')) {
            setTimeout(() => {
                window.history.replaceState({}, document.title, window.location.pathname);
            }, 3000);
        }
    </script>

</body>

</html>