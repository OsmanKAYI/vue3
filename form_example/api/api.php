<?php

// Set necessary headers to prevent CORS errors (if required for security reasons)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Retrieve data from POST request
$data = json_decode(file_get_contents("php://input"), true); // Convert to array with `true`. If `true` is not sent, it remains as an object.

$response = [];
$response['responseData'] = $data;
$response['name'] = $data['name'];
// $response['name'] = $data->name;  // if true is not sent, this convention is used

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

die();

require_once 'db.php';

if (!isset($_GET['method'])) {
  die("ERROR: API could not be called properly!");
}

switch ($_GET['method']) {
  case 'get.cities':
    $SQL = "SELECT id, il_adi FROM iller ORDER BY il_adi";
    $SORGU = $DB->prepare($SQL);
    $SORGU->execute();
    $rows = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    // DD($rows);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
    break;

  case 'get.district':
    // $cityID = ($_GET['il_id']) ? $_GET['il_id'] : 0;
    $cityID = ($_GET['il_id']) ?? 0;
    $SQL = "SELECT id, il_id, ilce_adi FROM ilce WHERE il_id = :il_id ORDER BY ilce_adi";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':il_id', $cityID);
    $SORGU->execute();
    $rows = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    //DD($rows);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
    break;
  default:
    die("ERROR: Please call proper data for `method` variable!");
}
