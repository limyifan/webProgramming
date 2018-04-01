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

$query = $link->prepare("SELECT post_id, post_title, LEFT(content, 200) AS content FROM posts ORDER BY post_id DESC LIMIT $start, $per_page");
$query->execute();
$query->bind_result($post_id, $post_title, $content);
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
        </style>
        <script src="http://code.jquery.com/jquery-1.5.min.js"></script>

    </head>
    <body>

        <div id="container">
<?php
while ($query->fetch()):
    $lastspace = strrpos($content, ' ')
    ?>
                <article>
                    <h2><?php echo $post_title ?></h2>
                    <p><?php echo substr($content, 0, $lastspace) . "<a href='view_post.php?post_id=$post_id'> READ MORE...</a>" ?></p>
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