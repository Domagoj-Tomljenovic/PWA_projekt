<?php
session_start();
include 'db_connection.php';


if (isset($_SESSION['je_admin']) && $_SESSION['je_admin']) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $article_id = $_POST['article_id'];

        
        $sql = "DELETE FROM articles WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $article_id);
        
        if ($stmt->execute()) {
            header('Location: index.php');
        } else {
            echo "Greška prilikom brisanja članka.";
        }

        $stmt->close();
    }
} else {
    echo "Nemate ovlasti za brisanje članka.";
}

$conn->close();
?>
