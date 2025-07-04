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

<h1 class="fs-1">Forgot Password</h1>
<?php
if(isset($error)){
    foreach($error as $error){
        echo '<span>'.$error.'</span>';
    }
}
?>

<div class="ms-2 ">
    <form action="send.php" method='post'>
    <label for="exampleInputEmail1" class="form-label justify-content-start d-flex">Enter your Email Address</label>
    <input type="email" name="email" placeholder="Enter your Email" class="mb-3 form-control"required>
</div>
<p>We'll send your recovery link through your gmail</p>
<button class='btn btn-lg-primary' name="send">Send Link</button>
</form>
<div class="register my-2">
    dont have an Account? <a href="signup">Sign up</a>
</div>
</div>
</div>
</div>
</div>
</body>
</html>