<?php
session_start();

//do katerih strani ima neprijavljen uporabnik dostop
$allow = ['/crypto/login.php','/crypto/register.php','/crypto/login.php','/crypto/index.php','/crypto/login_check.php'];

//preverim ali si prijavljen
if(!isset($_SESSION['user_id'])&&(!in_array($_SERVER['REQUEST_URI'],$allow))){

    header("location: login.php");
    die();
}

function getFullName($user_id){
    require "database.php";

    $query = "SELECT * FROM users WHERE id=?";
    $stmt = $pdo -> prepare($query);
    $stmt->execute([$user_id]);

    $user = $stmt->fetch();
    return  $user['first_name'].' '.$user['last_name'];
}

//vrača za trenutno prijavljenega uporabnika
function admin(){
    return $_SESSION['admin'];
}

//če trenutno prjavljeni ni admin ga preusmeri na index
function adminOnly(){
    if(!isset($_SESSION['admin']) || ($_SESSION['admin'] != 1)){
        header("Location: index.php");
        die();
    }
}



?>