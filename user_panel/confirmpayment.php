<?php
include('../includes/connect.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $select_data = "SELECT * FROM `user_orders` WHERE order_id = ?";
    $stmt = $con->prepare($select_data);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row_fetch = $result->fetch_assoc()) {
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['amount_due'];
    } else {
        echo "<script>alert('Invalid Order ID');</script>";
        echo "<script>window.open('profile.php', '_self');</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode, date) 
                     VALUES (?, ?, ?, ?, NOW())";
    $stmt = $con->prepare($insert_query);
    $stmt->bind_param("iids", $order_id, $invoice_number, $amount, $payment_mode);
    if ($stmt->execute()) {
        echo "<script>alert('Payment successfully processed');</script>";
        echo "<script>window.open('users_orders.php', '_self');</script>";
    } else {
        echo "<script>alert('Payment failed. Please try again later.');</script>";
    }

    $update_order= "update `user_orders` set order_status='complete' where order_id='$order_id'";
    $result_update= mysqli_query($con, $update_order);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5 text-center text-dark">
        <h1 class="text-center my-2 text-dark">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-60 m-auto">
                <label for="amount">Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo htmlspecialchars($invoice_number); ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-60 m-auto">
                <label for="amount">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo htmlspecialchars($amount_due); ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-60 m-auto">
                <label for="payment_mode">Payment Mode</label>
                <select name="payment_mode" class="form-select w-50 m-auto" required>
                    <option value="">Select payment mode</option>
                    <option value="e-sewa">e-Sewa</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-primary py-2 px-3 border-0 m-auto text-light fw-bold" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>
