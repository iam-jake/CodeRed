<?php
session_start();
require 'config.php'; // Include your database connection

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    // Validate passwords
    if ($newpassword !== $confirmpassword) {
        echo "Passwords do not match.";
        exit;
    }

    if (strlen($newpassword) < 8) {
        echo "Password must be at least 8 characters long.";
        exit;
    }

    // Optional: Add regex for stronger password requirements
    // if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/', $newpassword)) {
    //     echo "Password must contain at least one letter, one number, and be at least 8 characters long.";
    //     exit;
    // }

    // Hash the new password
    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

    // Update password in the database
    $stmt = $conn->prepare("UPDATE account SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        echo "Password has been reset successfully.";
        session_destroy(); // Destroy session to log the user out
        header("Location: index.php?message=PasswordResetSuccess"); // Redirect with a success message
        exit;
    } else {
        echo "Failed to reset password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="RED.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Log in</title>
</head>
<body>
<div class="Page">
<div class="background-image">
<div class="Login">
<div class="wrapper">
<form method="post" enctype="multipart/form-data">
<h1 class="fs-1">Reset Password</h1>
<?php
if(isset($error)){
    foreach($error as $error){
        echo '<span>'.$error.'</span>';
    }
}
?>
<div class="ms-2 ">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Enter Email Address</label>
    <input type="email" name="email" placeholder="Enter New Password" class="mb-3 form-control"required>
</div>
<div class="ms-2 ">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Enter New Password</label>
    <input type="password" name="newpassword" placeholder="Enter New Password" class="mb-3 form-control"required>
</div>
<div class="ms-2">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Password</label>
    <input type="password" name="confirmpassword" placeholder="Confirm Password" class="mb-3 form-control" required>
</div>

<div class="remember-forgot">
    <label><input type="checkbox" class="ms-2 me-2">Remember Me</label>
    <a href="Forgot_password" class="me-2">Forgot Password?</a>
</div>
<input type="submit" value="Confirm Changes" name="submit" class="btn" style="background-color: maroon; width: 100px; height: 50px; border-radius:15%;  font-weight: 900; color:white; font-size: 20px;">
<div class="register my-2">
    dont have an Account? <a href="signup">Sign up</a>
</div>

</form>
</div>
</div>
</div>
</div>
</body>
</html>