<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_BCRYPT);
    $ime = $_POST['ime'];

    $stmt = $conn->prepare("SELECT COUNT(*) FROM korisnici WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $_SESSION['error'] = "Korisničko ime već postoji. Molimo izaberite drugo korisničko ime.";
    } else {
    
        $stmt = $conn->prepare("INSERT INTO korisnici (korisnicko_ime, lozinka, ime) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $korisnicko_ime, $lozinka, $ime);

        if ($stmt->execute()) {
  
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['error'] = "Greška: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    header('Location: registracija.php');
    exit();
}
?>
