<?php
require 'app.php';

// Templates
function includeTemplate(string $templateName, bool $isIndex = false)
{
    include TEMPLATES_URL . "/${templateName}.php";
}

function redirectToAdmin(string $redirectionMessage = null)
{

    if ($redirectionMessage == null) {
        header('Location: /admin');
    } else {
        $message = md5($redirectionMessage);
        header('Location: /admin?result=' . $message);
    }
}