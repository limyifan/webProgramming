<?php
//connect to the database
include('database.php');

//get record count of posts in database
$record_count = $link->query("SELECT * FROM posts");

//amount displayed
$per_page = 2;

//number of pages
$pages = ceil($record_count->num_rows / $per_page);  //round up next highest integers 
//get page number and find out which page we are on
if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 1;
}
//starting point
if ($page <= 0) {
    $start = 0;
} else {
    $start = $page * $per_page - $per_page;
}
$prev = $page - 1;
$next = $page + 1;
/*
$query = $link->prepare("SELECT post_id, post_title, LEFT(content, 200) AS content FROM posts ORDER BY post_id DESC LIMIT $start, $per_page");
$query->execute();
$query->bind_result($post_id, $post_title, $content);
*/

$query = $link->prepare("SELECT u.name,u.avatar, p.date, p.post_id, p.post_title, LEFT(p.content, 200) AS content "
        . "FROM users as u, posts as p WHERE u.user_id = p.user_id " 
        . "ORDER BY p.post_id DESC LIMIT $start, $per_page");
$query->execute();
$query->bind_result($name,$avatar, $date, $post_id, $post_title, $content);

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Blog Website</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            #container {
                margin: auto;
                width: 800px;
            }
            body{ 
                font: 14px sans-serif;
                text-align: center; 
            }
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }
            a:link {
                text-decoration: none;
            }

            li {
                float: left;
                border-right:1px solid #bbb;
            }

            li:last-child {
                border-right: none;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                background-color: #ff6666;
            }

            .active {
                background-color: #4CAF50;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.5.min.js"></script>

    </head>
    <body>
        <div class="page-header">
            <h1>Welcome to our site</h1>
            <div id="menu">
                <ul>
                    <li><a href="#">Search For Blog</a></li>
                    <li><a href="new_post.php">Create New Post</a></li>
                    <li style="float:right"><a href="register.php">Register</a></li>
                    <li style="float:right"><a href="login.php">Log In</a></li>
                </ul>            
            </div>
        </div><br>

        <div id="container">


            <?php
            while ($query->fetch()):
                $lastspace = strrpos($content, ' ')
                ?>
                <article>
                    <h2><?php echo $post_title ?> </h2>
                    <p><?php echo substr($content, 0, $lastspace) . "<a href='view_post.php?post_id=$post_id'> READ MORE...</a>" ?></p>
                    <img src='uploads/<?php echo$avatar?>' style='float: left; height:0px;width:50px;'> <p>Posted on: <?php echo $date ?>. By: <?php echo $name ?></p>
                </article>
            <?php endwhile ?>

            <?php
            if ($prev > 0) {
                echo "<a href='index.php?p=$prev'>Prev</a>&nbsp;&nbsp;&nbsp&nbsp;&nbsp;";
            }
            if ($page < $pages) {
                echo "<a href='index.php?p=$next'>Next</a>";
            }
            ?>
        </div>

    </body>
</html>