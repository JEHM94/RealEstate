<?php
require 'app.php';

// Templates
function includeTemplate(string $templateName, bool $index = false)
{
    include TEMPLATES_URL . "/${templateName}.php";
}

function redirectToAdmin(string $redirectionMessage = null)
{

    if ($redirectionMessage == null) {
        header('Location: /admin');
        exit;
    } else {
        $message = md5($redirectionMessage);
        header('Location: /admin?result=' . $message);
    }
}
