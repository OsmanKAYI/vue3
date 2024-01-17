<?php

require_once 'db.php';

$result = [];

switch ($_GET['method']) {
  case 'get.cities':
    $SQL = "SELECT id, il_adi as name FROM iller ORDER BY name";
    $SORGU = $DB->prepare($SQL);
    $SORGU->execute();
    $result = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 'get.courses':
    $SQL = "SELECT id, ders_adi as name FROM dersler ORDER BY id";
    $SORGU = $DB->prepare($SQL);
    $SORGU->execute();
    $result = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 'get.users':
    $SQL = "SELECT id, adsoyad as username, tc, email, sehir_id as city, ders_id as courses, parola as password FROM kullanicilar ORDER BY id";
    $SORGU = $DB->prepare($SQL);
    $SORGU->execute();
    $result = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    break;
  
  default:
    $result['error'] = "Given value for method parameter is not correct!!!";
    if (!isset($_GET['method'])) {
    $result['error'] = 'Method parameter is required!!!';
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
