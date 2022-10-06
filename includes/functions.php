<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');

define('IMAGE_FOLDER', __DIR__ . '/../images/');

define('PROPERTY_REGISTERED', 'Propiedad creada correctamente');
define('PROPERTY_UPDATED', 'Propiedad actualizada correctamente');
define('PROPERTY_DELETED', 'Propiedad Eliminada correctamente');

// Templates
function includeTemplate(string $templateName, bool $isIndex = false)
{
    include TEMPLATES_URL . "/${templateName}.php";
}

// Redirects the user to Admin site
function redirectToAdmin(string $redirectionMessage = null)
{

    if ($redirectionMessage == null) {
        header('Location: /admin');
    } else {
        $message = md5($redirectionMessage);
        header('Location: /admin?result=' . $message);
    }
}

// Authenticates Admin User
function authUser()
{
    // Check if the user is authenticated
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

// Cleans the user inputs to add security 
function cleanInput($input)
{
    return htmlspecialchars($input);
}
