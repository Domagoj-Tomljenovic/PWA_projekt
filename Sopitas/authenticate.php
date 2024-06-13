<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $stmt = $conn->prepare("SELECT id, lozinka, ime, je_admin FROM korisnici WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $ime, $je_admin);
        $stmt->fetch();

        if (password_verify($lozinka, $hashed_password)) {
            $_SESSION['korisnicko_ime'] = $korisnicko_ime;
            $_SESSION['ime'] = $ime;
            $_SESSION['je_admin'] = $je_admin;

            if ($je_admin) {
                header("Location: administrator.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Neispravno korisničko ime ili lozinka.";
        }
    } else {
        $_SESSION['error'] = "Neispravno korisničko ime ili lozinka.";
    }

    $stmt->close();
    $conn->close();

    header("Location: login.php");
    exit();
}
?>