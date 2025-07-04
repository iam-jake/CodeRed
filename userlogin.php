<?php
session_start();
$host = '127.0.0.1';
$db = 'u675483276_user_info';
$user = 'u675483276_CodeRedDB';
$pass = 'CodeRedDB1991';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill out all fields.";
        header("Location: login.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT username, password, profile_image FROM account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_image'] = $user['profile_image']; // Make sure this is set
            header("Location: Home.php"); // Redirect to Home.php
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No user found with that username.";
        header("Location: login.php");
        exit();
    }
    $stmt->close();
}

$conn->close();
