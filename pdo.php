<?php
$servername = 'localhost';
$dbname = 'colnet';
$port = 3306;
$username = 'Osullivan';
$password = 'Osullivan2022';

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
