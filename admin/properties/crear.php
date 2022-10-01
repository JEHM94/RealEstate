<?php
// Imports
// Includes funcions
require '../../includes/app.php';

use App\Property;
use Intervention\Image\ImageManagerStatic as Image;

// Check if the user is authenticated
authUser();

// Imports the Database Connection
$db = connectDB();

// Query to Get Sellers
$query = "SELECT id, name, lastname FROM sellers";
$result2 = mysqli_query($db, $query);

// Variables
$tittle = '';
$price = '';
$description = '';
$bedrooms = '';
$wc = '';
$parking = '';
$sellers_id = '';

$errors = Property::getErrors();

// Check if the Form was sent by the User
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Creates a New Property Instance using the form Data
    $property = new Property($_POST);

    // If the Image exists
    if ($_FILES['image']['tmp_name']) {
        // Create custom unique name for the Image
        $imageName = md5(uniqid(rand(), true)) . ".jpg";

        // Save the Image Name to the Property Instace
        $property->setImage($imageName);

        // Resize Image Using Intervention 800x600 px
        // Get the Image from input name='image'
        $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
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
        //$result = $property->saveToDB();
        if ($property->saveToDB()) {
            // After the property is inserted go back to admin
            //This header redirects only if there is not any HTML BEFORE it
            redirectToAdmin(PROPERTY_REGISTERED);
        }
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
        <fieldset>
            <legend>Información General</legend>

            <label for="formCreateTittle">Título</label>
            <input id="formCreateTittle" name="tittle" type="text" placeholder="Título de la Propiedad" value="<?php echo $property->tittle ?? ''; ?>">

            <label for="formCreatePrice">Precio ($)</label>
            <input id="formCreatePrice" name="price" type="number" placeholder="$100,000" min=0 max=99999999 value="<?php echo $property->price ?? ''; ?>">

            <label for="formCreateImage">Image</label>
            <input id="formCreateImage" name="image" type="file" accept="image/jpeg, image/png">

            <label for="formCreateDescription">Descripción</label>
            <textarea id="formCreateDescription" name="description" cols="30" rows="10"><?php echo $property->description ?? ''; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Características de la Propiedad</legend>

            <label for="formCreateBRooms">Habitaciones</label>
            <input id="formCreateBRooms" type="number" name="bedrooms" placeholder="0" min=0 max=9 value="<?php echo $property->bedrooms ?? ''; ?>">

            <label for="formCreateWC">Baños</label>
            <input id="formCreateWC" type="number" name="wc" placeholder="0" min=0 max=9 value="<?php echo $property->wc ?? ''; ?>">

            <label for="formCreateParking">Estacionamientos</label>
            <input id="formCreateParking" type="number" name="parking" placeholder="0" min=0 max=9 value="<?php echo $property->parking ?? ''; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select id="formCreateSeller" name="sellers_id">
                <option selected disabled>-Seleccionar-</option>
                <?php while ($seller = mysqli_fetch_assoc($result2)) : ?>
                    <option <?php echo $sellers_id === $seller['id'] ? 'selected' : '' ?> value="<?php echo $seller['id']; ?>">
                        <?php echo $seller['name'] . " " . $seller['lastname']; ?> </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" class="button button-green" value="Crear Propiedad">
    </form>
</main>

<?php
includeTemplate('footer');

// Close Database
closeDB($db);
?>