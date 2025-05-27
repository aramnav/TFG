<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nosotros - KinderGest</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .section-bg {
            padding: 60px 20px;
        }

        .icon-box {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .icon-box:hover {
            transform: translateY(-5px);
        }

        .icon-box i {
            font-size: 2rem !important;
            color: #12578e !important;
        }

        .container-max {
            max-width: 1140px;
            margin: auto;
        }

        .hero-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <h1>Sobre nosotros</h1>

    <section class="section-bg py-2 text-center">
        <div class="container container-max">

            <img src="recursos/img/equipo.jpg" alt="Equipo" class="hero-image" style="border: 5px solid #12578e;">

            <p class="lead">En KinderGest, creemos que la educación infantil merece herramientas modernas, accesibles y seguras. Nuestra misión es apoyar a las guarderías y familias con tecnologías que simplifican procesos, fortalecen la comunicación y mejoran el día a día.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container container-max">
            <h3 class="section-title text-center" style="color:#12578e !important">Nuestra Historia</h3>
            <p class="text-center">Nacimos de una necesidad real: apoyar a guarderías en su gestión diaria. Nuestro equipo, formado por desarrolladores, educadores y expertos en gestión, inició este viaje con una visión clara: hacer que la tecnología sea una aliada en la educación infantil.</p>
        </div>
    </section>

    <section class="section-bg">
        <div class="container container-max">
            <h3 class="section-title text-center" style="color:#12578e !important">¿Qué Hacemos?</h3>
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="icon-box text-center">
                        <img src="recursos/icons/user-check.svg" alt="Matriculación y asistencia" style="width:2rem; height:2rem;">
                        <h5 class="mt-3">Matriculación y asistencia</h5>
                        <p>Control eficiente de inscripciones y asistencia diaria.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box text-center">
                        <img src="recursos/icons/users.svg" alt="Gestión del personal" style="width:2rem; height:2rem;">
                        <h5 class="mt-3">Gestión del personal</h5>
                        <p>Organización de horarios y funciones del equipo educativo.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box text-center">
                        <img src="recursos/icons/heart.svg" alt="Seguimiento del niño" style="width:2rem; height:2rem;">
                        <h5 class="mt-3">Seguimiento del niño</h5>
                        <p>Informes diarios y comunicación fluida con las familias.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container container-max">
            <h3 class="section-title text-center" style="color:#12578e !important">Nuestra Visión</h3>
            <p class="text-center">Ser el aliado digital de todas las guarderías que buscan una transformación humana y eficiente a través de la tecnología.</p>

            <h3 class="section-title text-center mt-5">Nuestros Valores</h3>
            <div class="row g-4">

                <div class="col-md-3 col-6">
                    <div class="icon-box text-center">
                        <img src="recursos/icons/handshake.svg" alt="Compromiso" style="width:2rem; height:2rem;">
                        <p><strong>Compromiso</strong></p>
                        <p>Servicio a medida y acompañamiento real.</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="icon-box text-center">
                        <img src="recursos/icons/lightbulb.svg" alt="Innovación" style="width:2rem; height:2rem;">
                        <p><strong>Innovación</strong></p>
                        <p>Mejora constante en cada función y herramienta.</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="icon-box text-center">
                        <img src="recursos/icons/lock.svg" alt="Confianza" style="width:2rem; height:2rem;">
                        <p><strong>Confianza</strong></p>
                        <p>Protegemos tus datos con seguridad avanzada.</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="icon-box text-center">
                        <img src="recursos/icons/hand-holding-heart.svg" alt="Empatía" style="width:2rem; height:2rem;">
                        <p><strong>Empatía</strong></p>
                        <p>Conectamos con las personas que cuidan niños.</p>
                    </div>
                </div>

            </div>

            <h3 class="section-title text-center mt-5" style="color:#12578e !important">Nuestro Compromiso</h3>
            <p class="text-center">Cada guardería es única. Por eso brindamos soluciones personalizadas, soporte cercano y un equipo que camina a tu lado.</p>
            <p class="text-center">En KinderGest trabajamos con pasión, porque sabemos que cada clic en nuestra plataforma ayuda a que un niño crezca, aprenda y descubra.</p>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>