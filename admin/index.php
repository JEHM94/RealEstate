<?php

require '../includes/functions.php';
$message = md5($PROPERTY_REGISTERED);
$result = $_GET['result'] ?? null;

includeTemplate('header');
?>

<main class="container section">
    <h1>Administrador de Bienes Raices</h1>

    <?php if ($result === $message) : ?>
        <p class="alert successful">Propiedad creada correctamente</p>
    <?php endif; ?>

    <a href="/admin/properties/crear.php" class="button button-green">Nueva Propiedad</a>
</main>

<?php
includeTemplate('footer');
?>