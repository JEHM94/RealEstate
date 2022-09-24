<?php
// Imports the Database Connection
require 'includes/config/database.php';
$db = connectDB();

// Credentials
$email = "email@email.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Query to create the user
$query = " INSERT INTO users (email, password) VALUES ('${email}', '${passwordHash}')";

mysqli_query($db, $query);
