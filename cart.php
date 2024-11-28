<?php
    include('includes/connect.php');
    include('functions/common_function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
    <style>
        .cart_img {
            width: 80px;
            height: 80px;
        }
        table {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 text-white">
        <!-- header -->
        <nav class="navbar navbar-expand-lg bg-primary bg-gradient">
            <div class="container-fluid">
                <img src="./images/logo.png" class="logo" alt="Logo"/>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active h4" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h4 fw-normal" href="display_products.php">Products</a>
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
                        <li class="nav-item">
                            <a class="nav-link h4" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php cart_item_number(); ?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
        cart();

        if(isset($_POST['continue_shopping'])){
            echo"<script>window.open('index.php','_self')</script>";
        }

        if(isset($_POST['checkout_page'])){
            echo"<script>window.open('./user_panel/checkout.php','_self')</script>";
        }
        ?>

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
                            <a class='nav-link' href='/'>Welcome ".$_SESSION['username']."</a>
                        </li>";
                    }
                ?>
                <?php 
                if(!isset($_SESSION['username'])){
                    echo"<li class='nav-item'>
                            <a class='nav-link' href='./user_panel/user_login.php'>Login</a>
                        </li>";
                }
                else{
                    echo"
                    <li class='nav-item'>
                        <a class='nav-link' href='./user_panel/user_logout.php'>Logout</a>
                    </li>";
                }
            ?>
            </ul>
        </nav>

        <!-- body section where product heading is being displayed -->
        <div class="bg-light">
            <h3 class="text-center text-black">Cart Details</h3>
        </div>

        <!-- cart details here -->
        <div class="container">
            <div class="row">
                <form action="cart.php" method="post">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Price per Item</th>
                                <th>Total</th>
                                <th>Remove</th>
                                <th colspan="2">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ip = getIPAddress();
                            $total_price = 0;
                            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
                            $result = mysqli_query($con, $cart_query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $product_id = $row['product_id'];
                                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                                    $result_products = mysqli_query($con, $select_products);

                                    while ($row_product = mysqli_fetch_array($result_products)) {
                                        $product_title = $row_product['product_title'];
                                        $product_image = $row_product['product_image1'];
                                        $product_price = $row_product['product_price'];
                                        $quantity = $row['quantity'];
                                        $total_item_price = $product_price * $quantity;

                                        // Add to the total price
                                        $total_price += $total_item_price;
                            ?>
                                    <tr>
                                        <td><?php echo $product_title; ?></td>
                                        <td><img src="./images/<?php echo $product_image; ?>" class="cart_img" alt="Product Image"></td>
                                        <td>
                                            <input type="number" class="form-control text-center" name="qty[<?php echo $product_id; ?>]" value="<?php echo $quantity; ?>" min="1">
                                        </td>
                                        <td><?php echo $product_price; ?> /-</td>
                                        <td><?php echo $total_item_price; ?> /-</td>
                                        <td><input type="checkbox" name="remove[<?php echo $product_id; ?>]"></td>
                                        <td>
                                            <input type="submit" name="update_cart" value="Update" class="bg-primary px-3 py-2 text-white border-0 text-center"/>
                                            <input type="submit" name="remove_cart" value="Remove" class="bg-danger px-3 py-2 text-white border-0 text-center"/>
                                        </td>
                                    </tr>
                            <?php
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>Your cart is empty!</td></tr>";
                            }

                            if (isset($_POST['update_cart'])) {
                                foreach ($_POST['qty'] as $product_id => $quantity) {
                                    $update_cart = "UPDATE `cart_details` SET quantity=$quantity WHERE ip_address='$ip' AND product_id=$product_id";
                                    mysqli_query($con, $update_cart);
                                    echo "<script>alert('cart is successfully updated')</script>";
                                    echo "<script>window.open('cart.php','_self')</script>";
                                }
                            }

                            if (isset($_POST['remove_cart'])) {
                                foreach ($_POST['remove'] as $product_id => $remove_item) {
                                    if ($remove_item) {
                                        $remove_cart = "DELETE FROM `cart_details` WHERE ip_address='$ip' AND product_id=$product_id";
                                        mysqli_query($con, $remove_cart);
                                        echo "<script>alert('item is removed from the cart successfully')</script>";
                                        echo "<script>window.open('cart.php','_self')</script>";
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="d-flex gap-3 text-black py-2 mb-3">
                        <h4 class="px-3 text-black">Subtotal: <strong class='class-primary'><?php echo $total_price; ?> /-</strong></h4>
                        <a href="index.php">
                            <button class="bg-primary px-3 py-2 text-white border-0" name='continue_shopping'>Continue Shopping</button>
                        </a>
                        <?php
                        $ip = getIPAddress();
                        $total_price = 0;
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
                        $result = mysqli_query($con, $cart_query);

                        if (mysqli_num_rows($result) > 0) {
                        echo"
                        <a href='checkout.php'>
                            <button class='bg-primary px-3 py-2 text-white border-0' name='checkout_page'>Checkout</button>
                        </a>
                        ";
                        }
                        else{
                            echo "";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- footer -->
        <div class="bg-primary bg-gradient text-center p-3">
            <p>Footer section</p>
        </div>

    </div>
    <!-- bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
