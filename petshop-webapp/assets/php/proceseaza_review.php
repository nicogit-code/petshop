<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produs = intval($_POST['id_produs']);
    $nume = $conn->real_escape_string($_POST['nume_utilizator']);
    $comentariu = $conn->real_escape_string($_POST['comentariu']);

    if (!empty($nume) && !empty($comentariu)) {
        $sql = "INSERT INTO reviewuri (id_produs, nume_utilizator, comentariu) 
                VALUES ('$id_produs', '$nume', '$comentariu')";

        if ($conn->query($sql) === TRUE) {
            // Ne întoarcem la pagina produsului cu un mesaj de succes
            header("Location: product-page.php?id=" . $id_produs . "&success=1#review-tab");
            exit();
        } else {
            echo "Eroare la salvarea review-ului: " . $conn->error;
        }
    } else {
        echo "Te rugăm să completezi toate câmpurile.";
    }
} else {
    header("Location: ../../index.php");
    exit();
}
?>