<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- style -->
    <link rel="stylesheet" href="../style.css"/>
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .adminimg{
            width: 100px;
            object-fit: cover;
        }
        .manage-details{
            overflow-y:hidden;
        }
        .edit-products{
            overflow-y:hidden;
        }
        .edit-img{
            width:100px;
            object-fit:contain;
        }
    </style>
</head>
<body>
     <div class="container-fluid p-0">
     <!-- header for admin -->
        <nav class="nav-bar navbar-expand-lg navbar-light bg-primary bg-gradient">
            <div class="container-fluid d-flex justify-content-between align-items-center px-4 mx-auto">
                <img src="../images/logo.png" class="logo" alt="logo"/>
                <nav class="nav-bar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link text-white">Welcome Admin</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

    <!-- another section to show manage details text-->
        <div class="text-center p-2 my-2">
            <h3 class="manage-details">Manage Details</h3>
        </div>

    <!-- button section for performing crud operation -->
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-12 bg-dark bg-gradient p-3 d-flex mx-auto">
                <div class="">
                    <a href=""><img src="../images/uni-t.jpg" alt="" class="adminimg"/></a>
                    <p class="text-light text-center">AdminName</p>
                </div>
                <div class="button text-center m-1">
                    <!-- emmit to display 10 buttons directly => button*10>a.nav-link.tetx-light.bg-primary.bg-gradient.p-2 -->
                    <button class=my-2><a href="insert_products.php" class="nav-link text-light bg-primary bg-gradient p-2">Insert products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-primary bg-gradient p-2">View Products</a></button>
                    <button><a href="index.php?insert_categories" class="nav-link text-light bg-primary bg-gradient p-2">Insert Category</a></button>
                    <!-- <button><a href="" class="nav-link text-light bg-primary bg-gradient p-2">View Category</a></button> -->
                    <button><a href="index.php?insert_brands" class="nav-link text-light bg-primary bg-gradient p-2">Insert Brands</a></button>
                    <!-- <button><a href="" class="nav-link text-light bg-primary bg-gradient p-2">View Brands</a></button> -->
                    <button><a href="index.php?all_orders" class="nav-link text-light bg-primary bg-gradient p-2">All orders</a></button>
                    <button><a href="" class="nav-link text-light bg-primary bg-gradient p-2">All payments</a></button>
                    <button><a href="" class="nav-link text-light bg-primary bg-gradient p-2">List users</a></button>
                    <button><a href="" class="nav-link text-light bg-primary bg-gradient p-2">Logout</a></button>
                </div>
            </div>
        </div>
     </div>

    <!-- redirection panel -->
     <div class="container my-4">
        <?php
            if(isset($_GET['insert_categories'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brands'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if(isset($_GET['delete_products'])){
                include('delete_products.php');
            }
            if(isset($_GET['all_orders'])){
                include('all_orders.php');
            }
        ?>
     </div>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>