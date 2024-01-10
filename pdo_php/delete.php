<?php

require_once('db.php');

$result = [];
$mesaj = 'Please use it correctly !!!';

  if(isset($_POST['VERI'])){

    /*
    "{'id': 2, 'name': 'nuri'}"

    $veri = json_decode($_POST['VERI'], true);

    $veri["id"] = 2
    $veri["name"]="osman"
    */

    $veri = json_decode($_POST['VERI'], true);

    $id    = $veri['id'];

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    $mesaj = 'User deleted';
  }

$result['message'] = $mesaj;

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
