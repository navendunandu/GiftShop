<?php
 ob_start();
 include("Head.php");

include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
{
$brand=$_POST['txt_brand'];

$insQry= "insert into tbl_brand(brand_name)values('$brand')";
if($con-> query($insQry))
{
?>
	<script>
    //alert("inserted");
    window.location="Brand.php";
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
		$brandID=$_GET["delID"];
		$delQry="delete from tbl_brand where brand_id=$brandID";
		if($con-> query($delQry))
		{
	?>
		<script>
					alert("Deleted");
					window.location="Brand.php";
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
<style>
body {
      background-color: #f8f9fa;
    }
    .table {
      background-color: #ffffff;
      border: 1px solid #ddd;
    }
    .table th {
      background-color: #f5e6f7;
      color: #555;
    }
    .table td {
      background-color:#fef7db;
    }
    .btn-submit {
      background-color: #e75480;
      border: none;
      color: white;
    }
    .btn-submit:hover {
      background-color: #e75480;
    }
    .form-control {
      background-color: #F5DCE0;
    }
    .custom-delete-btn {
  background-color: #e75480; /* Custom pastel red */
  color: white; /* Text color */
  border: none;
}
.custom-delete-btn:hover {
  background-color: #e75490; /* Darker shade on hover */
}

  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Manage Brands</h2>

    <!-- Form Section -->
    <form id="form1" name="form1" method="post" action="">
      <div class="row mb-3">
        <label for="txt_brand" class="col-sm-2 col-form-label">Brand</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" title="Name Allows Only Alphabets, Spaces, and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" name="txt_brand" id="txt_brand">
        </div>
      </div>

      <div class="text-center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-submit">
      </div>
    </form>

    <!-- Table Section -->
    <div class="table-responsive mt-4">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl No</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $selqry="select * from tbl_brand";
          $result=$con->query($selqry);
          $i = 0;
          while($data=$result->fetch_assoc())
          {
            $i++;
          ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data['brand_name']; ?></td>
            <td><a href="Brand.php?delID=<?php echo $data['brand_id']?>" class="btn custom-delete-btn">DELETE</a></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
        include("Foot.php");
        ob_flush();
        ?>
