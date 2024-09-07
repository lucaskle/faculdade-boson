<?php
$dsn = 'mysql:host=database;port=3306;dbname=lamp';
$username = 'lamp';
$password = 'lamp';

try {
    $dbh = new PDO($dsn, $username, $password);
    echo "Connected to database successfully!";
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
