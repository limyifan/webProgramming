<?php
session_start();
// Include config file
include_once ('database.php');

//make sure you are logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['submit'])) {
    echo "POST IS SET 2";
    //get the blog data
    $title = strip_tags($_POST['post_title']);
    $content = strip_tags($_POST['content']);

    $title = $link->real_escape_string($title);
    $content = $link->real_escape_string($content);
    $user_id = $_SESSION['user_id'];
    
    //$date = date('Y-m-d- G:i:s);
//    $date = date('1 js \of F Y h:i:s A');
//    echo date('l jS \of F Y h:i:s A');
    $timestamp = date("Y-m-d H:i:s");
    $content = htmlentities($content);  //convert all html tags into html entitied to save space in db
    if ($title && $content) {
        //sql statement to store into our db
        $query = $link->query("INSERT INTO posts (post_title, content, user_id, date) VALUES ('$title', '$content','$user_id','$timestamp')");

        if ($query) {
            echo "Post Added Successfully";
        } else {
            echo "Error";
        }
    } else {
        echo "Please Complete your post";
    }
}else{
    echo "POST NOT SET 2";
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
        <title>Blog-Post</title>
        <style>
            #container {
                margin: auto;
                width: 60%;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="container">
                <!-- php echo htmlspecialchars($_SERVER["PHP_SELF"]); enctype="multipart/form-data" -->
                <form action="#" method="post" >
                    <input placeholder="Title" name="post_title" type="text" autofocus size="48"><br/><br/>
                    <textarea name="content" placeholder="Content" rows="20" cols="50"></textarea><br/>
                    <input name="submit" type="submit" value="Post">

                </form>

                <?php
// put your code here
                ?>
            </div>
        </div>
    </body>
</html>
