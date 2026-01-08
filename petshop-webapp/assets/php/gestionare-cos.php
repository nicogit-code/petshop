<?php
include 'config.php';

// 1. Ștergere produs individual
if (isset($_GET['sterge'])) {
    $id_produs = intval($_GET['sterge']);
    if (isset($_SESSION['cart'][$id_produs])) {
        unset($_SESSION['cart'][$id_produs]);
    }
}

// 2. Actualizare cantitate din dropdown
if (isset($_POST['update_qty'])) {
    $id_produs = intval($_POST['id_produs']);
    $noua_cantitate = intval($_POST['cantitate']);
    
    if (isset($_SESSION['cart'][$id_produs]) && $noua_cantitate > 0) {
        $_SESSION['cart'][$id_produs]['cantitate'] = $noua_cantitate;
    }
}

header("Location: cos-cumparaturi.php");
exit();