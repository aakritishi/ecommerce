<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .esewa-logo{
            width:70%;
            margin:auto;
            display:block;
        }
    </style>
</head>
<body>
    <!-- php code to access user id for payment of the product -->
    <?php
        $user_ip= getIPAddress();

        $get_user="select * from `user_table` where user_ip_address='$user_ip'";
        $result= mysqli_query($con, $get_user);
        $run_query= mysqli_fetch_array($result);
        $user_id=$run_query['user_id'];
    ?>

    <div class="container">
        <h2 class="text-center text-primary">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="col-md-6">
                <a href="https://epay.esewa.com.np/api/epay/transaction/status/?product_code=EPAYTEST&total_amount=100&transaction_uuid=123">
                    <img src="https://cdn.esewa.com.np/ui/images/esewa_og.png?111" class="esewa-logo" alt="e-sewa">
                </a>
            </div>
            <div class="col-md-6 text-center">
                <a href="order.php?user_id=<?php echo $user_id ?>">
                    <h2 class="text-center">Cash On delivery</h2>
                </a>
            </div>
        </div>
    </div>
</body>
</html>