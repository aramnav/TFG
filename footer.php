<style>
    footer {
        padding-top: 30px;
    }

    p {
        text-align: center;
    }

    ul {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
    }

    li {
        list-style: none;
        padding: 10px;
    }

    .enlaces a {
        text-decoration: none;
        color: white;
        font-weight: bold;
    }

    .enlaces a:hover {
        text-decoration: underline;
    }

    #scrollToTopBtn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background-color: rgb(178, 183, 186);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s, opacity 0.3s;
        z-index: 1000;
    }

    #scrollToTopBtn img {
        width: 60%;
        height: 60%;
    }
</style>

<body>
    <div class="img-footer" style="text-align: center;">
        <img src="recursos/img/img-footer.png" alt="Mascotas" style="width: 60%; ">
    </div>
    <footer>
        <p class="enlaces"><a href="politica_privacidad.php">Política de privacidad</a> | <a href="terminos_uso.php">Términos de uso</a></p>
        <p>&copy; 2025 KinderGest. Todos los derechos reservados.</p>
        <p>¡Siguenos en nuestras redes sociales!</p>
        <ul>
            <li><a href="https://www.facebook.com/"><img src="recursos/icons/facebook.svg" alt="facebook" width="40px" height="40px"></a></li>
            <li><a href="https://www.instagram.com/"><img src="recursos/icons/instagram.svg" alt="instagram" width="40px" height="40px"></a></li>
            <li><a href="https://www.twitter.com/"><img src="recursos/icons/twitter.svg" alt="twitter" width="40px" height="40px"></a></li>
            <li><a href="https://www.youtube.com/"><img src="recursos/icons/youtube.svg" alt="youtube" width="40px" height="40px"></a></li>
        </ul>
        <button class="scrollToTopBtn" id="scrollToTopBtn">
            <img src="recursos/icons/flecha-arriba-negro.svg" alt="Ir arriba" width="24px" height="24px">
        </button>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        const scrollBtn = document.getElementById("scrollToTopBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) {
                scrollBtn.style.display = "flex";
            } else {
                scrollBtn.style.display = "none";
            }
        });

        scrollBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

</body>

</html>