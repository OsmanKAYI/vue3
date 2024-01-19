<?php

session_start();
session_regenerate_id(true);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// file_get_contents is the way to get the data comes from body of axios form 
// json_decode decodes (transforms it to object) the encoded data
$temp = file_get_contents("php://input");
$data = json_decode($temp, true); // Converted to array with `true`. If `true` is not sent, it remains as an object.
// $data = json_decode(file_get_contents("php://input"), true);

require_once 'db.php';

$response = [];
// $response['data'] = $data;

$sql = "SELECT id, adsoyad FROM kullanicilar WHERE adsoyad = :name AND parola = :password";
$stmt = $DB->prepare($sql);

$stmt->bindParam(':name', $data['name']);
$stmt->bindParam(':password', $data['password']);

$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
  $response['success'] = true;
  $response['user'] = $user;
}else{
  $response['success'] = false;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

