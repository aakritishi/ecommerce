<?php
    include('../includes/connect.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-com</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60px; /* Adjust height as needed */
        }
    </style>
</head>
<body>
     <div class="container-fluid p-0 text-white">
     <!-- header -->
     <nav class="navbar navbar-expand-lg bg-primary bg-gradient">
        <div class="container-fluid">
            <img src="../images/logo.png" class="logo" alt="Logo"/>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active h4" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link h4 fw-normal" href="../display_products.php">Products</a>
                </li>
                <?php 
                if(!isset($_SESSION['username'])){
                    echo"
                        <li class='nav-item'>
                            <a class='nav-link h4' href='./user_panel/user_registration.php'>Register</a>
                        </li>
                    ";
                }
                else{
                    echo"
                        <li class='nav-item'>
                            <a class='nav-link h4' href='./user_panel/profile.php'>My Account</a>
                        </li>
                    ";
                }
                ?>
                <li class="nav-item">
                <a class="nav-link h4" href="/">Contact</a>
                </li>
                
            </ul>
            </div>
        </div>
     </nav>

    <!-- user name and login section here -->
    <nav class="navbar navbar-extend-lg navbar-dark bg-dark bg-gradient">
        <ul class="navbar-nav me-auto flex-lg-row flex-column gap-lg-3 px-2">
            <?php 
                if(!isset($_SESSION['username'])){
                    echo"<li class='nav-item'>
                            <a class='nav-link' href='/'>Welcome users</a>
                        </li>";
                }
                else{
                    echo"
                        <li class='nav-item'>
                            <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                        </li>";
                    }
            ?>
            <?php 
                if(!isset($_SESSION['username'])){
                    echo"<li class='nav-item'>
                            <a class='nav-link' href='user_login.php'>Login</a>
                        </li>";
                }
                else{
                    echo"
                    <li class='nav-item'>
                        <a class='nav-link' href='user_logout.php'>Logout</a>
                    </li>";
                }
            ?>
            
        </ul>
    </nav>

    <!-- body section where product heading is being displayed -->
    <div class="bg-light">
        <!-- <h3 class="text-center text-black">Checkout Page</h3> -->
    </div>

    <!-- checkout section here -->
    <div class="re px-1">
        <div class="col-md-12">
            <div class="row">
                <?php
                if(!isset($_SESSION['username'])){
                    include('user_login.php');
                }
                else{
                    include('payment.php');
                }
                ?>
            </div>
        </div>
    </div>

     <!-- footer -->
     <div class="bg-primary bg-gradient text-center p-3 footer">
        <p>Footer section</p>
    </div>
    </div>
    <!-- bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>