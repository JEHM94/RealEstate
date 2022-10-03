<?php
// Includes funcions

use App\Property;

require '../includes/app.php';

// Check if the user is authenticated
authUser();

// Query to Get properties
$properties = Property::getAllProperties();

// Property message validation
$message = $_GET['result'] ?? null;

// Delete Property
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        // Delete the image from the images folder
        $query = "SELECT image FROM properties WHERE id = ${id}";
        $result = mysqli_query($db, $query);
        $property = mysqli_fetch_assoc($result);

        unlink('../images/' . $property['image']);

        // Then delete the property from the database
        $query = "DELETE FROM properties WHERE id = ${id}";
        $result = mysqli_query($db, $query);

        if ($result) {
            // After the property is deleted go back to admin
            //This header redirects only if there is not any HTML BEFORE it
            redirectToAdmin(PROPERTY_DELETED);
        }
    }
}


// Includes the site Header
includeTemplate('header');
?>

<main class="container section">
    <h1>Administrador de Bienes Raices</h1>

    <?php
    switch ($message):
        case md5(PROPERTY_REGISTERED):
    ?>
            <p class="alert successful"><?php echo PROPERTY_REGISTERED; ?></p>
        <?php
            break;
        case md5(PROPERTY_UPDATED):
        ?>
            <p class="alert successful"><?php echo PROPERTY_UPDATED; ?></p>
        <?php
            break;
        case md5(PROPERTY_DELETED):
        ?>
            <p class="alert successful"><?php echo PROPERTY_DELETED; ?></p>
    <?php
            break;
        default:
            break;
    endswitch;
    ?>

    <a href="/admin/properties/crear.php" class="button button-green">Nueva Propiedad</a>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Show properties result -->
            <?php foreach ($properties as $property) : ?>
                <tr>
                    <td><?php echo $property->id; ?></td>
                    <td><?php echo $property->tittle; ?></td>
                    <td> <img src="/images/<?php echo $property->image; ?>" class="table-image" alt="Imagen Propiedad"></td>
                    <td>$<?php echo $property->price; ?></td>
                    <td>
                        <a href="/admin/properties/actualizar.php?id=<?php echo $property->id; ?>" class="button-yellow-block">Actualizar</a>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                            <input type="submit" class="button-red-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php
// Includes the site Footer
includeTemplate('footer');

// Close Database
closeDB($db);
?>