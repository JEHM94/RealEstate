<?php
// Imports
// Includes funcions

use App\Property;
use App\Seller;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

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
$property = Property::findOnDB($id);


// If no property was found then go back
if (!$property) {
    header('Location: /admin');
}

// Query to Get Sellers
$sellers = Seller::getAll();

$errors = Property::getErrors();

// Sends the form to the DB
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get user input
    $array = $_POST['property'];

    // Sync Attributes
    $property->syncChanges($array);

    /******* Form Validations *******/
    $errors = $property->validate();

    // if there are no errors then Update
    if (empty($errors)) {

        /* Files upload to the server */
        // If a new Image exists
        if ($_FILES['property']['tmp_name']['image']) {
            // Create custom unique name for the Image
            $imageName = md5(uniqid(rand(), true)) . ".jpg";

            // Save the Image Name to the Property Instace
            $property->setImage($imageName);

            // Resize Image Using Intervention 800x600 px
            // Get the Image from input name='image'
            $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);

            // Save the Image to the server
            $image->save(IMAGE_FOLDER . $imageName);
        }

        // Update Property then redirects to Admin
        $property->saveToDB();
    }
}

includeTemplate('header');
?>

<main class="container section">
    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="button button-green">Volver</a>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="form" enctype="multipart/form-data">
        <?php include '../../includes/templates/form_template.php' ?>

        <input type="submit" class="button button-green" value="Actualizar Propiedad">
    </form>
</main>

<?php
includeTemplate('footer');

?>