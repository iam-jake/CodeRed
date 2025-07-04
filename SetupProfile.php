<?php
session_start();

@include 'config.php';
// Get the user's details from the session

if(!isset($_SESSION['email'])){
    session_destroy();
   header("Location: index");
   exit();
}

$username_ = $_SESSION['username'] ?? 'N/A';
$email_ = $_SESSION['email'] ?? 'N/A';
$phone_ = $_SESSION['phone'] ?? 'N/A';
$establishment_ = $_SESSION['establishment'] ?? 'N/A';
$address_ = $_SESSION['address'] ?? 'N/A';

$sql = "select * from account where email='$email_'";

$result = $conn->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();

$phone = $row['phone'];
$establishment = $row["establishment"];
$address = $row["address"];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 </head>
<body>
    <div class="row nav">
        <div class="col-md-2 mt-1">
            <div class="cardtextcntrsidebar navbar navbar-expand-lg bg-body-tertiary">
                <div class="card-body">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="mt-1">
                        <h3 class="mt-1"><?php echo htmlspecialchars($username); ?></h3>
                        <hr>
                        <a href="Home" class="nav-link"><h5>Home</h5></a>
 			<a href="SetupProfile" class="nav-link active"><h5>Account Settings</h5></a>
                        <a href="Modules" class="nav-link"><h5>Modules</h5></a>
			<a href="Charts.php" class="nav-link"><h5>Scores</h5></a>
                        <a href="index" class="nav-link"><h5>Sign Out</h5></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="card mb-3 content">
                <h3 class="m-3 pt-3">Setup Your Profile</h3>
                <?php
if(isset($error)){
    foreach($error as $error){
        echo '<span>'.$error.'</span>';
    }
}
?>
                <div class="card-body">
                    <form action="Setup_Profile.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="username" class="col-md-3 col-form-label">Username</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username_); ?>" disabled readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email_); ?>" disabled readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-md-3 col-form-label">Current Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="phone" name="currentpassword" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="establishment" class="col-md-3 col-form-label">New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="establishment" name="newpassword" value="" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-3 col-form-label">Confirm Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="address" name="cpassword" value="">
                            </div>
                        </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn -primary">Save Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
