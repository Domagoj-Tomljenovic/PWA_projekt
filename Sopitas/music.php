<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sopitas</title>
</head>
<body>
    <header>
        <img src="pngegg.png" alt="" class="headImg">
        <nav>
            <a href="index.php">HOME</a>
            <a href="#">MUSIC</a>
            <a href="sport.php">SPORT</a>
            <?php if (isset($_SESSION['je_admin']) && $_SESSION['je_admin']) : ?>
                <a href="unos.php">ADMINISTRATION</a>
            <?php else : ?>
                <a href="login.php">ADMINISTRATION</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['je_admin']) && $_SESSION['je_admin']) : ?>
                <a href="logout.php">LOGOUT</a>
            <?php endif; ?>
        </nav>
    </header>

    <?php include 'get_articles.php'; ?>

    <section class="musicSection" style="height:73vh">
        <h2 class="music">MUSIC</h2>
        <div id="muzika-sekcija">
            <?php echo $music_articles; ?>
        </div>
    </section>  
    <footer>
        <p>Autor: Domagoj Tomljenovic</p>
        <p>Kontakt: dtomljeno@tvz.hr</p>
        <p>Godina izrade stranice: 2024</p>
    </footer>
</body>
</html>