<?php
require 'includes/app.php';
includeTemplate('header');
?>

<main class="container section">
    <section class="section container for-sale-section">
        <h2>Casas y Departamentos</h2>

        <?php
        include 'includes/templates/forsale.php';
        ?>
    </section>
</main>

<?php
includeTemplate('footer');

?>