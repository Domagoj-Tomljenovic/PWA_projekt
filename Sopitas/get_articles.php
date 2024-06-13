<?php

include 'db_connection.php';


$sql = "SELECT * FROM articles ORDER BY id DESC";
$result = $conn->query($sql);


$music_articles = "";
$sport_articles = "";


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $article = "<article style='margin-right:20px;margin-top:20px; text-align: center;'>";
    
        if (!empty($row["image"])) {
            $article .= "<img src='data:image/jpeg;base64," . base64_encode($row["image"]) . "' alt='Slika članka' style='width:10vw;height:auto; max-height: 15vh; max-width: 25vh;'>";
        }
        $article .= "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
        $article .= "<p>" . date('d.m.Y', strtotime($row['datum'])) . "</p>";
        $article .= "<a href='clanak.php?id=" . $row["id"] . "'>Pročitaj više</a>";
        if (isset($_SESSION['je_admin']) && $_SESSION['je_admin']) {
            $article .= "<form class='indexForm' method='POST' action='delete_article.php' onsubmit='return confirmDelete();'>";
            $article .= "<input type='hidden' name='article_id' value='" . $row["id"] . "'>";
            $article .= "<button type='submit'>Obriši</button>";
            $article .= "</form>";
        }
        $article .= "</article>";

        if ($row["category"] == "muzika") {
            $music_articles .= $article;
        } elseif ($row["category"] == "sport") {
            $sport_articles .= $article;
        }
    }
} else {
    $music_articles = "Nema članaka.";
    $sport_articles = "Nema članaka.";
}

$conn->close();
?>