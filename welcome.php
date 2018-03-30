<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
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
    </head>
    <body>
        <div class="page-header">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>
            <div id="menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="new_post.php">Create New Post</a></li>
                    <li><a href="#">Delete Post</a></li>
                    <li style="float:right"><a href="logout.php">Log Out</a></li>
                </ul>            
            </div>
        </div><br>
        <img src="uploads/<?php echo htmlspecialchars($_SESSION['avatar']); ?>">
        <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
    </body>
</html>