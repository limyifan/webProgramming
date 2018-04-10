<?php
require_once 'database.php';
$param_username = "bob";
$sql = "SELECT user_id FROM users WHERE name=?";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    mysqli_stmt_execute($stmt);

                    /* bind variables to prepared statement */
                    mysqli_stmt_bind_result($stmt, $id);

                    /* fetch values */
                    while (mysqli_stmt_fetch($stmt)) {                            
                        $_SESSION['user_id'] = $id;
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
