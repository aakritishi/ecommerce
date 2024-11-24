<?php
    include('./includes/connect.php');

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
                        <a href='#' class='btn btn-primary'>Add to cart</a>
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
                            <a href='#' class='btn btn-primary'>Add to cart</a>
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
                            <a href='#' class='btn btn-primary'>Add to cart</a>
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
                        <a href='#' class='btn btn-primary'>Add to cart</a>
                        <a href='#' class='btn btn-primary bg-gradient'>View More</a>
                    </div>
                </div>
                </div>
            "; 
        }
    }
}

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
                    <a href='#' class='btn btn-primary'>Add to cart</a>
                    <a href='#' class='btn btn-primary bg-gradient'>View More</a>
                </div>
            </div>
            </div>
        "; 
    }
}
}
}
?>