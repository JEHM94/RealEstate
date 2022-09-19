<?php
//Database
require '../../includes/config/database.php';

$db = connectDB();

// Get Sellers
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

$errors = [];

// Sends the form to the DB
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // mysqli_real_escape_string Validates the data sent by the user
    // to avoid sql injections and scripting

    $tittle = mysqli_escape_string($db, $_POST['tittle']);
    $price = mysqli_escape_string($db, $_POST['price']);
    $description = mysqli_escape_string($db, $_POST['description']);
    $bedrooms = mysqli_escape_string($db, $_POST['bedrooms']);
    $wc = mysqli_escape_string($db, $_POST['wc']);
    $parking = mysqli_escape_string($db, $_POST['parking']);
    $sellers_id = mysqli_escape_string($db, $_POST['sellers_id']);
    $created = date('Y/m/d');

    // Save the file in a variable
    // input name='image'
    $image = $_FILES['image'];

    if (!$tittle) {
        $errors[] = "Debes añadir un título";
    }

    if (!$price) {
        $errors[] = "El precio es obligatorio";
    }

    if (strlen($description) < 10) {
        $errors[] = "La descripción debe contener 10 caracteres o más";
    }

    if (!$bedrooms) {
        $errors[] = "El número de habitaciones es obligartorio";
    }

    if (!$wc) {
        $errors[] = "El número de baños es obligartorio";
    }

    if (!$parking) {
        $errors[] = "El número de estacionamientos es obligartorio";
    }

    if (!$sellers_id) {
        $errors[] = "Debes seleccionar un vendedor";
    }

    // $image['error'] checks for size > 2mb (this is the max size allowed by php) 
    if (!$image['name'] || $image['error']) {
        $errors[] = "La imagen es obligatoria";
    }

    // Image size  (max 1mb)
    $maxSize = 1024 * 1000;

    if ($image['size'] > $maxSize) {
        $errors[] = "La Imagen es muy pesada (Máximo 100kb)";
    }



    // if there are no errors then insert
    if (empty($errors)) {

        /* Files upload to the server */
        // Create the image folder if not exists
        $imageFolder = '../../images/';

        if (!is_dir($imageFolder)) {
            mkdir($imageFolder);
        }

        // Create custom unique name
        $imageName = md5(uniqid(rand(), true)) . ".jpg";

        // Upload the image
        move_uploaded_file($image['tmp_name'], $imageFolder . $imageName);


        // Insert query
        $query = "INSERT INTO properties (tittle, price, image, description, bedrooms, wc, parking, datecreated, sellers_id) VALUES ('$tittle', '$price', '$imageName', '$description', '$bedrooms', '$wc', '$parking', '$created', '$sellers_id')";

        $result = mysqli_query($db, $query);

        if ($result) {
            // After the property is inserted go back to admin
            //This header redirects only if there is not any HTML BEFORE it
            require '../../includes/app.php';
            $message = md5($PROPERTY_REGISTERED);
            header('Location: /admin?result=' . $message);
        }
    }
}

require '../../includes/functions.php';
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
            <input id="formCreateTittle" name="tittle" type="text" placeholder="Título de la Propiedad" value="<?php echo $tittle; ?>">

            <label for="formCreatePrice">Precio ($)</label>
            <input id="formCreatePrice" name="price" type="number" placeholder="$100,000" min=0 value="<?php echo $price; ?>">

            <label for="formCreateImage">Image</label>
            <input id="formCreateImage" name="image" type="file" accept="image/jpeg, image/png">

            <label for="formCreateDescription">Descripción</label>
            <textarea id="formCreateDescription" name="description" cols="30" rows="10"><?php echo $description; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Características de la Propiedad</legend>

            <label for="formCreateBRooms">Habitaciones</label>
            <input id="formCreateBRooms" type="number" name="bedrooms" placeholder="0" min=0 max=9 value="<?php echo $bedrooms; ?>">

            <label for="formCreateWC">Baños</label>
            <input id="formCreateWC" type="number" name="wc" placeholder="0" min=0 max=9 value="<?php echo $wc; ?>">

            <label for="formCreateParking">Estacionamientos</label>
            <input id="formCreateParking" type="number" name="parking" placeholder="0" min=0 max=9 value="<?php echo $parking; ?>">
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

    <?php
    includeTemplate('footer');
    ?>