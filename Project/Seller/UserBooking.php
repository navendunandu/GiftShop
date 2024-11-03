<?php
include("../Assets/Connection/Connection.php");

ob_start();
include("Head.php");

if (isset($_GET['id'])) {
    $upQry = "UPDATE tbl_cart SET cart_status=" . $_GET['st'] . " WHERE cart_id=" . $_GET['id'];
    if ($con->query($upQry)) {
        ?>
        <script>
            alert('Updated');
            window.location = "UserBooking.php?bid=<?php echo $_GET['bid'] ?>";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Failed');
            window.location = "UserBooking.php?bid=<?php echo $_GET['bid'] ?>";
        </script>
        <?php
    }
}

if (isset($_POST['btn_submit'])) {
    $agent = $_POST['selAgent'];
    
    if ($agent != "----select----")
	{
        $selCart = "SELECT * FROM tbl_cart c 
                    INNER JOIN tbl_product p ON c.product_id = p.product_id 
                    WHERE c.booking_id = " . $_GET['bid'] . " 
                    AND seller_id = " . $_SESSION['sid'];
                    
        $result = $con->query($selCart);
        
        while ($data = $result->fetch_assoc()) {
            
            $upCart = "UPDATE tbl_cart SET cart_status = 3, deliveryagent_id = $agent WHERE cart_id = " . $data['cart_id'];
            
            if ($con->query($upCart)) {
               
                $upQry = "UPDATE tbl_deliveryagent SET deliveryagent_status = '1' WHERE deliveryagent_id = $agent";
                
                if ($con->query($upQry)) {
                    ?>
                    <script>
                        alert('Assigned Delivery Agent');
                        window.location = "UserBooking.php?bid=<?php echo $_GET['bid'] ?>";
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        alert('Failed to update agent status');
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    alert('Failed to assign delivery agent');
                </script>
                <?php
            }
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Booking</title>
</head>

<body>
<div class="container">
<form id="form1" name="form1" method="post" action="">
  <table class="table table-striped" border="1">
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
      <td>Action</td>
    </tr>
    <?php
    $selQry = "SELECT * FROM tbl_cart c 
               INNER JOIN tbl_product p ON c.product_id = p.product_id 
               INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
               INNER JOIN tbl_user n ON n.user_id = b.user_id  
               WHERE booking_status = '2' 
               AND seller_id = " . $_SESSION['sid'] . " 
               AND c.booking_id = " . $_GET['bid'];
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
           
            ?>
          </td>
          <td>
            <?php
            if ($data['cart_status'] == 1) {
                echo "Payment Successful"; 
                ?>
                <a href="UserBooking.php?st=2&id=<?php echo $data['cart_id'] ?>&bid=<?php echo $_GET['bid'] ?>">Pack item</a>
                <?php
            } elseif ($data['cart_status'] == 2) {
                echo "Item Packed"; 
                ?>
              
                <!-- <a href="UserBooking.php?st=3&id=<?php echo $data['cart_id'] ?>&bid=<?php echo $_GET['bid'] ?>">Assign Delivery Agent</a> -->
                <?php
            } elseif ($data['cart_status'] == 3) {
                echo "Assigned Delivery Agent";
                ?>
                <a href="UserBooking.php?st=4&id=<?php echo $data['cart_id'] ?>&bid=<?php echo $_GET['bid'] ?>">Out for Delivery</a>
                <?php
            } elseif ($data['cart_status'] == 4) {
                echo "Item Delivered";
                ?>
                <a href="UserBooking.php?st=5&id=<?php echo $data['cart_id'] ?>&bid=<?php echo $_GET['bid'] ?>">Mark Delivered</a>
                <?php
            }
			elseif ($data['cart_status'] == 5) {
				echo "Delivered";
        $deliveryAgentId = $data['deliveryagent_id']; 
        $updateAgentStatus = "UPDATE tbl_deliveryagent SET deliveryagent_status = '0' WHERE deliveryagent_id = $deliveryAgentId";
        
        if ($con->query($updateAgentStatus)) {
          {}
          
        }


          

			}
            ?>
          </td>
        </tr>
        <?php
    }
    ?>
  </table>
</form>

<?php
if ($flag == $i) {
    ?>
    <form name="form2" method="post" action="">
      <table border="1">
        <tr>
          <td>Agent</td>
          <td>
            <select name="selAgent">
              <option value="----select----">----select----</option>
              <?php
              $SelQry = "SELECT * FROM tbl_deliveryagent where deliveryagent_status='0'";
              $result = $con->query($SelQry);
              while ($data = $result->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $data['deliveryagent_id'] ?>"><?php echo $data['deliveryagent_name']; ?></option>
                  <?php
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit"></td>
        </tr>
      </table>
    </form>
    <?php
}
?>
</div>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
