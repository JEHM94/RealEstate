<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');

define('IMAGE_FOLDER', __DIR__ . '/../images/');

// Property
define('PROPERTY_REGISTERED', 'Propiedad creada correctamente');
define('PROPERTY_UPDATED', 'Propiedad actualizada correctamente');
define('PROPERTY_DELETED', 'Propiedad Eliminada correctamente');
// Seller
define('SELLER_REGISTERED', 'Vendedor creado correctamente');
define('SELLER_UPDATED', 'Vendedor actualizado correctamente');
define('SELLER_DELETED', 'Vendedor Eliminado correctamente');

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

// Shows success message in the Admin Site
function getResultMessage($message): string
{
    switch ($message):
        case md5(PROPERTY_REGISTERED):
            return PROPERTY_REGISTERED;
            break;
        case md5(PROPERTY_UPDATED):
            return PROPERTY_UPDATED;
            break;
        case md5(PROPERTY_DELETED):
            return PROPERTY_DELETED;
            break;
        case md5(SELLER_REGISTERED):
            return SELLER_REGISTERED;
            break;
        case md5(SELLER_UPDATED):
            return SELLER_UPDATED;
            break;
        case md5(SELLER_DELETED):
            return SELLER_DELETED;
            break;
        default:
            return '';
            break;
    endswitch;
}
