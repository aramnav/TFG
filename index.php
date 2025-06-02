<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KinderGest</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Slider Reseñas -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

</head>
<style>
    .swiper-button-prev,
    .swiper-button-next {
        width: 5%;
        color: white;
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
        font-size: 1.5rem;
        background-size: 100% 100%;
    }


    .testimonial-box {
        max-width: 700px;
        text-align: left;
        padding: 2rem;
        border-radius: 10px;
    }

    #testimonios {
        cursor: grab;
    }

    .cookie-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(6px);
        background-color: rgba(0, 0, 0, 0.2);
        z-index: 1040;
    }

    #cookieModal {
        z-index: 1050;
    }
</style>

<body>
    <?php
    include 'header.php';
    ?>

    <h1>¡Bienvenidos a KinderGest!</h1>

    <div class="container my-4">
        <div id="textoPrincipal" class="bg-primary text-white rounded-4 shadow p-4 p-md-5">
            <p class="text-justify">
                Tu aliado digital en la gestión de escuelas infantiles
            </p>

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

        <div class="container d-flex justify-content-around flex-wrap">

            <div class="card-custom card-wrapper m-3" style="width: 300px; min-height: 320px;">
                <img src="recursos/img/vista-de-angulo-alta-de-dibujo-ninos.webp" class="circle-image" alt="Escuelas infantiles">
                <div class="label-text">Escuelas infantiles</div>
            </div>

            <div class="card-custom card-wrapper m-3" style="width: 300px; min-height: 320px;">
                <img src="recursos/img/maestros-y-estudiantes-de-preescolar-jugando-con-pelotas-sentados-en-el-piso-en-el-jardin-de-infantes.webp" class="circle-image" alt="Guarderías privadas">
                <div class="label-text">Guarderías privadas</div>
            </div>

            <div class="card-custom card-wrapper m-3" style="width: 300px; min-height: 320px;">
                <img src="recursos/img/estudiantes-jugando-con-su-maestro.webp" class="circle-image" alt="Guarderías públicas">
                <div class="label-text">Guarderías públicas</div>
            </div>

        </div>
    </div>

    <section class="container my-5">
        <div class="row align-items-center">

            <div class="col-md-5 mb-4 mb-md-0 text-left" style="padding-right: 100px;">
                <h3 style="color: black;min-width: 300px;"><strong>¿Cual es nuestro propósito?</strong></h3>
                <p class="fs-5" style="color: black;text-align: left;min-width: 300px;">
                    En <strong>KinderGest</strong>, transformamos la gestión de guarderías con herramientas digitales intuitivas y seguras.
                    Nuestro sistema te permite simplificar tareas administrativas, mejorar la comunicación con las familias y dedicar más tiempo a lo que realmente importa:
                    el bienestar y desarrollo de los niños.
                </p>
            </div>

            <div class="col-md-7">
                <div class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="recursos/img/full-shot-kids-playing-together-kindergarten.webp" class="img-fluid rounded border-carousel" alt="Imagen 1">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/group-toddlers-playing-with-toys-crawling-floor-kindergarten.webp" class="img-fluid rounded border-carousel" alt="Imagen 2">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/siblings-playing-with-brain-teaser-toys.webp" class="img-fluid rounded border-carousel" alt="Imagen 3">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/las-manos-del-nino-que-mancho.webp" class="img-fluid rounded border-carousel" alt="Imagen 4">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/ninos-con-las-manos-en-alto.webp" class="img-fluid rounded border-carousel" alt="Imagen 5">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/vista-frontal-del-lindo-hermano-y-hermana-bebe.webp" class="img-fluid rounded border-carousel" alt="Imagen 6">
                        </div>
                        <div class="carousel-item">
                            <img src="recursos/img/vista-de-perfil-de-un-grupo-de-estudiantes-de-preescolar-levantando-la-mano-y-tratando-de-participar-en-la-escuela.webp" class="img-fluid rounded border-carousel" alt="Imagen 7">
                        </div>


                    </div>
                </div>

            </div>
    </section>

    <section class="text-white" style="background-color: #12578e; padding-top: 10px;">
        <div class="container">
            <h2 class="text-center" style="color: white !important;padding: 0px;">Experiencias de nuestros clientes</h2>

            <div id="testimonios" class="swiper mySwiper">
                <div class="swiper-wrapper" style="color: white;">

                    <div class="swiper-slide d-flex justify-content-center">
                        <div class="testimonial-box">
                            <p class="mb-2" style="text-align:left;">⭐️⭐️⭐️⭐️⭐️</p>
                            <h5 class="fw-bold">Excelente herramienta para guarderías</h5>
                            <p class="mb-2" style="text-align:justify">
                                Desde que usamos el sistema de gestión de KinderGest, todo es más fácil: control de
                                asistencia,
                                comunicación con padres, informes y gestión de inscripciones. La plataforma es clara,
                                rápida y el
                                soporte técnico siempre responde. Muy recomendable para cualquier centro infantil.
                            </p>
                            <small class="fst-italic">— Marta, Directora de guardería</small>
                        </div>
                    </div>

                    <div class="swiper-slide d-flex justify-content-center">
                        <div class="testimonial-box">
                            <p class="mb-2" style="text-align:left">⭐️⭐️⭐️⭐️⭐️</p>
                            <h5 class="fw-bold">Una solución integral y fácil de usar</h5>
                            <p class="mb-2" style="text-align:justify">
                                Desde que implementamos KinderGest, la organización diaria de nuestra guardería ha
                                mejorado notablemente.
                                Podemos registrar asistencia, compartir fotos y noticias con las familias, y llevar un
                                control preciso
                                de cada niño. El equipo de soporte es excelente y siempre están disponibles para
                                ayudarnos.
                            </p>
                            <small class="fst-italic">— Luis, Coordinador de centro infantil</small>
                        </div>
                    </div>

                    <div class="swiper-slide d-flex justify-content-center">
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

                    <div class="swiper-slide d-flex justify-content-center">
                        <div class="testimonial-box">
                            <p class="mb-2" style="text-align:left">⭐️⭐️⭐️⭐️⭐️</p>
                            <h5 class="fw-bold">Una herramienta que marca la diferencia</h5>
                            <p class="mb-2" style="text-align:justify">
                                La implementación de KinderGest ha supuesto una gran mejora en nuestros procesos internos.
                                El seguimiento del desarrollo de los niños, está automatizado
                                y accesible. ¡Nos ha ahorrado muchísimo tiempo!
                            </p>
                            <small class="fst-italic">— Sergio, Responsable de gestión</small>
                        </div>
                    </div>

                    <div class="swiper-slide d-flex justify-content-center">
                        <div class="testimonial-box">
                            <p class="mb-2" style="text-align:left">⭐️⭐️⭐️⭐️⭐️</p>
                            <h5 class="fw-bold">Soporte cercano y plataforma estable</h5>
                            <p class="mb-2" style="text-align:justify">
                                Además de ser muy completa, la plataforma de KinderGest cuenta con un equipo de soporte que realmente se
                                implica. Cualquier duda o incidencia se resuelve rápido. Sentimos que estamos acompañados en todo momento.
                            </p>
                            <small class="fst-italic">— Nuria, Coordinadora pedagógica</small>
                        </div>
                    </div>




                </div>

                <div class="swiper-button-prev" style="color:white;"></div>
                <div class="swiper-button-next" style="color:white;"></div>

            </div>
        </div>
    </section>



    <?php
    include 'footer.php';
    ?>

    <!-- COOKIES -->
    <div class="cookie-overlay" id="cookieOverlay"></div>

    <div class="modal fade show d-block" id="cookieModal" tabindex="-1" aria-modal="true" role="dialog" style="background: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title">🍪 ¡Usamos cookies!</h5>
                </div>
                <div class="modal-body">
                    <p>
                        Utilizamos cookies para mejorar tu experiencia en nuestra plataforma de gestión de guarderías.
                        Al continuar navegando, aceptas su uso.
                    </p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn px-4" onclick="aceptarCookies()" style="background-color: #12578e;color:white;">Aceptar</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('cookiesAceptadas')) {
                ocultarCookies();
            }
        });

        function aceptarCookies() {
            localStorage.setItem('cookiesAceptadas', 'true');
            ocultarCookies();
        }

        function ocultarCookies() {
            const modal = document.getElementById('cookieModal');
            const overlay = document.getElementById('cookieOverlay');
            if (modal) modal.remove();
            if (overlay) overlay.remove();
        }
    </script>

</body>

</html>