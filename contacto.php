<?php include 'includes/templates/header.php'; ?>

    <main class="container section">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.avif" type="image/avif">
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <img loading="lazy" width="200" height="300" src="build/img/destacada3.jpg" alt="Imagen Página de Contacto">
        </picture>

        <h2>Llene el formulario de Contacto</h2>

        <form action="#" class="form center-content container">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="inputName">Nombre</label>
                <input id="inputName" type="text" placeholder="Jesús Hamel">

                <label for="inputEmail">E-mail</label>
                <input id="inputEmail" type="email" placeholder="correo@email.com">

                <label for="inputPhone">Teléfono</label>
                <input id="inputPhone" type="tel" placeholder="+581234567">

                <label for="inputMessage">Mensaje</label>
                <textarea id="inputMessage"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <label for="selectOptions">Quiero</label>
                <select id="selectOptions">
                    <option value="" disabled selected>-Seleccionar-</option>
                    <option value="Buy">Comprar</option>
                    <option value="Sell">Vender</option>
                </select>

                <label for="inputAmount">Mi Presupuesto / Precio ($)</label>
                <input id="inputAmount" type="number" placeholder="$100,000" min="0">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Deseo ser contactado por:</p>

                <div class="contact-by">
                    <label for="radioPhone">Teléfono</label>
                    <input id="radioPhone" name="contact-by" type="radio" value="phone">

                    <label for="radioEmail">E-mail</label>
                    <input id="radioEmail" name="contact-by" type="radio" value="email">
                </div>

                <p>El día:</p>
                <label for="inputDate">Fecha</label>
                <input id="inputDate" type="date">

                <p>A las:</p>
                <label for="inputTime">Hora</label>
                <input id="inputTime" type="time" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" class="button-green" value="Enviar">
        </form>

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