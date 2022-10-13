<?php
// Imports
// Includes funcions
require '../../includes/app.php';

use App\Seller;

// Check if the user is authenticated
authUser();

$seller = new Seller();

$errors = Seller::getErrors();

// Check if the Form was sent by the User
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Create a new Seller
    $seller = new Seller($_POST['seller']);

    // Validates the Form filled by the User
    $errors = $seller->validate();

    // if there are no errors then insert into the DataBase
    if (empty($errors)) {
        // Inserts a New Seller Into Database
        $seller->saveToDB();
    }
}


includeTemplate('header');
?>


<main class="container section">
    <h1>Registrar Nuevo Vendedor</h1>

    <a href="/admin" class="button button-green">Volver</a>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/sellers/crear.php" method="POST" class="form">
        <?php include '../../includes/templates/form_sellers.php' ?>

        <input type="submit" class="button button-green" value="Registrar Vendedor">
    </form>
</main>

<?php
includeTemplate('footer');

?>