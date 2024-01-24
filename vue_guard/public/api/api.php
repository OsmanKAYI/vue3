<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'functions.php';

// We use "php://input" because the incoming data comes as a JSON object in the BODY
// This is because when calling, we specify "Content-Type: application/json"
$temp = file_get_contents("php://input");

$data = json_decode($temp, true); // Convert the JSON object to an array with true

$METHOD = $data['method']; // The switch structure operates based on this variable

if ($METHOD <> 'login') {
  list($isVerified, $message) = verifyJWT($mySecretKeyForJwt);

  if (!$isVerified) {
    dieErrorWithJson($message);
  }
}

require_once 'db.php';

$response = []; // This array will be returned when the API responds
$response['success'] = false; // Default value is set to "failure"

switch ($METHOD) {

  case 'login':
    ################################### login ###################################
    $SQL = "SELECT id, name, email
            FROM users 
            WHERE username = :username AND password = :password";
    $QUERY = $DB->prepare($SQL);
    $QUERY->bindParam(':username',     $data['user']['username']);
    $QUERY->bindParam(':password', $data['user']['password']);
    $QUERY->execute();
    $userRow = $QUERY->fetch(PDO::FETCH_ASSOC);
    if ($userRow) {
      $response['success'] = true; // Login successful
      $userID = $userRow['id'];
      unset($userRow['id']); // Remove the ID parameter from the response. Otherwise, redundant information will be sent
      $myToken = generateJWT($userID, $userRow, $mySecretKeyForJwt);
      $response['token'] = $myToken;
    }
    break;

  default:
    ################################### default ###################################
    $response['error'] = "`method` name is not valid";
    if (!isset($data['method'])) {
      $response['error'] = "`method` parameter not found";
    }
} // switch

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
