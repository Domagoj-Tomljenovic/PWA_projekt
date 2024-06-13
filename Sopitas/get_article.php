<?php
echo '<link rel="stylesheet" href="style.css">';

include 'db_connection.php';


$article_id = intval($_GET['id']); 


$sql = "SELECT * FROM articles WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row["image"])) {
        echo "<img src='data:image/jpeg;base64," . base64_encode($row["image"]) . "' alt='Slika članka''>";
    }
    echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
    echo "<p>" . nl2br(htmlspecialchars($row["content"])) . "</p>";
} else {
    echo "Članak nije pronađen.";
}

$stmt->close();
$conn->close();
?>
