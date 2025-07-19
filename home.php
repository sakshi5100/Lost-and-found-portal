<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Lost & Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <h1>Lost & Found</h1>
        <div>
            <a href="home.php">Home</a>
            <a href="report_lost.php">Report Lost</a>
            <a href="report_found.php">Report Found</a>
            <a href="dashboard.php">Dashboard</a>
            <?php if ($is_admin): ?>
                <a href="admin.php">Admin Panel</a>
            <?php endif; ?>
            <a href="about.php">About</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container">
        <h2>Recently Reported Items</h2>
        <div class="item-grid">
            <?php
            $query = $conn->query("SELECT * FROM items ORDER BY date DESC LIMIT 6");
            while ($row = $query->fetch_assoc()) {
                echo "<div class='item-card'>";
                echo "<img src='uploads/{$row['image']}' alt='Item Image'><br>";
                echo "<strong>" . htmlspecialchars($row['title']) . "</strong><br>";
                echo ucfirst($row['type']) . "<br>";
                echo htmlspecialchars($row['location']) . "<br>";
                echo "<small>Date: " . $row['date'] . "</small><br><br>";
                echo "<a href='item_detail.php?id={$row['id']}'>View Details</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

</body>
</html>
