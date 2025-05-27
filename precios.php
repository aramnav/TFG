<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precios</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .lista-vertical {
        display: block !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style-type: disc !important;
    }

    .lista-vertical li {
        padding: 0 !important;
    }

    .card-custom {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        min-height: 400px;
        padding: 20px;
        border-radius: 17px;
        transition: transform 0.2s ease;
    }

    .card-custom:hover .btn {
        filter: brightness(90%);
        transform: scale(1.05);
    }

    .card-body-custom h5,
    .card-body-custom span,
    .card-body-custom ul {
        margin: 0 0 10px 0;
        padding: 0;
    }

    .card-body-custom ul {
        list-style-type: disc;
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .card-body-custom {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .card-custom {
            min-height: 500px;
        }
    }
</style>

<body>
    <?php include 'header.php'; ?>
    <h1>Precios</h1>

    <section class="py-3 text-center" style="background-color: white;">
        <div class="container">
            <p class="mb-3 text-justify">
                En KinderGest, sabemos que cada guardería es única, por eso ofrecemos planes flexibles que se
                adaptan a las necesidades reales de tu centro. Ya seas una pequeña guardería familiar o una red
                de centros infantiles, tenemos una solución pensada para ti.</br>
                Nuestros planes incluyen soporte técnico, formación inicial, actualizaciones constantes y
                todas las herramientas necesarias para gestionar tu centro de manera eficiente y segura.
            </p>
        </div>
    </section>

    <section class="py-4" style="background-color: #12578e; padding-bottom: 50px;">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Planes</h2>
            <div class="row justify-content-center g-4">

                <div class="col-md-4">
                    <div class="card-custom" style="background-color: white; border: 10px solid #F28B82;">
                        <div class="card-body-custom" style="color: #F28B82;">
                            <h5 class="fw-bold text-center" style="color: #F28B82;">Plan Esencial</h5>
                            <span>Incluye:</span>
                            <ul class="lista-vertical">
                                <li>✔️ Gestión de alumnos y fichas personalizadas</li>
                                <li>✔️ Control de asistencia</li>
                                <li>✔️ Comunicación básica con las familias</li>
                                <li>✔️ Informes diarios automatizados</li>
                                <li>✔️ Soporte por email</li>
                            </ul>
                            <div class="text-center mt-auto">
                                <a href="contacto.php#formulario" class="btn" style="background-color: #F28B82; color:white; padding:10px 25px; font-weight: bold;">Más información</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-custom" style="background-color: white; border: 10px solid #A3D9A5;">
                        <div class="card-body-custom" style="color: #A3D9A5;">
                            <h5 class="fw-bold text-center" style="color: #A3D9A5;">Plan Profesional</h5>
                            <span>Incluye todo lo del plan Esencial, y además:</span>
                            <ul class="lista-vertical">
                                <li>✔️ Gestión de personal y horarios</li>
                                <li>✔️ Envío de notificaciones y fotos a las familias</li>
                                <li>✔️ Registro de alimentación, siestas y rutinas</li>
                                <li>✔️ Generación de facturas y pagos</li>
                                <li>✔️ Acceso multiusuario con roles</li>
                            </ul>
                            <div class="text-center mt-auto">
                                <a href="contacto.php#formulario" class="btn" style="background-color: #A3D9A5; color:white; padding:10px 25px; font-weight: bold;">Más información</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-custom" style="background-color: white; border: 10px solid #AEDFF7;">
                        <div class="card-body-custom" style="color: #AEDFF7;">
                            <h5 class="fw-bold text-center" style="color: #AEDFF7;">Plan Premium</h5>
                            <span>Incluye todo lo del plan Profesional, y además:</span>
                            <ul class="lista-vertical">
                                <li>✔️ Panel de administración para varios centros</li>
                                <li>✔️ Personalización avanzada de informes y etiquetas</li>
                                <li>✔️ Integración con página web del centro</li>
                                <li>✔️ Soporte prioritario (teléfono y chat)</li>
                                <li>✔️ Copias de seguridad diarias</li>
                            </ul>
                            <div class="text-center mt-auto">
                                <a href="contacto.php#formulario" class="btn" style="background-color: #AEDFF7; color:white; padding:10px 25px; font-weight: bold;">Más información</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center">
                    <h5 class="fw-bold mb-3" style="color: #12578e;">🧩 ¿Tienes necesidades específicas?</h5>

                    <p class="mx-auto text-justify" style="max-width: 500px; font-size: 1.05rem; line-height: 1.6; color: #333;">
                        Ofrecemos planes a medida para centros con requisitos particulares, integraciones
                        personalizadas o mayor número de usuarios. Cuéntanos tu caso y diseñaremos una solución
                        a tu medida.
                    </p>

                    <a href="contacto.php#formulario" class="btn mt-3" style="background-color:#12578e; color:white; font-weight: bold; padding:10px 25px; border-radius: 8px;">¡Contáctanos!</a>
                </div>


                <div class="col-md-6 text-center">
                    <h5 class="fw-bold" style="color: #12578e;">Todos los planes incluyen:</h5>
                    <ul class="lista-vertical text-start">
                        <li>✅ Cumplimiento de la normativa de protección de datos (GDPR)</li>
                        <li>✅ Plataforma segura en la nube</li>
                        <li>✅ Sin permanencia, puedes cancelar en cualquier momento</li>
                        <li>✅ Actualizaciones incluidas sin coste adicional</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>