<?php

require_once 'db.php';

if (!isset($_GET['method'])) {
  die("HATA: API doğru biçimde çağrılmadı!");
}


switch ($_GET['method']) {
  case 'get.cities':
    $SQL = "SELECT city_id, PLAKA, city_name FROM il ORDER BY city_name";
    $SORGU = $DB->prepare($SQL);
    $SORGU->execute();
    $rows = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    // DD($rows);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
    break;

  case 'get.ilceler':
    // $ILID = ($_GET['city_id']) ? $_GET['city_id'] : 0;
    $ILID = ($_GET['city_id']) ?? 0;
    $SQL = "SELECT ILCE_ID, city_id, ILCE_ADI FROM ilce WHERE city_id = :city_id ORDER BY ILCE_ADI";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':city_id', $ILID);
    $SORGU->execute();
    $rows = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    //DD($rows);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
    break;
  default:
    die("HATA: `method` adlı değişken için doğru verilerler çağırınız");
}
