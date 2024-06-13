<?php
include 'db_connection.php';

$title = $_POST['title'];
$summary = $_POST['summary']; 
$content = $_POST['content'];
$category = $_POST['category'];
$datum = $_POST['datum']; 

$image = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $image = file_get_contents($_FILES['image']['tmp_name']);
}


$stmt = $conn->prepare("INSERT INTO articles (title, datum, summary, content, category, image) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssb", $title, $datum, $summary, $content, $category, $image); 


if ($image !== null) {
    $stmt->send_long_data(5, $image); 
}

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: index.php");
exit();
?>