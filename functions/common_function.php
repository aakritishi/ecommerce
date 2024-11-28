<?php
    // include('./includes/connect.php');

    // getting products
    function getproducts(){
        global $con;

        // condition to check isset or not
        if(!isset($_GET['category'])){
            if(!isset($_GET['brand'])){
        $select_query ="select * from `products` order by rand() limit 0,3"; 
        $result_query= mysqli_query($con, $select_query);
        // $row= mysqli_fetch_assoc($result_query);
        while($row= mysqli_fetch_assoc($result_query)){
            $product_id= $row['product_id'];
            $product_title= $row['product_title'];
            $product_description= $row['product_description'];
            $product_image1= $row['product_image1'];
            $product_price= $row['product_price'];
            $category_id= $row['category_id'];
            $brand_id= $row['brand_id']; 
            echo "
                <div class='col-md-4 mb-3'>
                <div class='card h-100'>
                    <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'>Price: $product_price/-</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                        <a href='#' class='btn btn-primary bg-gradient'>View More</a>
                    </div>
                </div>
                </div>
            "; 
        }
    }
    }
    }

    // getting unique categories
    function get_unique_cat(){
        global $con;

        // condition to check isset or not
        if(isset($_GET['category'])){
            $category_id=$_GET['category'];
            $select_query ="select * from `products` where category_id=$category_id"; 
            $result_query= mysqli_query($con, $select_query);
            $num_of_rows= mysqli_num_rows($result_query);

            if($num_of_rows==0){
                echo "<h2 class='text-center text-danger'>No stock in inventory for this category</h2>";
            }

            // $row= mysqli_fetch_assoc($result_query);
            while($row= mysqli_fetch_assoc($result_query)){
                $product_id= $row['product_id'];
                $product_title= $row['product_title'];
                $product_description= $row['product_description'];
                $product_image1= $row['product_image1'];
                $product_price= $row['product_price'];
                $category_id= $row['category_id'];
                $brand_id= $row['brand_id']; 
                echo "
                    <div class='col-md-4 mb-3'>
                    <div class='card h-100'>
                        <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Price: $product_price/-</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                            <a href='#' class='btn btn-primary bg-gradient'>View More</a>
                        </div>
                    </div>
                    </div>
                "; 
            }
        }
    }

    // getting unique brands
    function get_unique_brand(){
        global $con;

        // condition to check isset or not
        if(isset($_GET['brand'])){
            $brand_id=$_GET['brand'];
            $select_query ="select * from `products` where brand_id=$brand_id"; 
            $result_query= mysqli_query($con, $select_query);
            $num_of_rows= mysqli_num_rows($result_query);

            if($num_of_rows==0){
                echo "<h2 class='text-center text-danger'>this brand is not available right now</h2>";
            }

            // $row= mysqli_fetch_assoc($result_query);
            while($row= mysqli_fetch_assoc($result_query)){
                $product_id= $row['product_id'];
                $product_title= $row['product_title'];
                $product_description= $row['product_description'];
                $product_image1= $row['product_image1'];
                $product_price= $row['product_price'];
                $category_id= $row['category_id'];
                $brand_id= $row['brand_id']; 
                echo "
                    <div class='col-md-4 mb-3'>
                    <div class='card h-100'>
                        <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Price: $product_price/-</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                            <a href='#' class='btn btn-primary bg-gradient'>View More</a>
                        </div>
                    </div>
                    </div>
                "; 
            }
        }
    }

    // displaying brands in sidenav
    function getbrands(){
        global $con;
        $select_brands= "select * from `brands`";
        $result_brands= mysqli_query($con, $select_brands);
        // $row_data= mysqli_fetch_assoc($result_brands);
        // echo $row_data['brand_title'];
        
        while($row_data= mysqli_fetch_assoc($result_brands)){
            $brand_title= $row_data['brand_title'];
            $brand_id= $row_data['brand_id'];
            // echo $brand_title;
            echo "<li class='nav-item'>
                    <a href='index.php?brand=$brand_id' class='nav-link text-white'>$brand_title</a>
                </li>";
        }
    }

    // displaying categories in sidenav
    function getcategories(){
        global $con;
        $select_categories= "select * from `categories`";
        $result_categories= mysqli_query($con, $select_categories);
        // $row_data= mysqli_fetch_assoc($result_categories);
        // echo $row_data['category_title'];
        
        while($row_data= mysqli_fetch_assoc($result_categories)){
            $category_title= $row_data['category_title'];
            $category_id= $row_data['category_id'];
            // echo $category_title;
            echo "<li class='nav-item'>
                    <a href='index.php?category=$category_id' class='nav-link text-white'>$category_title</a>
                </li>";
        }
    }

    // search products
    function search_products(){
        global $con;
        if(isset($_GET['search_data_product'])){
        $search_data =$_GET['search_data'];
        $search_query= "select * from `products` where product_keywords like '%$search_data%'";
        $result_query= mysqli_query($con, $search_query);
        // $row= mysqli_fetch_assoc($result_query);
        $num_of_rows= mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger my-4'>No product found</h2>";
        }
        while($row= mysqli_fetch_assoc($result_query)){
            $product_id= $row['product_id'];
            $product_title= $row['product_title'];
            $product_description= $row['product_description'];
            $product_image1= $row['product_image1'];
            $product_price= $row['product_price'];
            $category_id= $row['category_id'];
            $brand_id= $row['brand_id']; 
            echo "
                <div class='col-md-4 mb-3'>
                <div class='card h-100'>
                    <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'>Price: $product_price/-</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                        <a href='#' class='btn btn-primary bg-gradient'>View More</a>
                    </div>
                </div>
                </div>
            "; 
        }
    }
}

