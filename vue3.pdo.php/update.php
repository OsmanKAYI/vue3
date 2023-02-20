<?php

require_once('db.php');

$result = [];
$mesaj = 'Please use it correctly !!!';

  if(isset($_POST['VERI'])){

    $veri = json_decode($_POST['VERI'], true);
  
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->execute($veri);

    $mesaj = "User created";
  }  

$result['message'] = $mesaj;
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
