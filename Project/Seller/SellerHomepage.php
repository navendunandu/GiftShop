<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            /* background-color: #f8f9fa; */
        }
        .welcome-message {
            margin-bottom: 30px;
        }
        .options-table {
            margin-top: 30px;
        }
        .table td {
            vertical-align: middle;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container-fluid mt-5" style="background: #f9f3ec;">
    <!-- Welcome message -->
    <div class="alert alert-info text-center welcome-message">
        Welcome: <strong><?php echo htmlspecialchars($_SESSION['sname']); ?></strong>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    Total Products
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php
                            $query = "SELECT COUNT(*) as total_products FROM tbl_product WHERE seller_id = '". $_SESSION['sid']. "'";
                            $result = $con->query($query);
                            $row = $result->fetch_assoc();
                            echo $row['total_products'];
                       ?>
                    </h5>
                    <p class="card-text">Total number of products listed.</p>
                    <a href="Product.php" class="btn btn-primary">Manage Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    Sales Today
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php
                        $query = "SELECT SUM(booking_amount) as total_sales FROM tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id WHERE p.seller_id = '". $_SESSION['sid']. "' AND booking_date = CURDATE()";
                        $result = $con->query($query);
                        $row = $result->fetch_assoc();
                        echo "Rs. ". number_format($row['total_sales'], 2);
                        ?>
                    </h5>
                    <p class="card-text">Total sales made today.</p>
                    <a href="Bookings.php" class="btn btn-primary">View Bookings</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    Orders
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php
                        $query = "SELECT COUNT(*) as total_orders FROM tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id WHERE p.seller_id = '". $_SESSION['sid']. "' AND cart_status = '2'";
                        $result = $con->query($query);
                        $row = $result->fetch_assoc();
                        echo $row['total_orders'];
                       ?>
                    </h5>
                    <p class="card-text">New orders.</p>
                    <a href="Bookings.php" class="btn btn-primary">View Orders</a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
?>
