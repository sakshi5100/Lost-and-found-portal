<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Item ID not provided.";
    exit();
}

$item_id = $_GET['id'];

// Fetch item and reporter info
$sql = "SELECT items.*, users.name, users.email, users.contact
        FROM items
        JOIN users ON items.user_id = users.id
        WHERE items.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Item not found.";
    exit();
}

$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2><?php echo htmlspecialchars($item['title']); ?></h2>
        <img src="uploads/<?php echo $item['image']; ?>" height="200"><br><br>
        <strong>Type:</strong> <?php echo ucfirst($item['type']); ?><br>
        <strong>Description:</strong> <?php echo nl2br(htmlspecialchars($item['description'])); ?><br>
        <strong>Location:</strong> <?php echo htmlspecialchars($item['location']); ?><br>
        <strong>Date Reported:</strong> <?php echo $item['date']; ?><br><br>
        <h3>Contact Reporter</h3>
        <strong>Name:</strong> <?php echo $item['name']; ?><br>
        <strong>Email:</strong> <?php echo $item['email']; ?><br>
        <strong>Phone:</strong> <?php echo $item['contact']; ?><br>
    </div>
</body>
</html>