// display all the products
function get_all_products(){
    global $con;

    // condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query ="select * from `products` order by rand()"; 
    $result_query= mysqli_query($con, $select_query);
    // $row= mysqli_fetch_assoc($result_query);
    while($row= mysqli_fetch_assoc($result_query)){
        $product_id= $row['product_id'];
        $product_title= $row['product_title'];
        $product_description= $row['product_description'];
        $product_image1= $row['product_image1'];
        $product_price= $row['product_price'];
        $category_id= $row['category_id'];
        $brand_id= $row['brand_id']; 
        echo "
            <div class='col-md-4 mb-3'>
            <div class='card h-100'>
                <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $product_price/-</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                    <a href='#' class='btn btn-primary bg-gradient'>View More</a>
                </div>
            </div>
            </div>
        "; 
    }
}
}
}

// get user ip address or assign ip address to user
    function getIPAddress() {  
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
                $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    }  
    // $ip = getIPAddress();  
    // echo 'User Real IP Address - '.$ip;
    
    // cart function
    function cart(){
        if (isset($_GET['add_to_cart'])){
            global $con;
            $ip = getIPAddress(); 
            $get_product_id= $_GET['add_to_cart'];

            $select_query= "select * from `cart_details` where ip_address='$ip' and product_id=$get_product_id";
            $result_query= mysqli_query($con, $select_query);
            $num_of_rows = mysqli_num_rows($result_query);

            if($num_of_rows>0){
                echo "<script>alert('This item is already inside the cart')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
            else{
                $insert_query= "insert into `cart_details` (product_id, ip_address, quantity) values ($get_product_id,'$ip',1)";
                $result_query= mysqli_query($con, $insert_query);
                echo "<script>alert('This item is added into the cart successfully')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    }

    // function to get cart item number
    function cart_item_number(){
        if (isset($_GET['add_to_cart'])){
            global $con;
            $ip = getIPAddress(); 

            $select_query= "select * from `cart_details` where ip_address='$ip'";
            $result_query= mysqli_query($con, $select_query);
            $count_cart_items = mysqli_num_rows($result_query);
        }
        else{
            global $con;
            $ip = getIPAddress(); 

            $select_query= "select * from `cart_details` where ip_address='$ip'";
            $result_query= mysqli_query($con, $select_query);
            $count_cart_items = mysqli_num_rows($result_query);
        }
        echo $count_cart_items;
    }

    // function to add the cart item price and sum it and update it 
    function total_cart_price(){
        global $con;
        $ip = getIPAddress();
        $total=0;
        $cart_query= "select * from `cart_details` where ip_address='$ip'";
        $result = mysqli_query($con, $cart_query);
        while($row=mysqli_fetch_array($result)){
            $product_id= $row['product_id'];
            $select_products= "select * from `products` where product_id='$product_id'";
            $result_products= mysqli_query($con, $select_products);
            while($row_product_price=mysqli_fetch_array($result_products)){
                $product_price=array($row_product_price['product_price']);
                $product_values=array_sum($product_price);
                $total+=$product_values;
            }
        }
        echo $total;
    }

    // get users order details 
    function get_user_order_details() {
        global $con;
    
        // Check if the session username is set
        if (!isset($_SESSION['username'])) {
            echo "<h3 class='text-center text-danger'>Please log in to view your orders.</h3>";
            return;
        }
    
        $username = mysqli_real_escape_string($con, $_SESSION['username']);
    
        // Query to get the user ID
        $get_user_id = "SELECT user_id FROM `user_table` WHERE username = '$username'";
        $user_result = mysqli_query($con, $get_user_id);
    
        if (!$user_result || mysqli_num_rows($user_result) === 0) {
            echo "<h3 class='text-center text-danger'>User not found.</h3>";
            return;
        }
    
        $user_row = mysqli_fetch_assoc($user_result);
        $user_id = $user_row['user_id'];
    
        // Query to get pending orders for the user
        $get_orders = "SELECT COUNT(*) as order_count FROM `user_orders` WHERE user_id = $user_id AND order_status = 'pending'";
        $order_result = mysqli_query($con, $get_orders);
    
        if (!$order_result) {
            echo "<h3 class='text-center text-danger'>Failed to fetch order details.</h3>";
            return;
        }
    
        $order_row = mysqli_fetch_assoc($order_result);
        $order_count = $order_row['order_count'];
    
        if ($order_count > 0) {
            echo "<h3 class='text-center text-dark my-6'>You have <span class='text-danger'>$order_count</span> pending orders</h3>
            <p class='text-center'>
                <a href='profile.php?my_orders' class='text-center fw-bold h2'>Order_details</a>";
        } else {
            echo "<h3 class='text-center text-dark'>You have no pending orders.</h3>";
        }
    }
    
?>