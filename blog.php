<?php
require 'includes/functions.php';
includeTemplate('header');
?>

<main class="container section center-content">
    <h1>Nuestro Blog</h1>

    <article class="blog-post">
        <div class="image">
            <picture>
                <source srcset="build/img/blog1.avif" type="image/avif">
                <source srcset="build/img/blog1.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/blog1.jpg" alt="Imagen de entrada de Blog">
            </picture>
        </div> <!-- .image -->

        <div class="blog-text">
            <a href="entrada.php">
                <h4>Terraza en el techo de tu casa</h4>
                <p class="meta-info">Escrito el <span>09/12/2022</span> por <span>Admin</span></p>

                <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y
                    ahorrando dinero</p>
            </a>
        </div> <!-- .blog-text -->
    </article> <!-- .blog-post -->

    <article class="blog-post">
        <div class="image">
            <picture>
                <source srcset="build/img/blog2.avif" type="image/avif">
                <source srcset="build/img/blog2.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/blog2.jpg" alt="Imagen de entrada de Blog">
            </picture>
        </div> <!-- .image -->

        <div class="blog-text">
            <a href="entrada.php">
                <h4>Guía para la decoración de tu hogar</h4>
                <p class="meta-info">Escrito el <span>09/12/2022</span> por <span>Admin</span></p>

                <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para
                    darle vida a hogar</p>
            </a>
        </div> <!-- .blog-text -->
    </article> <!-- .blog-post -->

    <article class="blog-post">
        <div class="image">
            <picture>
                <source srcset="build/img/blog3.avif" type="image/avif">
                <source srcset="build/img/blog3.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/blog3.jpg" alt="Imagen de entrada de Blog">
            </picture>
        </div> <!-- .image -->

        <div class="blog-text">
            <a href="entrada.php">
                <h4>Terraza en el techo de tu casa</h4>
                <p class="meta-info">Escrito el <span>09/12/2022</span> por <span>Admin</span></p>

                <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y
                    ahorrando dinero</p>
            </a>
        </div> <!-- .blog-text -->
    </article> <!-- .blog-post -->

    <article class="blog-post">
        <div class="image">
            <picture>
                <source srcset="build/img/blog4.avif" type="image/avif">
                <source srcset="build/img/blog4.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/blog4.jpg" alt="Imagen de entrada de Blog">
            </picture>
        </div> <!-- .image -->

        <div class="blog-text">
            <a href="entrada.php">
                <h4>Guía para la decoración de tu hogar</h4>
                <p class="meta-info">Escrito el <span>09/12/2022</span> por <span>Admin</span></p>

                <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para
                    darle vida a hogar</p>
            </a>
        </div> <!-- .blog-text -->
    </article> <!-- .blog-post -->
</main>

<?php
includeTemplate('footer');
?>