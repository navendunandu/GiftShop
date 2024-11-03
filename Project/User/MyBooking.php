<?php
ob_start();
include("Head.php");
include("../Assets/Connection/connection.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div class="container mt-5">
  <!-- Booking Table -->
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="card-title">Booking Details</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>Sl No</th>
            <th>Photo</th>
            <th>Product</th>
            <th>Amount</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $user_id = $_SESSION['uid'];
        $selQry = "select * from tbl_cart c inner join tbl_product p on c.product_id=p.product_id inner join tbl_booking b on c.booking_id=b.booking_id where booking_status='2' and user_id=".$user_id;
        $result = $con->query($selQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $total_price = $data['cart_quantity'] * $data['product_price'];
            $i++;
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" width="100" height="100" class="img-fluid"></td>
            <td><?php echo $data['product_name']; ?></td>
            <td><?php echo $data['product_price']; ?></td>
            <td><?php echo $data['cart_quantity']; ?></td>
            <td><?php echo $total_price; ?></td>
            <td>
              <?php
              if ($data['cart_status'] == 1) {
                  echo "Payment Successful";
              } else if ($data['cart_status'] == 2) {
                  echo "Item Packed";
              } else if ($data['cart_status'] == 3) {
                  echo "Item has been shipped";
              } else if ($data['cart_status'] == 4) {
                  echo "Out of delivery";
              }
              else if ($data['cart_status'] == 5) {
                echo "Item Delivered";
                ?>
                <a style="color:Green" href="Bill.php?ID=<?php echo $data['booking_id']?>" >Bill</a>
                <?php
            }
              ?>
            </td>
            <td>
              <a href="PostComplaint.php?pID=<?php echo $data['product_id']; ?>" class="btn btn-warning btn-sm">Complaints</a>
              <p><a href="Rating.php?pid=<?php echo $data['product_id']; ?>" class="btn btn-info btn-sm">Rating</a></p>
            </td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<p>&nbsp;</p>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
