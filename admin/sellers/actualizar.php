<?php
// Imports
// Includes funcions
require '../../includes/app.php';

use App\Seller;
// Check if the user is authenticated
authUser();

// Check for valid ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
//If the id is not int redirect back to admin
if (!$id) {
    redirectToAdmin();
}

//Find the property by its id
$seller = Seller::findOnDB($id);

// If no Seller was found then go back
if (!$seller) {
    header('Location: /admin');
}

$errors = Seller::getErrors();

// Check if the Form was sent by the User
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get user input
    $array = $_POST['seller'];

    // Sync Attributes
    $seller->syncChanges($array);

    /******* Form Validations *******/
    $errors = $seller->validate();

    // if there are no errors then Update
    if (empty($errors)) {
        // Update Seller then redirects to Admin
        $seller->saveToDB();
    }
}


includeTemplate('header');
?>


<main class="container section">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="button button-green">Volver</a>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="form">
        <?php include '../../includes/templates/form_sellers.php' ?>

        <input type="submit" class="button button-green" value="Guardar Cambios">
    </form>
</main>

<?php
includeTemplate('footer');

?>