<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="shortcut icon" href="recursos/img/Logo_sin_letra_sin_fondo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        .formulario-contacto {
            border: 2px solid #12578e;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            max-width: 600px;
        }

        #mapa {
            height: 500px;
            width: 100%;
            border-top: 3px solid #12578e;
            border-bottom: 3px solid #12578e;
        }

        .btn-primary {
            background-color: #12578e;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0e3f6c;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <h1>Contacto</h1>
    <div class="container px-3">
        <p class="text-justify mx-auto" style="max-width: 600px;">
            <span style="font-size: 20px;">¿Tienes dudas o quieres saber más?</span><br>
            Estaremos encantados de ayudarte. Escríbenos y te responderemos lo antes posible.
        </p>

        <h3 id="formulario" class="text-center mt-4">Formulario de contacto</h3>

        <div class="formulario-contacto mx-auto shadow-sm" style="max-width: 600px;">
            <form>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" id="correo" required style="border: 1px solid #12578e; border-radius: 12px;">
                </div>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje:</label>
                    <textarea class="form-control" id="mensaje" rows="4" required style="border: 1px solid #12578e; border-radius: 12px;"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2" style="font-weight: 600;">Enviar tu mensaje</button>
                </div>
            </form>
        </div>
    </div>


    <div class="container text-center mt-5 mb-4">
        <h3>Nuestros datos de contacto directo</h3>
        <div class="d-flex justify-content-center mt-3">
            <div class="text-start" style="max-width: 400px;">
                <p>📅 Lunes a Viernes de 9:00 a 18:00</p>
                <p>⏱️ Tiempo de respuesta promedio: 24 horas</p>
                <p>📞 +34 600 95 82 12</p>
                <p>📧 info@kindergest.com</p>
            </div>
        </div>
    </div>


    <h3>Atendemos guarderías de toda Andalucía</h3>
    <div id="mapa" class="mb-5"></div>


    <?php include 'footer.php'; ?>

    <script>
        const mapa = L.map('mapa', {
            scrollWheelZoom: false
        }).setView([36.7213, -4.4214], 9);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(mapa);

        L.marker([36.7213, -4.4214]).addTo(mapa)
            .bindPopup("KinderGest Sede Virtual - Málaga")
            .openPopup();

        //SOLO ZOOM CUANDO PULSAMOS EL MAPA
        mapa.on('click', function() {
            mapa.scrollWheelZoom.enable();
        });

        //AL SALIR DE DE LA ZONA DEL MAPA DESACTIVAMOS EL ZOOM
        mapa.on('mouseout', function() {
            mapa.scrollWheelZoom.disable();
        });
    </script>

</body>

</html>