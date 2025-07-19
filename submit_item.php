<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$type = $_POST['type'];
$location = $_POST['location'];
$date = $_POST['date'];

$imageName = "";
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetDir = "uploads/" . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir);
}

$stmt = $conn->prepare("INSERT INTO items (user_id, title, description, type, location, date, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssss", $user_id, $title, $description, $type, $location, $date, $imageName);
$stmt->execute();

header("Location: home.php");
exit();
?>
