<?php
include_once "database.php";
include_once "session.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$description = $_POST['description'];

$id=$_SESSION['user_id'];

if(!empty($first_name) && !empty($last_name)){

    $query = "UPDATE users SET first_name=?, last_name=?, description=? WHERE id=?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name,$last_name,$description,$id]);

    header("location: profile.php");
    die();
}
else{
    header("location: profile.php");
    die();
}


?>