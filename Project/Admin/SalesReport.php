<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");

$sellerID = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sales Report</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Sales Report</h2>

    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Sl No</th>
          <th scope="col">Buyer Name</th>
          <th scope="col">Address</th>
          <th scope="col">Product</th>
          <th scope="col">Quantity</th>
          <th scope="col">Unit Price</th>
          <th scope="col">Total Amount</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($sellerID) {
            $selQry = "SELECT * FROM tbl_cart c 
                       INNER JOIN tbl_product p ON c.product_id = p.product_id 
                       INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                       INNER JOIN tbl_user n ON n.user_id = b.user_id  
                       WHERE booking_status = '2' 
                       AND seller_id = $sellerID";
            $result = $con->query($selQry);
            $i = 1;

            while ($data = $result->fetch_assoc()) {
                $total_price = $data['cart_quantity'] * $data['product_price'];
                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo htmlspecialchars($data['user_name']); ?></td>
                  <td><?php echo htmlspecialchars($data['user_address']); ?></td>
                  <td><?php echo htmlspecialchars($data['product_name']); ?></td>
                  <td><?php echo $data['cart_quantity']; ?></td>
                  <td><?php echo $data['product_price']; ?></td>
                  <td><?php echo $total_price; ?></td>
                  <td><?php echo getStatus($data['cart_status']); ?></td>
                </tr>
                <?php
            }

            if ($i == 1) {
                echo "<tr><td colspan='8' class='text-center'>No Sales Records Found</td></tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>Seller ID is missing</td></tr>";
        }

        function getStatus($status) {
            $statuses = [
                1 => "Payment Successful",
                2 => "Item Packed",
                3 => "Assigned to Delivery Agent",
                4 => "Out for Delivery",
                5 => "Delivered",
            ];
            return $statuses[$status] ?? "Pending";
        }
        ?>
      </tbody>
    </table>

    <a href="HomePage.php" class="btn btn-secondary mt-3">Back to Home</a>
  </div>

  <?php include("Foot.php"); ?>
</body>
</html>

<?php
ob_flush();
?>
