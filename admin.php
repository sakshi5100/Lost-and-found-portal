<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    echo "<h2 style='text-align:center;'>Access denied. Admins only.</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h1>Admin Panel</h1>
        <div>
            <a href="home.php">Home</a>
            <a href="report_lost.php">Report Lost</a>
            <a href="report_found.php">Report Found</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="admin.php">Admin Panel</a>
            <a href="about.php">About</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>All Users</h2>
        <table>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Is Admin</th>
            </tr>
            <?php
            $users = $conn->query("SELECT * FROM users");
            while ($user = $users->fetch_assoc()) {
                echo "<tr>
                        <td>{$user['id']}</td>
                        <td>" . htmlspecialchars($user['name']) . "</td>
                        <td>{$user['email']}</td>
                        <td>{$user['contact']}</td>
                        <td>{$user['is_admin']}</td>
                      </tr>";
            }
            ?>
        </table>

        <h2 style="margin-top: 40px;">All Reported Items</h2>
        <table>
            <tr>
                <th>ID</th><th>Title</th><th>Type</th><th>Location</th><th>Date</th><th>User ID</th>
            </tr>
            <?php
            $items = $conn->query("SELECT * FROM items ORDER BY date DESC");
            while ($item = $items->fetch_assoc()) {
                echo "<tr>
                        <td>{$item['id']}</td>
                        <td>" . htmlspecialchars($item['title']) . "</td>
                        <td>{$item['type']}</td>
                        <td>" . htmlspecialchars($item['location']) . "</td>
                        <td>{$item['date']}</td>
                        <td>{$item['user_id']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
