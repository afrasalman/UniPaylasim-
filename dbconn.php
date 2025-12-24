<?php
$host     = "localhost";
$db_name  = "unipaylasim_db";
$username = "root";
$password = "";
try {

    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(" Veritabanı bağlantı hatası!" . $e->getMessage());
}
