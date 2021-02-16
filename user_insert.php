<?php
include_once "database.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

if(!empty($first_name) && !empty($last_name)&& !empty($email)&& !empty($pass)&& !empty($pass2)
&& ($pass == $pass2)){

    $pass = password_hash($pass,PASSWORD_DEFAULT);

    $query = "INSERT INTO users(first_name,last_name,email,pass) VALUES(?,?,?,?)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name,$last_name,$email,$pass]);

    header("location: login.php");
}
else{
    header("location: register.php");
}


?>