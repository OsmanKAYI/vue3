<?php

session_start();
session_regenerate_id(true);

// Set necessary headers to prevent CORS errors (if required for security reasons)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Retrieve data from POST request
$data = json_decode(file_get_contents("php://input"), true); // Convert to array with `true`. If `true` is not sent, it remains as an object.

// $response = [];
// $response['responseData'] = $data;
// $response['name'] = $data['name'];
// $response['name'] = $data->name;  // if true is not sent, this convention is used

require_once 'db.php';

// Protection against SQL injections
$name = htmlspecialchars($data['name']);
$tc = htmlspecialchars($data['tc']);
$email = htmlspecialchars($data['email']);
$city_id = (int)$data['city']; // Convert the value to an integer to allow only numeric values.
$courses = htmlspecialchars($data['courses']);

// If necessary, decode HTML entities when displaying the data
$name = htmlspecialchars_decode($name);
$tc = htmlspecialchars_decode($tc);
$email = htmlspecialchars_decode($email);
$courses = htmlspecialchars_decode($courses);

// Function to handle database insertion
function insertFormData($DB, $name, $tc, $email, $city_id, $courses) {
    $sql = "INSERT INTO formlar (adsoyad, tc, email, sehir_id, dersler) VALUES (:name, :tc, :email, :city_id, :courses)";
    $stmt = $DB->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':tc', $tc);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':city_id', $city_id);
    $stmt->bindParam(':courses', $courses);

    try {
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Check if the initial data processing was successful before proceeding with database insertion
if (!isset($data['name']) || !isset($data['tc']) || !isset($data['age']) || !isset($data['email']) || !isset($data['city']) || !isset($data['courses'])) {
    // Additional validation checks can be added as needed
    $response['success'] = false;
    exit(); // Stop execution if required data is missing
}

// Perform database insertion only if the initial processing was successful
if (insertFormData($DB, $name, $tc, $email, $city_id, $courses)) {
    $response['success'] = true;
    $response['message'] = "Form data added successfully.";
} else {
    $response['success'] = false;
    $response['message'] = "An error occurred while adding form data.";
}

// Return the result as JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

// Stop execution after sending the response
exit();
?>
