<?php
// Imports
require 'includes/app.php';

// Check if the user is authenticated already
session_start();
$auth = $_SESSION['login'] ?? null;

if ($auth) {
    header('Location: /admin');
}



$db = connectDB();

// User authentication
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);


    if (!$email) {
        $errors[] = "El email es obligatorio o no es válido";
    }

    if (!$password) {
        $errors[] = "La contraseña es obligatoria";
    }

    if (empty($errors)) {
        // Check if the User extist
        $query = "SELECT * FROM users WHERE email = '${email}'";
        $result = mysqli_query($db, $query);

        if ($result->num_rows) {
            $user = mysqli_fetch_assoc($result);

            // Check if the Password is valid
            $auth = password_verify($password, $user['password']);

            if ($auth) {
                // Auth successfuly. Session Starts
                //session_start();
                // Fill Session with user cedentials
                $_SESSION['user'] = $user['email'];
                $_SESSION['login'] = true;
                // Send the User to Admin site
                header('Location: /admin');
            } else {
                $errors[] = "Contraseña Incorrecta";
            }
        } else {
            $errors[] = "El usuario no existe";
        }
    }
}


// Header
includeTemplate('header');
?>

<main class="container section center-content">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="form container">
        <fieldset>
            <!-- <legend>Email y Contraseña</legend> -->

            <label for="inputEmail">E-mail</label>
            <input id="inputEmail" name="email" type="email" placeholder="correo@correo.com" required>

            <label for="inputPassword">Contraseña</label>
            <input id="inputPassword" name="password" type="password" placeholder="**********" required>
        </fieldset>

        <input type="submit" class="button button-green" value="Iniciar Sesión">
    </form>
</main>

<?php
includeTemplate('footer');
?>