<?php
$host = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "form_example";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $DB = $conn; // Set $DB to the connection variable
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}