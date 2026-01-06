<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id_produs = intval($_GET['id']);
    
    $res = $conn->query("SELECT * FROM produse WHERE id = $id_produs");
    $p = $res->fetch_assoc();

    if ($p) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id_produs])) {
            $_SESSION['cart'][$id_produs]['cantitate']++;
        } else {
            $_SESSION['cart'][$id_produs] = [
                'nume' => $p['nume_produs'],
                'pret' => ($p['pret_discount'] > 0) ? $p['pret_discount'] : $p['pret'],
                'imagine' => $p['imagine'],
                'cantitate' => 1
            ];
        }
        // DEBUG: Afișăm ce avem în coș și oprim execuția ca să vedem rezultatul
        // echo "<pre>"; print_r($_SESSION['cart']); echo "</pre>"; die("Produs adaugat!");
    } else {
        die("Eroare: Produsul cu ID-ul $id_produs nu a fost gasit in baza de date.");
    }
} else {
    die("Eroare: Nu a fost trimis niciun ID.");
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();