<?php
session_start();

// Include the database configuration
@include 'config.php';

// Ensure database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize an error array
$errors = [];

// Get the inputs

$currentpassword = $_POST['currentpassword'];
$cpassword = $_POST['cpassword'];
$newpassword = $_POST['newpassword'];

$email = $_SESSION["email"];

// Validate session and email
if (!$email) {
    $errors[] = "Session expired or unauthorized access.";
}

// Validate password
if (empty($newpassword) || empty($cpassword)) {
    $errors[] = "Both password fields are required.";
} elseif ($newpassword !== $cpassword) {
    $errors[] = "Passwords do not match.";
} elseif (strlen($newpassword) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
}

// Check if there are validation errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit();
}

// Hash the password
$hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

// Update the password in the database
$sql = "UPDATE account SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $hashed_password, $email);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to Home.php after success
        header('Location: Home.php');
        exit();
    } else {
        echo "Error updating password: Please try again later.";
        // Optionally, log error details
        error_log("Database error: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing the query.";
    // Optionally, log error details
    error_log("Preparation error: " . $conn->error);
}

// Close the database connection
$conn->close();
?>