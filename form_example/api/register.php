<?php

session_start();
session_regenerate_id(true);

// Set necessary headers to prevent CORS errors (if required for security reasons)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Retrieve data from POST request
$data = json_decode(file_get_contents("php://input"), true); // Convert to array with `true`. If `true` is not sent, it remains as an object.

require_once 'db.php';

$sql = "INSERT INTO kullanicilar (adsoyad, tc, yas, email, sehir_id, ders_id, parola) 
        VALUES (:name, :tc, :age, :email, :city, :courses, :password)";
$stmt = $DB->prepare($sql);

// Convert courses array to comma-separated string
$courses = implode(',', $data['courses']);

$stmt->bindParam(':name', $data['name']);
$stmt->bindParam(':tc', $data['tc']);
$stmt->bindParam(':age', $data['age']);
$stmt->bindParam(':email', $data['email']);
$stmt->bindParam(':city', $data['city']);
$stmt->bindParam(':courses', $courses);
$stmt->bindParam(':password', $data['password']);

$response = [];

try {
    $stmt->execute();
    $response['success'] = true;
    $response['message'] = "Form data added successfully.";
} catch (PDOException $e) {
    $response['success'] = false;
    $response['message'] = "An error occurred while adding form data. Error: " . $e->getMessage();
}

// Return the result as JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
