<?php

$DB_HOST = 'localhost'; // Database host
$DB_USER = 'root'; // Database username
$DB_PASS = ''; // Database password
$DB_NAME = 'photo_gallery'; // Database name


try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $err) {
    die("Connection failed : ". $err->getMessage());
}