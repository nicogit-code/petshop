<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root"; 
$password = ""; // În XAMPP, parola implicita este goala
$dbname = "petshop"; // Numele bazei de date create in Workbench

// Creare conexiune
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificare existenta erori de conectare
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

// Setarea setului de caractere la UTF-8 pentru a afișa corect diacriticele (ș, ț, ă)
$conn->set_charset("utf8");

// Definire cale de bază a proiectului
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/petshop/petshop-webapp/');
}
?>