<?php

$result = [];
$mesaj = "Please use it correctly !!!";

if(isset($_POST['VERI'])){

    require_once('db.php');

    $veri = json_decode($_POST['VERI'], true);

    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $conn->prepare($sql);

    $stmt->execute($veri);
    
    $mesaj = "User created";
  }

$result['message'] = $mesaj;
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

