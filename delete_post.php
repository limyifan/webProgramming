<?php
session_start();
// Include config file
include_once ('database.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
if (!isset($_GET['post_id'])){
    header('Location: index.php');
} else {
    $post_id = $_GET['post_id'];
    $query = "DELETE FROM posts WHERE post_id=$post_id";
    mysqli_query($link, $query);
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
