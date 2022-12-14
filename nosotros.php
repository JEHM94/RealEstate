<?php
require 'includes/app.php';
includeTemplate('header');
?>

<main class="container section">
    <h1>Conoce Sobre Nosotros</h1>

    <div class="aboutus-content">
        <div class="image">
            <picture>
                <source srcset="build/img/nosotros.avif" type="image/avif">
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/nosotros.jpg" alt="Imagen Sobre Nosotros">
            </picture>
        </div> <!-- ,image -->

        <div class="aboutus-text">
            <blockquote>
                25 Años de Experiencia
            </blockquote>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis deleniti consequuntur delectus
                possimus veniam et est eius minus! A, quibusdam? Dolore dolorum similique non quidem nulla accusamus
                explicabo magni excepturi?
                Laudantium non consectetur saepe commodi, similique eius rerum, voluptatibus voluptas, quaerat
                mollitia aliquam nisi et tempore nostrum libero fugit dolor iste praesentium magni cum qui!
                Aspernatur laborum provident ullam amet.</p>

            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. At dignissimos dicta cumque mollitia, hic
                fuga quasi doloremque natus dolorem amet in sed, eum illum eos eius ratione, quae vel voluptatibus!
            </p>
        </div><!-- .aboutus-text -->
    </div> <!-- .aboutus-content -->
</main>

<section class="container section">
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
</section>

<?php
includeTemplate('footer');
?>