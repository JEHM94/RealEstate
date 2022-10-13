<?php
// Imports
require 'includes/app.php';

use App\Property;

// Check for valid ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
//If the id is not int redirect back to admin
if (!$id) {
    header('Location: anuncios.php');
}

// Find the property by its ID
$property = Property::findOnDB($id);

// If no property was found then go back
if (!$property) {
    header('Location: anuncios.php');
}

includeTemplate('header');
?>

<main class="container section center-content">
    <h1><?php echo $property->tittle; ?></h1>

    <img loading="lazy" width="200" height="300" src="images/<?php echo $property->image; ?>" alt="Imagen de la Propiedad">

    <div class="property-details">
        <p><?php echo $property->description; ?>
            Nam aut similique ut repellendus, quasi fugiat mollitia impedit, quo corrupti consequatur recusandae
            dolore! Adipisci rem fuga, ea illum exercitationem veniam maxime saepe perferendis voluptatem nostrum
            corrupti! Fugiat, non ut?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam sed quo eveniet amet? Aut, nobis dolore
            deserunt ipsam sed veniam incidunt distinctio officiis maxime! Iure aspernatur repellat quisquam debitis
            fugit.</p>

        <p class="for-sale-price">$<?php echo $property->price; ?></p>

        <ul class="icons-info detailed">
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
    </div> <!-- .property-details -->
</main>

<?php
includeTemplate('footer');
?>