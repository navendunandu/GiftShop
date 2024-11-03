<?php
 ob_start();
 include("Head.php");

include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$pid=$_GET['pID'];
	$stock=$_POST["txt_quantity"];
	$insQry="insert into tbl_stock(stock_quantity,stock_date,product_id)values('$stock',curdate(),'$pid')";
	if($con-> query($insQry))
	{
	?>
		<script>
			//alert("inserted");
			//window.location="Stock.php";
		</script>
		<?php
	}
	else
	{
		echo "Error";
	}
}	
if(isset($_GET["delID"]))
	{
		$stockID=$_GET["delID"];
		$delQry="delete from tbl_stock where stock_id=$stockID";
		
		if($con-> query($delQry))
		{
			?>
            <script>
				alert("Deleted");
				window.location="Stock.php";
			</script>
			<?php
			
		}
		else
		{
			echo "Error";
		}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div class="container mt-5">
  <!-- Stock Quantity Form -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      <h4 class="card-title">Add Stock Quantity</h4>
    </div>
    <div class="card-body">
      <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
          <label for="txt_quantity">Stock Quantity</label>
          <input type="text" class="form-control" name="txt_quantity" id="txt_quantity" placeholder="Enter quantity" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Stock List Table -->
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="card-title">Stock List</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>Sl No</th>
            <th>Date</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $selQry = "select * from tbl_stock where product_id='".$_GET['pID']."'";
        $selCart = "SELECT sum(cart_quantity) as sum FROM tbl_cart WHERE product_id = " . $_GET['pID'];

        $result = $con->query($selQry);
        $resCart = $con->query($selCart);
        $dataCart = $resCart->fetch_assoc();

        $i=0;
        $totalStock=0;
        while ($data = $result->fetch_assoc()) {
            $i++;
            $totalStock += $data['stock_quantity'];

            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $data['stock_date']; ?></td>
              <td><?php echo $data['stock_quantity']; ?></td>
              <td>
                <a href="Stock.php?delID=<?php echo $data['stock_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
              </td>
            </tr>
            <?php
        }
        ?>
           <tr>
                    <td colspan="2">Total Stock</td>
                    <td colspan="2">Remaining Stock</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $totalStock;?>
                    </td>
                    <td colspan="2">
                        <?php echo  $totalStock - $dataCart['sum'];?>
                    </td>
      </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
