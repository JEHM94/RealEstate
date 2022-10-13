<?php
// Imports
// Includes funcions
require '../../includes/app.php';

use App\Property;
use App\Seller;
use Intervention\Image\ImageManagerStatic as Image;

// Check if the user is authenticated
authUser();

// Query to Get Sellers
$sellers = Seller::getAll();

$property = new Property;

$errors = Property::getErrors();

// Check if the Form was sent by the User
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Creates a New Property Instance using the form Data
    $property = new Property($_POST['property']);

    // Files Upload
    // If the Image exists
    if ($_FILES['property']['tmp_name']['image']) {
        // Create custom unique name for the Image
        $imageName = md5(uniqid(rand(), true)) . ".jpg";

        // Save the Image Name to the Property Instace
        $property->setImage($imageName);

        // Resize Image Using Intervention 800x600 px
        // Get the Image from input name='image'
        $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
    }


    // Validates the Form filled by the User
    $errors = $property->validate();

    // if there are no errors then insert into the DataBase
    if (empty($errors)) {

        /* Files upload to the server */
        // Create the image folder if not exists
        if (!is_dir(IMAGE_FOLDER)) {
            mkdir(IMAGE_FOLDER);
        }

        // Save the Image to the Server
        $image->save(IMAGE_FOLDER . $imageName);

        // Inserts a New Property Into Database
        $property->saveToDB();
    }
}


includeTemplate('header');
?>

<main class="container section">
    <h1>Crear</h1>

    <a href="/admin" class="button button-green">Volver</a>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/properties/crear.php" method="POST" class="form" enctype="multipart/form-data">
        <?php include '../../includes/templates/form_template.php' ?>

        <input type="submit" class="button button-green" value="Crear Propiedad">
    </form>
</main>

<?php
includeTemplate('footer');

?>