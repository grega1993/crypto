<?php
    include_once "session.php";
    include_once "database.php";

    $title = $_POST['title'];
    $description = $_POST['description'];
    $current_price = floatval($_POST['current_price']);
    
    $target_dir = "uploads/";

    $random =  date('YmdHisu'); //20211212234235654


    $target_file = $target_dir . $random . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //preveri ali ima datoteka dejansko velikost
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } 
    else 
    {
        $uploadOk = 0;
    }

    // Check file size max 5mb
    if ($_FILES["logo"]["size"] > 5000000) {
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $uploadOk = 0;
    }



if(!empty($title) && ($uploadOk == 1)){

    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
        //zapiše se vse v bazo
    $query = "INSERT INTO cryptocurrencies(title,description,current_price,logo) VALUES(?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title,$description,$current_price,$target_file]);

    header("location: cryptocurrencies.php");
    die;} 
        
    else {
        header("location: cryptocurrency_add.php");
    die;
    }

}
else{
    header("location: cryptocurrency_add.php");
    die;
}


?>