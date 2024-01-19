<?php

// Set necessary headers to prevent CORS errors (if required for security reasons)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'db.php';

// Retrieve data from POST request
$data = json_decode(file_get_contents("php://input"), true); // Convert to array with `true`. If `true` is not sent, it remains as an object.
    
$result = [];

switch ($_GET['method']) {
  case 'get.cities':
    $SQL = "SELECT id, city_name as name FROM cities ORDER BY name";
    $QUERY = $DB->prepare($SQL);
    $QUERY->execute();
    $result = $QUERY->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 'get.courses':
    $SQL = "SELECT id, course_name as name FROM courses ORDER BY id";
    $QUERY = $DB->prepare($SQL);
    $QUERY->execute();
    $result = $QUERY->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 'insert.user':
    $SQL = "INSERT INTO users (name, tc, age, email, city_id, course_id, password) 
        VALUES (:name, :tc, :age, :email, :city, :courses, :password)";
    $QUERY = $DB->prepare($SQL);

    // Convert courses array to comma-separated string
    $courses = implode(',', $data['courses']);
    
    $QUERY->bindParam(':name', $data['name']);
    $QUERY->bindParam(':tc', $data['tc']);
    $QUERY->bindParam(':age', $data['age']);
    $QUERY->bindParam(':email', $data['email']);
    $QUERY->bindParam(':city', $data['city']);
    $QUERY->bindParam(':courses', $courses);
    $QUERY->bindParam(':password', $data['password']);
    
    $QUERY->execute();
    $result = $QUERY->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 'get.users':
    $SQL = "SELECT id, name, tc, age, email, city_id as city, course_id as courses, password, is_active FROM users ORDER BY id";
    $QUERY = $DB->prepare($SQL);
    $QUERY->execute();
    $result = $QUERY->fetchAll(PDO::FETCH_ASSOC);
    break;
    
  case 'delete.user':
    try {
        $SQL = "UPDATE users SET is_active = 0 WHERE id = :id";
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
        $SQL = "UPDATE users SET name = :name, tc = :tc, age = :age, email = :email, city_id = :city, course_id = :courses, password = :password WHERE id = :id";
        $QUERY = $DB->prepare($SQL);
        $data['courses'] = implode(',', $data['courses']);
        $QUERY->bindParam(':name', $data['name']);
        $QUERY->bindParam(':tc', $data['tc']);
        $QUERY->bindParam(':age', $data['age']);
        $QUERY->bindParam(':email', $data['email']);
        $QUERY->bindParam(':city', $data['city']);
        $QUERY->bindParam(':courses', $data['courses']);
        $QUERY->bindParam(':password', $data['password']);
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
