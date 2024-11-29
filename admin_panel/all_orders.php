<h3 class="text-center text-dark">All orders</h3>
<table class="table table-bordered text-center mt-3">
    <thead>
        <tr>
            <th>SN.no</th>
            <th>Due Amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Check if the delete order request is set
            if (isset($_GET['delete_orders'])) {
                $delete_id = $_GET['delete_orders'];

                // SQL query to delete the order
                $delete_query = "DELETE FROM `user_orders` WHERE `order_id` = $delete_id";
                $result = mysqli_query($con, $delete_query);

                // Check if the deletion was successful
                if ($result) {
                    echo "<script>alert('Order deleted successfully');</script>";
                    echo "<script>window.open('index.php','_self')</script>";
                } else {
                    echo "<script>alert('Error deleting order');</script>";
                }
            }

            // SQL query to get all orders
            $get_orders = "SELECT * FROM `user_orders`";
            $result = mysqli_query($con, $get_orders);
            
            // Check if the query was successful
            if (!$result) {
                die("Query failed: " . mysqli_error($con));  // Output error if query fails
            }

            // Check if there are any orders
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='7'>No orders available</td></tr>";
            } else {
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result)) {
                    $order_id = $row_data['order_id'];
                    $amount_due = $row_data['amount_due'];
                    $invoice_number = $row_data['invoice_number'];
                    $total_products = $row_data['total_products'];
                    $order_date = $row_data['order_date'];
                    $order_status = $row_data['order_status'];
                    $number++;

                    echo "
                        <tr>
                            <td>$number</td>
                            <td>$amount_due</td>
                            <td>$invoice_number</td>
                            <td>$total_products</td>
                            <td>$order_date</td>
                            <td>$order_status</td>
                            <td>
                                <a href='index.php?delete_orders=$order_id' onclick='return confirm(\"Are you sure you want to delete this order?\");'>
                                    <i class='fa-solid fa-trash text-danger'></i>
                                </a>
                            </td>
                        </tr>
                    ";
                }
            }
        ?>
    </tbody>
</table>
