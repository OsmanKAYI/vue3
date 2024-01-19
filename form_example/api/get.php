<?php

require_once 'db.php';

$result = [];

switch ($_GET['method']) {
  case 'get.cities':
    $SQL = "SELECT id, il_adi as name FROM iller ORDER BY name";
    $QUERY = $DB->prepare($SQL);
    $QUERY->execute();
    $result = $QUERY->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 'get.courses':
    $SQL = "SELECT id, ders_adi as name FROM dersler ORDER BY id";
    $QUERY = $DB->prepare($SQL);
    $QUERY->execute();
    $result = $QUERY->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 'get.users':
    $SQL = "SELECT id, adsoyad as name, tc, yas as age, email, sehir_id as city, ders_id as courses, parola as password, isActive FROM kullanicilar ORDER BY id";
    $QUERY = $DB->prepare($SQL);
    $QUERY->execute();
    $result = $QUERY->fetchAll(PDO::FETCH_ASSOC);
    break;
    
  case 'delete.user':
    try {
        $SQL = "UPDATE kullanicilar SET isActive = 0 WHERE id = :id";
        $QUERY = $DB->prepare($SQL);
        $QUERY->bindParam(':id', $_GET['id']);  // Updated this line
        $QUERY->execute();
        $result = ['success' => true];
    } catch (PDOException $e) {
        $result = ['error' => 'Error deleting user: ' . $e->getMessage()];
    }
    break;

  case 'update.user':
    try {
        $SQL = "UPDATE kullanicilar SET adsoyad = :name, tc = :tc, age = :age, email = :email, sehir_id = :city, ders_id = :courses, parola = :password WHERE id = :id";
        $QUERY = $DB->prepare($SQL);
        $QUERY->bindParam(':name', $_GET['name']);
        $QUERY->bindParam(':tc', $_GET['tc']);
        $QUERY->bindParam(':age', $_GET['age']);
        $QUERY->bindParam(':email', $_GET['email']);
        $QUERY->bindParam(':city', $_GET['city']);
        $QUERY->bindParam(':courses', $_GET['courses']);
        $QUERY->bindParam(':password', $_GET['password']);
        $QUERY->bindParam(':id', $_GET['id']);
        $QUERY->execute();
        $result = ['success' => true];
    } catch (PDOException $e) {
        $result = ['error' => 'Error updating user: ' . $e->getMessage()];
    }
    break;
  
  default:
    $result['error'] = "Given value for method parameter is not correct!!!";
    if (!isset($_GET['method'])) {
    $result['error'] = 'Method parameter is required!!!';
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
