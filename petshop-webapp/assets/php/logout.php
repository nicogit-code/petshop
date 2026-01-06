<?php
session_start();
session_destroy(); // Șterge toate datele sesiunii
header("Location: login.php"); // Trimite userul înapoi la login
exit();
?>