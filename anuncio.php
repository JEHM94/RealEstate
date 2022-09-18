<?php include 'includes/templates/header.php'; ?>

    <main class="container section center-content">
        <h1>Casa Frente al Bosque</h1>

        <picture>
            <source srcset="build/img/destacada.avif" type="image/avif">
            <source srcset="build/img/destacada.webp" type="image/webp">
            <img loading="lazy" width="200" height="300" src="build/img/destacada.jpg" alt="Imagen de la Propiedad">
        </picture>

        <div class="property-details">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione minus consequatur voluptate. Voluptates
                architecto sit sequi excepturi suscipit, dolorum amet sapiente tempora esse modi maiores, reprehenderit,
                voluptatibus facilis ad voluptas.
                Nam aut similique ut repellendus, quasi fugiat mollitia impedit, quo corrupti consequatur recusandae
                dolore! Adipisci rem fuga, ea illum exercitationem veniam maxime saepe perferendis voluptatem nostrum
                corrupti! Fugiat, non ut?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam sed quo eveniet amet? Aut, nobis dolore
                deserunt ipsam sed veniam incidunt distinctio officiis maxime! Iure aspernatur repellat quisquam debitis
                fugit.</p>

            <p class="for-sale-price">$3,000,000</p>

            <ul class="icons-info detailed">
                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                    <p>3</p>
                </li>

                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                    <p>3</p>
                </li>

                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                    <p>4</p>
                </li>
            </ul>
        </div> <!-- .property-details -->
    </main>

    <footer class="section footer">
        <div class="container footer-container">
            <div class="container ">
                <nav class="navigation nav-footer">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                </nav>
            </div>

            <p class="copyright">Todos los derechos reservados. 2022&copy;</p>
        </div>
    </footer>

    <script src="build/js/bundle.min.js"></script>
</body>

</html>