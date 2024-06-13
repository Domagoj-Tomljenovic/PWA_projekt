<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registracija</title>
</head>
<body>
    <header>
        <img src="pngegg.png" alt="" class="headImg">
        <nav>
            <a href="index.php">HOME</a>
            <a href="music.php">MUSIC</a>
            <a href="sport.php">SPORT</a>
            <a href="login.php">ADMINISTRATION</a>
        </nav>
    </header>
    <section style="height:73vh;">
        <h2>Registracija korisnika</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='error'>";
            echo "<h2>Greška</h2>";
            echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
            echo "</div>";
            unset($_SESSION['error']);
        }
        ?>
        <form id="registrationForm" action="register_user.php" method="POST">
            <label for="korisnicko_ime">Korisničko ime:</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
            <br>
            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required>
            <br>
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime" required>
            <br>
            <input type="submit" value="Registriraj se">
            <button><a href="login.php">Prijavi se</a></button>
        </form>
    </section>
    <footer>
        <p>Autor: Domagoj Tomljenovic</p>
        <p>Kontakt: dtomljeno@tvz.hr</p>
        <p>Godina izrade stranice: 2024</p>
    </footer>
</body>
</html>