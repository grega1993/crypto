<?php
include_once "session.php";
include_once "database.php";
$id=$_SESSION['user_id'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

if(!empty($pass) && ($pass == $pass2)){

    $pass = password_hash($pass,PASSWORD_DEFAULT);

    $query = "UPDATE users SET pass =? WHERE id=?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$pass,$id]);

    header("location: profile.php");
    die();
}
else{
    header("location: profile.php");
    die();
}


?>