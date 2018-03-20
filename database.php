<?php

$dsn = "mysql:host=localhost;dbname=webprogrammingcasem2";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);
    // echo "database connected!!"; 
} catch (PDOExceptionc $e) {
    $error_message = $e->getMessage();
    inclcude("database_error.php");
    exit();
}
?>