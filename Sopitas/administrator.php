<?php
session_start();

if (!isset($_SESSION['korisnicko_ime']) || !$_SESSION['je_admin']) {
    echo "Nemate pravo pristupa ovoj stranici. <a href='login.php'>Prijavite se</a> ili se <a href='registracija.php'>registrirajte</a>.";
    exit();
}

header("Location: unos.php")

?>