<?php
require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\ActiveRecord;

// Connect DataBase
$db = connectDB();

// Set DataBase to All Property Instances
ActiveRecord::setDB($db);