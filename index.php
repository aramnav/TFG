<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KinderGest</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

    </style>
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <h2>¡Bienvenidos a KinderGest!</h2>

    <div class="container my-4">
        <div id="textoPrincipal" class="bg-primary text-white rounded-4 shadow p-4 p-md-5">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Tu aliado digital en la gestión de escuelas infantiles</h4>
            </div>

            <p class="text-justify">
                En <strong>KinderGest</strong>, transformamos la forma en que las guarderías y centros infantiles gestionan su día a día.
                Somos una empresa especializada en el desarrollo de software intuitivo, seguro y completamente adaptado a las
                necesidades de la educación infantil.
            </p>

            <p class="text-justify">
                Sabemos que la organización y el cuidado de los más pequeños es una gran responsabilidad, por eso nuestro objetivo es
                facilitar el trabajo del personal educativo y administrativo, optimizando procesos como:
            </p>

            <!-- GRID RESPONSIVA: 2 columnas en pantallas chicas, 1 en xs -->
            <div class="row">
                <div class="col-12 col-sm-6 mb-3">✅ Gestión de matrículas</div>
                <div class="col-12 col-sm-6 mb-3">✅ Seguimiento del desarrollo y asistencia de los niños</div>
                <div class="col-12 col-sm-6 mb-3">✅ Comunicación directa con las familias</div>
                <div class="col-12 col-sm-6 mb-3">✅ Informes automáticos y seguros con solo unos clics</div>
            </div>

            <p class="text-justify">
                Nuestro sistema funciona en la nube, es accesible desde cualquier dispositivo y cuenta con el respaldo de un equipo
                de expertos en tecnología y educación infantil. Ya son muchas las guarderías que confían en nosotros para centrarse
                en lo más importante: el bienestar y crecimiento de los niños.
            </p>
        </div>
    </div>

    <div class="container-fluid py-5 text-center" style="background-color: #E7A051; margin-top: 5rem;">
        <h2 class="section-title">Diseñado para:</h2>

        <div class="d-flex justify-content-around flex-wrap" style="padding: 0 100px;">

            <div class="card-custom card-wrapper m-3" style="width: 300px; min-height: 320px;">
                <img src="recursos/img/vista-de-angulo-alta-de-dibujo-ninos.jpg" class="circle-image" alt="Escuelas infantiles">
                <div class="label-text">Escuelas infantiles</div>
            </div>

            <div class="card-custom card-wrapper m-3" style="width: 300px; min-height: 320px;">
                <img src="recursos/img/maestros-y-estudiantes-de-preescolar-jugando-con-pelotas-sentados-en-el-piso-en-el-jardin-de-infantes.jpg" class="circle-image" alt="Guarderías privadas">
                <div class="label-text">Guarderías privadas</div>
            </div>

            <div class="card-custom card-wrapper m-3" style="width: 300px; min-height: 320px;">
                <img src="recursos/img/estudiantes-jugando-con-su-maestro.jpg" class="circle-image" alt="Guarderías públicas">
                <div class="label-text">Guarderías públicas</div>
            </div>

        </div>
    </div>

    <section class="container my-5">
        <div class="row align-items-center">

            <div class="col-md-5 mb-4 mb-md-0 text-left" style="padding-right: 200px;">
                <h3 style="color: black;"><strong>¿Cual es nuestro propósito?</strong></h3>
                <p class="fs-5" style="color: black;text-align: left;">
                    En <strong>KinderGest</strong>, transformamos la gestión de guarderías con herramientas digitales intuitivas y seguras.
                    Nuestro sistema te permite simplificar tareas administrativas, mejorar la comunicación con las familias y dedicar más tiempo a lo que realmente importa:
                    el bienestar y desarrollo de los niños.
                </p>
            </div>

            <div class="col-md-7">
                <div class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="recursos/img/full-shot-kids-playing-together-kindergarten.jpg" class="img-fluid rounded border-carousel" alt="Imagen 1">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/group-toddlers-playing-with-toys-crawling-floor-kindergarten.jpg" class="img-fluid rounded border-carousel" alt="Imagen 2">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/siblings-playing-with-brain-teaser-toys.jpg" class="img-fluid rounded border-carousel" alt="Imagen 3">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="text-white py-5" style="background-color: #12578e;">
        <div class="container">
            <h2 class="text-center mb-4" style="color: white !important;">Experiencias de nuestros clientes</h2>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="testimonial-box">
                                <p class="mb-2" style="text-align:left">⭐️⭐️⭐️⭐️⭐️</p>
                                <h5 class="fw-bold">Excelente herramienta para guarderías</h5>
                                <p class="mb-2" style="text-align:justify">
                                    Desde que usamos el sistema de gestión de KinderGest, todo es más fácil: control de asistencia,
                                    comunicación con padres, informes y gestión de inscripciones. La plataforma es clara, rápida y el
                                    soporte técnico siempre responde. Muy recomendable para cualquier centro infantil.
                                </p>
                                <small class="fst-italic">— Marta, Directora de guardería</small>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="testimonial-box">
                                <p class="mb-2" style="text-align:left">⭐️⭐️⭐️⭐️⭐️</p>
                                <h5 class="fw-bold">Una solución integral y fácil de usar</h5>
                                <p class="mb-2" style="text-align:justify">
                                    Desde que implementamos KinderGest, la organización diaria de nuestra guardería ha mejorado notablemente.
                                    Podemos registrar asistencia, compartir fotos y noticias con las familias, y llevar un control preciso
                                    de cada niño. El equipo de soporte es excelente y siempre están disponibles para ayudarnos.
                                </p>
                                <small class="fst-italic">— Luis, Coordinador de centro infantil</small>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="testimonial-box">
                                <p class="mb-2" style="text-align:left">⭐️⭐️⭐️⭐️⭐️</p>
                                <h5 class="fw-bold">Facilita la comunicación con las familias</h5>
                                <p class="mb-2" style="text-align:justify">
                                    Lo que más valoramos de KinderGest es cómo ha mejorado la relación con los padres.
                                    Ahora pueden recibir informes diarios, fotos y mensajes en tiempo real. Es una
                                    herramienta muy intuitiva y segura, que nos ahorra tiempo y mejora la confianza
                                    con las familias.
                                </p>
                                <small class="fst-italic">— Ana, Educadora infantil</small>
                            </div>
                        </div>
                    </div>


                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>



    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
    </script>
</body>

</html>