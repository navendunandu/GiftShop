Sales Report
<?php
include("../Assets/Connection/Connection.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Start Date</td>
      <td><label for="txt_start"></label>
      <input type="date" name="txt_start" id="txt_start" /></td>
      <td>End Date</td>
      <td><label for="txt_end"></label>
      <input type="date" name="txt_end" id="txt_end" /></td>
    </tr>
    <tr>
      <td align="right" colspan="4"><input type="submit"  name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>
<?php
if(isset($_POST['btn_submit'])){
   $start=$_POST['txt_start'];
    $end=$_POST['txt_end'];
	$SelQry="SELECT * FROM tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id INNER JOIN tbl_product p on p.product_id=c.product_id where b.booking_date BETWEEN '$start' and '$end'";
	$result=$con->query($SelQry);
	$i=0;
	while($row=$result->fetch_assoc()){
		$i++;
		?>
        <table>
        <tr>
        <td>Sl No.</td>
        <td>Product</td>
        <td>Photo</td>
        <td>Price</td>
        <td>Quantity</td>
        </tr>
         <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $row['product_name']?></td>
        <td><img src="../Assets/Files//UserDocs/<?php echo $row["product_photo"] ?>" width="200" height="200" /></td>
        <td><?php echo $row['product_price']?></td>
        <td><?php echo $row['cart_quantity']?></td>
        </tr>
        </table>
        <?php
	}
}
?>
</body>
</html>