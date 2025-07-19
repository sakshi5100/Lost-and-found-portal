<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Found Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Report Found Item</h2>
        <form action="submit_item.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="found">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="location" placeholder="Location" required>
            <input type="date" name="date" required>
            <input type="file" name="image">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
