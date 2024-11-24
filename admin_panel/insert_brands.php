<?php
    include('../includes/connect.php');  
    if(isset($_POST['insert_brand'])){
        $brand_title=$_POST['brand_title'];

        // select query
        $select_query="select * from `brands` where brand_title='$brand_title'";
        $result_select=mysqli_query($con, $select_query);
        $number=mysqli_num_rows($result_select);
        if($number>0){
            echo "<script>alert('brand with same title is already present inside the database')</script>";
        }
        else{
        $insert_query="insert into `brands` (brand_title) values ('$brand_title')";
        $result=mysqli_query($con, $insert_query);

        if($result){
            echo "<script>alert('brand has been added successfully')</script>";
        }
    }
    }
?>

<h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2 p-3">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-3 m-auto">
        <input type="submit" class="bg-dark text-white p-2" name="insert_brand" value="Insert Brands">
    </div>
    <!-- <button class="px-3 my-2 p-2 border-0 m-autol bg-dark text-white">
        Insert Brands
    </button> -->
</form>