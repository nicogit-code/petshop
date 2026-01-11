<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    
    $id_produs = intval($_POST['id_produs']);
    $id_utilizator = $_SESSION['user_id']; // Luam ID-ul din sesiune
    $nota = intval($_POST['nota']);
    $comentariu = $conn->real_escape_string($_POST['comentariu']);

    // Inseram id_utilizator
    $sql = "INSERT INTO reviewuri (id_produs, id_utilizator, nota, comentariu) 
            VALUES ($id_produs, $id_utilizator, $nota, '$comentariu')";

    if ($conn->query($sql)) {
        // Ne intoarcem la pagina produsului cu un mesaj de succes
        header("Location: product-page.php?id=" . $id_produs . "&success=1#tab-review");
    } else {
        echo "Eroare la salvarea review-ului: " . $conn->error;
    }
} else {
    echo "Acces neautorizat. Trebuie să fii logat.";
}
?>