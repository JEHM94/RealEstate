<?php
require 'app.php';

// Templates
function includeTemplate(string $templateName, bool $index = false)
{
    include TEMPLATES_URL . "/${templateName}.php";
}
