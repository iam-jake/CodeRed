
<?php

@include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    // Database connection assumed as $conn
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword']; // Confirm password field
   $admin = $_POST['admin'];
    $error = []; // Initialize an empty error array

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Invalid email format.';
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        $error[] = 'Passwords do not match.';
    }

    // Check password strength (optional)
    if (strlen($password) < 8) {
        $error[] = 'Password must be at least 8 characters long.';
    }

    if (empty($error)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the user already exists
        $stmt = $conn->prepare("SELECT * FROM account WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error[] = 'User already exists.';
        } else {
            // Insert new user into the database without a profile image
            $stmt = $conn->prepare("INSERT INTO account (username, email, password,Admin) VALUES (?, ?, ?,?)");
            $stmt->bind_param("ssss", $username, $email, $hashed_password,$admin);

            if ($stmt->execute()) {
                // Optionally, log the user in by setting session variables
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                // Redirect to index page after successful registration
                header('Location: index.php');
                exit();
            } else {
                $error[] = 'Failed to create account. Please try again later.';
            }
        }
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
    <title>Sign Up</title>
</head>
<body>
<div class="Page">
<div class="background-image">    
<div class="Login"> 
<div class="wrapper" style="padding-left:25px; padding-right:25px;">
<form method="post" enctype="multipart/form-data">
<h2  class="fs-1 pt-3">Sign Up</h2>
<?php
if(isset($error)){
    foreach($error as $error){
        echo '<span>'.$error.'</span>';
    }
}
?>
<div class="">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Username</label>
    <input type="text" name="username" placeholder="Enter your Full Name" class="mb-3 form-control" required>
<div class="">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Email</label>
    <input type="email" name="email" placeholder="Enter your Email" class="mb-3 form-control"required>
</div>
<div class="">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Password</label>
    <input type="password" name="password" placeholder="Enter your Password" class="mb-3 form-control" required>
</div>
<div class="">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Confirm Password</label>
    <input type="password" name="cpassword" placeholder="Confirm your Password" class="mb-3 form-control" required>
</div>
<div class="mb-3">
<label >are you an admin?</label>
<div class="form-check form-check-inline">
    
  <input class="form-check-input" type="radio" name="admin" id="inlineRadio1" value="Admin" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="admin" id="inlineRadio2" value="NotAdmin" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
</div>
</div>
<div class="remember-forgot">
    <label><input type="checkbox" class="me-2">I read and Accept the Terms and conditions</label>
</div>
<input type="submit" value="Sign up" name="submit" class="btn" style="background-color: maroon; width: 100px; height: 50px; border-radius:15%;  font-weight: 900; color:white; font-size: 20px;">
<div class="register mb-3 mt-3">
    Already have an Account? <a href="index">Sign In</a>
</div>

</form>
</div>
</div>
</div>
</div>
</body>
</html>
