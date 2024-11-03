<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
?>

          

          

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="table-responsive pt-3">
                  <table class="table table-striped project-orders-table">
                    <thead>
                      <tr>
                      <td>Sl No</td>
      <td>Name</td>
      <td>Address</td>
      <td>Photo</td>
      <td>Product</td>
      <td>Amount</td>
      <td>Quantity</td>
      <td>Total</td>
      <td>Status</td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
    $selQry = "SELECT * FROM tbl_cart c 
               INNER JOIN tbl_product p ON c.product_id = p.product_id 
               INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
               INNER JOIN tbl_user n ON n.user_id = b.user_id  
               WHERE booking_status = '2'";
    $result = $con->query($selQry);
    $i = 0;
    $flag = 0;

    while ($data = $result->fetch_assoc()) {
        $total_price = $data['cart_quantity'] * $data['product_price'];
        $i++;
        if ($data['cart_status'] == 2) {
            $flag++;
        }
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $data['user_name']; ?></td>
          <td><?php echo $data['user_address']; ?></td>
          <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" width="100" height="100"></td>
          <td><?php echo $data['product_name']; ?></td>
          <td><?php echo $data['product_price']; ?></td>
          <td><?php echo $data['cart_quantity']; ?></td>
          <td><?php echo $total_price; ?></td>
          <td>
            <?php
            if ($data['cart_status'] == 1) {
                echo "Payment Successful";
            } elseif ($data['cart_status'] == 2) {
                echo "Item Packed"; 
                ?>
              
                <!-- <a href="UserBooking.php?st=3&id=<?php echo $data['cart_id'] ?>&bid=<?php echo $_GET['bid'] ?>">Assign Delivery Agent</a> -->
                <?php
            } elseif ($data['cart_status'] == 3) {
                echo "Assigned Delivery Agent";
            } elseif ($data['cart_status'] == 4) {
                echo "Item Delivered";
                ?>
                <a href="UserBooking.php?st=5&id=<?php echo $data['cart_id'] ?>&bid=<?php echo $_GET['bid'] ?>">Mark Delivered</a>
                <?php
            }
			elseif ($data['cart_status'] == 5) {
				echo "Delivered";


          

			}
            ?>
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
          </div>

        <?php
        include("Foot.php");
        ob_flush();
        ?>

