<?php
$servername = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "il_ilce_mahalle";

try {
  $DB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}

function DD($var)
{
  echo "<pre>";
  print_r($var);
  echo "</pre>";
}