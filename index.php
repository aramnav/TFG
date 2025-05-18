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
        #sliderPrincipal .carousel-item img {
            min-width: 500px;
            max-width: 1000px;
        }
    </style>
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <h2>¡Bienvenidos a KinderGest!</h2>
    <div id="textoPrincipal" class="mx-auto">
        <h4>Tu aliado digital en la gestión de escuelas infantiles</h4>

        <p>En KinderGest, transformamos la forma en que las guarderías y centros infantiles gestionan su día a día. Somos una empresa especializada en el desarrollo de software intuitivo, seguro y completamente adaptado a las necesidades de la educación infantil.

            Sabemos que la organización y el cuidado de los más pequeños es una gran responsabilidad, por eso nuestro objetivo es facilitar el trabajo del personal educativo y administrativo, optimizando procesos como:</p>

        <p class="subrayado">✅ Gestión de matrículas y listas de espera</p>
        <p class="subrayado">✅ Seguimiento del desarrollo y asistencia de los niños</p>
        <p class="subrayado">✅ Comunicación directa con las familias</p>
        <p class="subrayado">✅ Control de pagos, facturación y documentación</p>
        <p class="subrayado">✅ Informes automáticos y seguros con solo unos clics</p>

        <p>Nuestro sistema funciona en la nube, es accesible desde cualquier dispositivo y cuenta con el respaldo de un equipo de expertos en tecnología y educación infantil.
            Ya son muchas las guarderías que confían en nosotros para centrarse en lo más importante: el bienestar y crecimiento de los niños.</p>
    </div>


<div class="container-fluid py-5 text-center" style="background-color: #E7A051; margin-top: 5rem;">
        <h2 class="section-title">Diseñado para:</h2>
        <div class="row justify-content-center g-4">

            <div class="col-md-3 col-sm-6">
                <div class="card-custom card-wrapper">
                    <img src="recursos/img/vista-de-angulo-alta-de-dibujo-ninos.jpg" class="circle-image" alt="Escuelas infantiles">
                    <div class="label-text">Escuelas infantiles</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card-custom card-wrapper">
                    <img src="recursos/img/maestros-y-estudiantes-de-preescolar-jugando-con-pelotas-sentados-en-el-piso-en-el-jardin-de-infantes.jpg" class="circle-image" alt="Guarderías privadas">
                    <div class="label-text">Guarderías privadas</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card-custom card-wrapper">
                    <img src="recursos/img/estudiantes-jugando-con-su-maestro.jpg" class="circle-image" alt="Guarderías públicas">
                    <div class="label-text">Guarderías públicas</div>
                </div>
            </div>

        </div>
    </div>




    <div id="sliderPrincipal" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="recursos/img/full-shot-kids-playing-together-kindergarten.jpg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="recursos/img/group-toddlers-playing-with-toys-crawling-floor-kindergarten.jpg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="recursos/img/siblings-playing-with-brain-teaser-toys.jpg" class="d-block w-100" alt="Imagen 3">
            </div>
        </div>
    </div>
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