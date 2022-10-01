<?php
require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Property;

// Connect DataBase
$db = connectDB();

// Set DataBase to All Property Instances
Property::setDB($db);