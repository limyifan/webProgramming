<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=webprogrammingcasem2', 'root', '');

$error = '';
$comment_name = '';
$comment_content = '';

if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">*Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">*Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if( !empty($_POST['post_id'])){
    $post_id = $_POST['post_id'];
}else{
    $post_id = -1;
}

if($error == '')
{
 $query = "
 INSERT INTO comments 
 (parent_comment_id, comment, name, post_id) 
 VALUES (:parent_comment_id, :comment, :name, :post_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':name' => $comment_name,
   ':post_id' => $post_id
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>