<?php
 ob_start();
 include("Head.php");


 include("../Assets/Connection/Connection.php");
 if(isset($_POST["btn_submit"]))

 {	
 	$brand=$_POST['brand_name'];
 	$sellerid=$_SESSION['sid'];
	$category=$_POST["selCategory"];
	$subcategory=$_POST["selSubCategory"];
    $productname=$_POST["txt_pname"];
	$price=$_POST["txt_price"];
	$details=$_POST["txt_details"];
	
	
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/'.$photo);
	
	
		$insQry="insert into tbl_product(product_name,product_price,product_details,product_photo,subcategory_id,seller_id,brand_id) values('$productname','$price','$details','$photo','$subcategory','$sellerid','$brand')";
			if($con-> query($insQry))
		{
	?>
		<script>
					alert("inserted");
					window.location="Product.php"
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
		$productID=$_GET["delID"];
		$delQry="delete from tbl_product where product_id=$productID";
		if($con-> query($delQry))
		{
	?>
		<script>
					alert("Deleted");
					window.location="Product.php";
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Ensuring borders are visible for inputs and table */
    .form-control, .form-select {
      border: 1px solid #ced4da;
    }
    table, th, td {
      border: 1px solid black !important;
    }
    th, td {
      padding: 8px !important;
      text-align: center;
    }
  </style>
  <title>Add Product</title>
</head>
<body>

<form id="form1" name="form1" method="post" enctype="multipart/form-data" class="container my-5">
  <div class="card p-4 border">
    <h2 class="text-center mb-4">Add Product</h2>

    <!-- Category -->
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Category</label>
      <div class="col-sm-10">
        <select name="selCategory" class="form-select" onChange="getPlace(this.value)">
          <option value="----select----">----select----</option>
          <?php
          $selqry = "select * from tbl_category";
          $result = $con->query($selqry);
          while ($data = $result->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
    </div>

    <!-- SubCategory -->
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">SubCategory</label>
      <div class="col-sm-10">
        <select name="selSubCategory" id="place" class="form-select">
          <option value="----select----">----select----</option>
        </select>
      </div>
    </div>

    <!-- Brand -->
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Brand</label>
      <div class="col-sm-10">
        <select name="brand_name" class="form-select">
          <option value="----select----">----select----</option>
          <?php
          $selqry = "select * from tbl_brand";
          $result = $con->query($selqry);
          while ($data = $result->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['brand_id'] ?>"><?php echo $data['brand_name']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
    </div>

    <!-- Product Name -->
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Product Name</label>
      <div class="col-sm-10">
        <input type="text" name="txt_pname" id="txt_pname" class="form-control" />
      </div>
    </div>

    <!-- Price -->
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Price</label>
      <div class="col-sm-10">
        <input type="text" name="txt_price" id="txt_price" class="form-control" />
      </div>
    </div>

    <!-- Details -->
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Details</label>
      <div class="col-sm-10">
        <textarea name="txt_details" id="txt_details" cols="45" rows="5" class="form-control"></textarea>
      </div>
    </div>

    <!-- Photo -->
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Photo</label>
      <div class="col-sm-10">
        <input type="file" name="file_photo" class="form-control" />
      </div>
    </div>

    <!-- Buttons -->
    <div class="text-center">
      <button type="submit" name="btn_submit" class="btn btn-primary">Save</button>
      <button type="reset" name="btn_cancel" class="btn btn-secondary">Cancel</button>
    </div>
  </div>

  <!-- Product List Table -->
  <div class="table-responsive my-5">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Sl No</th>
          <th>Category</th>
          <th>Subcategory</th>
          <th>Brand</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Details</th>
          <th>Photo</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $selQry = "select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on s.category_id=c.category_id inner join tbl_brand b on p.brand_id=b.brand_id where p.seller_id=" . $_SESSION['sid'];
        $result = $con->query($selQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
          $i++;
        ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $data['category_name'] ?></td>
          <td><?php echo $data['subcategory_name'] ?></td>
          <td><?php echo $data['brand_name'] ?></td>
          <td><?php echo $data['product_name'] ?></td>
          <td><?php echo $data['product_price'] ?></td>
          <td><?php echo $data['product_details'] ?></td>
          <td><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" class="img-fluid" width="100" height="100" /></td>
          <td>
            <a href="Product.php?delID=<?php echo $data['product_id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
            <a href="Stock.php?pID=<?php echo $data['product_id'] ?>" class="btn btn-info btn-sm mt-2">Add Stock</a>
            <a href="Gallery.php?pID=<?php echo $data['product_id'] ?>" class="btn btn-warning btn-sm mt-2">Add more Photos</a>
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</form>

</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(cid) {
    $.ajax({
      url: "../Assets/AjaxPages/Ajaxsubcat.php?cid=" + cid,
      success: function (result) {

        $("#place").html(result);
      }
    });
  }

</script>
</html>
<?php
include("Foot.php");
?>

