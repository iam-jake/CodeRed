<?php
@include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    // Sanitize the email input to avoid XSS attacks
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Plain password entered by user

    // Assuming $conn is your database connection
    $stmt = $conn->prepare("SELECT email, password, username, Admin FROM account WHERE email = ?;");
    $stmt->bind_param("s", $email); // Bind email only for the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Check if the password matches the hashed password stored in the database
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['Admin'] = $row['Admin'];

            // Redirect based on user role
            if ($_SESSION['Admin'] === 'Admin') {
                header('Location: Home');
                exit();
            } else {
                header('Location: UserDashboard');
                exit();
            }
        } else {
            // Password doesn't match
            $error[] = 'Incorrect email or password';
        }
    }

    $stmt->close(); // Close the prepared statement
}

// Display errors if any
if (!empty($error)) {
    foreach ($error as $err) {
        echo "<p style='color: red;'>$err</p>";
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
<h1 class="fs-1">Log in</h1>
<?php
if(isset($error)){
    foreach($error as $error){
        echo '<span>'.$error.'</span>';
    }
}
?>

<div class="ms-2 ">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Email</label>
    <input type="email" name="email" placeholder="Enter your Email" class="mb-3 form-control"required>
</div>
<div class="ms-2">
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Password</label>
    <input type="password" name="password" placeholder="Enter your Password" class="mb-3 form-control" required>
</div>

<div class="remember-forgot">
    <label><input type="checkbox" class="ms-2 me-2">Remember Me</label>
    <a href="Forgot_password.php" class="me-2">Forgot Password?</a>
</div>
<input type="submit" value="Sign in" name="submit" class="btn" style="background-color: maroon; width: 100px; height: 50px; border-radius:15%;  font-weight: 900; color:white; font-size: 20px;">
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
