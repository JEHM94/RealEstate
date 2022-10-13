<?php

use App\Property;

// Get all properties
if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $properties = Property::getAll();
} else {
    $properties = Property::getLimit(3);
}
?>

<div class="for-sale-container">
    <?php foreach ($properties as $property) : ?>

        <div class="for-sale">

            <img loading="lazy" width="200" height="300" src="/images/<?php echo $property->image; ?>" alt="Anuncio">

            <div class="for-sale-content">
                <h3><?php echo $property->tittle; ?></h3>
                <p class="for-sale-description"><?php echo $property->description; ?></p>
                <p class="for-sale-price">$<?php echo $property->price; ?></p>

                <ul class="icons-info">
                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                        <p><?php echo $property->wc; ?></p>
                    </li>

                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                        <p><?php echo $property->parking; ?></p>
                    </li>

                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                        <p><?php echo $property->bedrooms; ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $property->id; ?>" class="button-yellow-block">
                    Ver Propiedad
                </a>

            </div> <!-- .for-sale-content -->
        </div> <!-- .for-sale -->

    <?php endforeach; ?>
</div> <!-- .for-sale-container -->