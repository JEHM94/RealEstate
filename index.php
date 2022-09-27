<?php
require 'includes/functions.php';
includeTemplate('header', $isIndex = true);
?>

<main class="container section">
    <h1>Más Sobre Nosotros</h1>

    <div class="about-us-icons">
        <div class="icon">
            <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga optio eum nisi maiores possimus
                corrupti ut nam deleniti voluptatem architecto aliquam voluptatibus, nihil sequi, iste nostrum,
                accusantium vel ipsam assumenda.</p>
        </div> <!-- .icon -->

        <div class="icon">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga optio eum nisi maiores possimus
                corrupti ut nam deleniti voluptatem architecto aliquam voluptatibus, nihil sequi, iste nostrum,
                accusantium vel ipsam assumenda.</p>
        </div> <!-- .icon -->

        <div class="icon">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>A Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga optio eum nisi maiores possimus
                corrupti ut nam deleniti voluptatem architecto aliquam voluptatibus, nihil sequi, iste nostrum,
                accusantium vel ipsam assumenda.</p>
        </div> <!-- .icon -->
    </div>
</main>

<section class="section container for-sale-section">
    <h2>Casas y Departamentos</h2>

    <?php
    $propertyLimit = 3;
    include 'includes/templates/forsale.php';
    ?>

    <div class="align-right show-all">
        <a href="anuncios.php" class="button-green">Ver todas</a>
    </div>
</section>

<section class="contact-image">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto a la brevedad</p>
    <a href="contacto.php" class="button-yellow">Contáctanos</a>
</section>

<div class="container section bottom-section">
    <section class="blog">
        <h3>Nuestro Blog</h3>

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
    </section>

    <section class="feedbacks">
        <h3>Testimonios</h3>

        <div class="feedback">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron
                cumple con todas mis expectativas.
            </blockquote>
            <p>- Jesús Hamel</p>
        </div> <!-- .feedback -->
    </section> <!-- .feedbacks -->
</div>

<?php
includeTemplate('footer');
?>