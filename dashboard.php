<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>My Reported Items</h2>
        <div class="item-grid">
        <?php
        $query = $conn->prepare("SELECT * FROM items WHERE user_id = ? ORDER BY date DESC");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<div class='item-card'>";
            echo "<img src='uploads/{$row['image']}' height='100'><br>";
            echo "<strong>{$row['title']}</strong><br>";
            echo ucfirst($row['type']) . " - {$row['location']}<br>";
            echo "<a href='item_detail.php?id={$row['id']}'>Details</a>";
            echo "</div>";
        }
        ?>
        </div>
    </div>
</body>
</html>
