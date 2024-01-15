<?php

session_start();
session_regenerate_id(true);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

require_once 'db.php';

$name = htmlspecialchars($data['name']);
$password = htmlspecialchars($data['password']);

$name = htmlspecialchars_decode($name);
$password = htmlspecialchars_decode($password);

// Implement your authentication logic here
$authenticated = authenticateUser($DB, $name, $password);

$response = [];

if ($authenticated) {
  $response['success'] = true;
  $response['message'] = "Login successful.";
} else {
  $response['success'] = false;
  $response['message'] = "Invalid credentials.";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

exit();

function authenticateUser($DB, $name, $password) {
    // Implement your authentication logic here
    // For simplicity, check if the user exists in the database
    $sql = "SELECT * FROM formlar WHERE adsoyad = :name AND parola = :password";
    $stmt = $DB->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);

    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user !== false;
}