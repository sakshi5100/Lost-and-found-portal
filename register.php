<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, contact, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $contact, $password);

if ($stmt->execute()) {
    echo "Registration successful. <a href='login.html'>Login now</a>";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
