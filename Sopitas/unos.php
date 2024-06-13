<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Unos novog članka</title>
</head>
<body>
    <header>
        <img src="pngegg.png" alt="" class="headImg">
        <nav>
            <a href="index.php">HOME</a>
            <a href="music.php">MUSIC</a>
            <a href="sport.php">SPORT</a>
            <a href="#">ADMINISTRATION</a>
            <?php if (isset($_SESSION['je_admin']) && $_SESSION['je_admin']) : ?>
                <a href="logout.php">LOGOUT</a>
            <?php endif; ?>
        </nav>
    </header>
    <section class="unos">
        <h2>Unos novog članka</h2>
            <form id="articleForm" action="skripta.php" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm()">
                <label for="title">Naslov:</label><br>
                <input type="text" id="title" name="title" ><br><br>
                
                <label for="datum">Datum unosa:</label><br>
                <input type="date" id="datum" name="datum"><br><br>

                <label for="summary">Sažetak:</label><br>
                <textarea id="summary" name="summary" rows="4"></textarea><br><br>
                
                <label for="content">Tekst članka:</label><br>
                <textarea id="content" name="content" rows="20"></textarea><br><br>
                
                <label for="category">Kategorija:</label><br>
                <select id="category" name="category" >
                    <option value="muzika">Muzika</option>
                    <option value="sport">Sport</option>
                </select><br><br>
                
                <label for="image">Slika:</label><br>
                <input type="file" id="image" name="image" accept="image/*" ><br>
                
                
                <button type="submit">Objavi članak</button>
            </form>

            <div id="response"></div>
    </section>
    <footer>
        <p>Autor: Domagoj Tomljenovic</p>
        <p>Kontakt: dtomljeno@tvz.hr</p>
        <p>Godina izrade stranice: 2024</p>
    </footer>

    <script>
        function validateForm() {
            var isValid = true;
            var title = document.getElementById("title").value.trim();
            var datum = document.getElementById("datum").value.trim();
            var summary = document.getElementById("summary").value.trim();
            var content = document.getElementById("content").value.trim();
            var category = document.getElementById("category").value;
            var imageInput = document.getElementById("image");
            var responseDiv = document.getElementById("response");
            responseDiv.innerHTML = "";

            document.getElementById("title").classList.remove("error-field");
            document.getElementById("datum").classList.remove("error-field");
            document.getElementById("summary").classList.remove("error-field");
            document.getElementById("content").classList.remove("error-field");
            document.getElementById("category").classList.remove("error-field");
            document.getElementById("image").classList.remove("error-field");

            var maxFileSize = 1 * 1024 * 1024; 
            if (imageInput.files.length > 0) {
                var fileSize = imageInput.files[0].size;
                if (fileSize > maxFileSize) {
                    responseDiv.innerHTML = "Slika ne sme biti veća od 1 MB.<br>";
                    imageInput.classList.add("error-field");
                    isValid = false;
                }
            }

            if (title === "" || title.length < 5 || title.length > 30) {
                responseDiv.innerHTML += "Naslov mora imati 5 do 30 znakova.<br>";
                document.getElementById("title").classList.add("error-field");
                isValid = false;
            }

            if (datum === "") {
                responseDiv.innerHTML += "Datum unosa je obavezan.<br>";
                document.getElementById("datum").classList.add("error-field");
                isValid = false;
            }

            if (summary === "" || summary.length < 10 || summary.length > 100) {
                responseDiv.innerHTML += "Sažetak mora imati 10 do 100 znakova.<br>";
                document.getElementById("summary").classList.add("error-field");
                isValid = false;
            }

            if (content === "" || content.length < 20) {
                responseDiv.innerHTML += "Tekst članka mora imati najmanje 20 znakova.<br>";
                document.getElementById("content").classList.add("error-field");
                isValid = false;
            }

            if (category === "") {
                responseDiv.innerHTML += "Molimo odaberite kategoriju.<br>";
                document.getElementById("category").classList.add("error-field");
                isValid = false;
            }

            if (imageInput.value.trim() === "") {
                responseDiv.innerHTML += "Molimo odaberite sliku.<br>";
                imageInput.classList.add("error-field");
                isValid = false;
            }

            return isValid;
        }
    </script>

</body>
</html>