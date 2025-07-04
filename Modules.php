<?php
session_start();

@include 'config.php';
// Get the user's details from the session

if(!isset($_SESSION['email'])){
    session_destroy();
   header("Location: index");
   exit();
}
$username = $_SESSION['username'] ?? 'N/A';
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width-initial scale=1">
<html>
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
 			<a href="SetupProfile" class="nav-link"><h5>Account Settings</h5></a>
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
                    <h3 class="m-3 pt-3">Bureau of Fire Protection Fire and Earthquake Safety Modules</h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>BFP Official Pages:</h5>
                            </div>
                            <hr class="pgs">
                            <div class="col-md-9">
                                <i class='bx bx-info-circle' ></i>
                            <a href="https://bfp.gov.ph/">BFP Official Website</a>
                            </div>
                            <hr class="pgs">
                            <div class="col-md-9">
                                <i class='bx bxl-tiktok' ></i>
                            <a href="https://www.tiktok.com/@bureauoffireprotection">BFP Tiktok</a>
                            </div>
                            <hr class="pgs">
                            <div class="col-md-9">
                               <i class='bx bxl-youtube' ></i>
                            <a href="https://www.youtube.com/@bureauoffireprotection9016">BFP Youtube</a>
                            </div>
                            <hr class="pgs">
                            <div class="col-md-9">
                            <i class='bx bxl-facebook-circle'></i>
                            <a href="https://www.facebook.com/DILGBFP">BFP Facebook</a>
                            </div>
                            <hr>
                            
                    <h3 class="m-3 pt-3">Modules for Fire Safety</h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Modules for Kids:</h5>
                            </div>
                                <div class="col-md-9">
                            <a href="BFP_Fire_Safety_Children_Edition">BFP Fire Safety for Children Edition</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                            <h5>Modules for Teens:</h5>
                            </div>
                            <div class="col-md-9">
                            <a href="Fire_Safety_For_Teenagers">BFP Fire Safety for Teens Edition</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-md-3">
                        <h5>Modules for Young Adults:</h5>    
                        </div>
                             <div class="col-md-9">
                            <a href="Fire_Safety_for_Young_Adult">BFP Fire Safety for Young Adults Edition</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                            <h5>Modules for General Public:</h5>
                            </div>
                            <div class="col-md-9">
                            <a href="Fire_Safety_For_General_Public">BFP Fire Safety for General Public</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                            <h5>Modules for Business and Establishments:</h5>
                            </div>
                            <div class="col-md-9">
                            <a href="Fire_Safety_For_Business_Establishment">BFP Fire Safety for Business and Establishments</a>
                            </div>
                        </div>
                    <hr>
                    </div>
                </div>
                        </div>
            </div>
            
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </body>
</html>