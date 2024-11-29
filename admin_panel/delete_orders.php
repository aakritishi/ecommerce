<?php
    if(isset($_GET['delete_orders'])){
        $delete_id= $_GET['delete_orders'];

        $delete_query="delete from `user_orders` where order_id=$delete_id";
        $result= mysqli_query($con, $delete_query);
        if($result){
            echo"<script>alert('Orders deleted successfully')</script>";
            echo"<script>window.self('index.php','_self')</script>";
        }
        else{
            echo "mysqli_error($con)";
        }
    }
?>