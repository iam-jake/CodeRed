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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="codered.css">
    <link rel="stylesheet" href="RED.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <title>Home</title>
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
                        <a href="Home" class="nav-link active"><h5>Home</h5></a>
 			<a href="SetupProfile" class="nav-link"><h5>Account Settings</h5></a>
                        <a href="Modules" class="nav-link"><h5>Modules</h5></a>
			<a href="Charts" class="nav-link"><h5>Scores</h5></a>
                        <a href="index" class="nav-link"><h5>Sign Out</h5></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <section class="col-md-9 mt-1">
        <div class="logo">
           <div class="d-flex justify-content-center align-items-center"> <img src="img/out.png" alt="out" width= 320px height= 320px ></div>
            <h2 class="d-flex justify-content-center align-items-center">Welcome</h2>
            <h2 class="d-flex justify-content-center align-items-center">to</h2>
            <h1 class="d-flex justify-content-center align-items-center">CODE R.E.D</h1>    
    </section>
    </div>
<hr style="border: none; margin-top:50px; margin-bottom:1px;">	
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="1500">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img id="slide1" src="img/training1.jpg" class="d-block w-100 carousel-image" alt="Slide 1" style="height:300px">
        </div>
        <div class="carousel-item">
            <img id="slide2" src="img/training2.jpg" class="d-block w-100 carousel-image" alt="Slide 2" style="height:300px">
        </div>
        <div class="carousel-item">
            <img id="slide3" src="img/drill.jpg" class="d-block w-100 carousel-image" alt="Slide 3" style="height:300px">
        </div>
    </div>
    </div>
    <hr style="border: none; margin-top:1px; margin-bottom:1px;">
<img src="img/out.png" alt="out" style="display: block;  margin:auto; width:100px; height:=100px; margin-top:100px; margin-bottom:10px;">
        <div class="about"> 
        <h2 style="text-align:center; font-weight:700;">About Us</h2>
        <h5 class="text-secondary" style="text-align: center; max-width: 1200px; margin: 0 auto 100px;">Code R.E.D is a system designed by the BSIT students of CSTC Sariaya Inc. with the goal of teaching people fire and earthquake safety.</h5>
        <h2 style="text-align:center; font-weight:700;">Our Purpose</h2>
        <h5 class="text-secondary" style="text-align: center; max-width: 1200px; margin: 0 auto 100px;">Code R.E.D promotes fire and earthquake safety while teaching proper safety actions and procedures in such events. In coordination with the Bureau of Fire Protection, our goal is to give you the information you'll need during fire and earthquake emergencies with less cost, less personnel involved and even lesser risks.</h5>
        <h2 style="text-align:center; font-weight:700;">Increase Awareness</h2>
        <h5 class="text-secondary" style="text-align: center; max-width: 1200px; margin: 0 auto 100px;">Code R.E.D aims to educate the people about fire and earthquake safety firsthand through a virtual simulation system that will teach them all about the proper actions and procedures during fire and earthquake emergencies.</h5>
        <h5 class="text-primary" style="text-align: center; max-width: 1200px; margin: 0 auto 100px;">Code R.E.D © 2024</h5>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('.carousel-control-prev').addEventListener('click', function() {
            var carousel = document.querySelector('#carouselExampleFade');
            var bsCarousel = bootstrap.Carousel.getInstance(carousel);
            bsCarousel.prev();
        });

        document.querySelector('.carousel-control-next').addEventListener('click', function() {
            var carousel = document.querySelector('#carouselExampleFade');
            var bsCarousel = bootstrap.Carousel.getInstance(carousel);
            bsCarousel.next();
        });
        
    </script>
</body>
</html>
