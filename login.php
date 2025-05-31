<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
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

                <form action="" method="POST">
                    <div class="mb-4" style="color: #12578e;">
                        <label for="email" class="form-label fs-5">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" placeholder="Introduce tu correo" required
                            style="border: 1px solid black; border-radius: 10px; font-size: 1.1rem; padding: 0.75rem;">
                    </div>

                    <div class="mb-4" style="color: #12578e; position: relative;">
                        <label for="password" class="form-label fs-5">Contraseña</label>
                        <input type="password" class="form-control form-control-lg" id="password"
                            placeholder="Introduce tu contraseña" required
                            style="border: 1px solid black; border-radius: 10px; font-size: 1.1rem; padding: 0.75rem; padding-right: 40px;">

                        <!-- Icono para mostrar/ocultar contraseña -->
                        <img id="togglePassword" src="recursos/icons/eye.svg" alt="Mostrar contraseña"
                            style="position: absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; width: 24px; height: 24px; user-select: none;">
                    </div>

                    <div class="mb-3 text-center">
                        <a href="#" class="small" style="color: #12578e;">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn px-5 py-3 w-100" style="background-color: #12578e; color: white; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem;">
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
    </script>

</body>

</html>