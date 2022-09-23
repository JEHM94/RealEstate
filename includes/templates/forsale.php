<?php
// Imports the Database Connection
require __DIR__ . '/../config/database.php';
$db = connectDB();

// Get properties
$query = "SELECT * FROM properties LIMIT ${propertyLimit}";
$result = mysqli_query($db, $query);

?>

<div class="for-sale-container">
    <?php while ($property = mysqli_fetch_assoc($result)) : ?>

        <div class="for-sale">

            <img loading="lazy" width="200" height="300" src="/images/<?php echo $property['image']; ?>" alt="Anuncio">

            <div class="for-sale-content">
                <h3><?php echo $property['tittle']; ?></h3>
                <p class="for-sale-description"><?php echo $property['description']; ?></p>
                <p class="for-sale-price">$<?php echo $property['price']; ?></p>

                <ul class="icons-info">
                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                        <p><?php echo $property['wc']; ?></p>
                    </li>

                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                        <p><?php echo $property['parking']; ?></p>
                    </li>

                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                        <p><?php echo $property['bedrooms']; ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $property['id']; ?>" class="button-yellow-block">
                    Ver Propiedad
                </a>

            </div> <!-- .for-sale-content -->
        </div> <!-- .for-sale -->

    <?php endwhile; ?>
</div> <!-- .for-sale-container -->
<?php
// Close Database
closeDB($db);
?>