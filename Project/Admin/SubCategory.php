<?php
ob_start();
include("Head.php");

 include("../Assets/Connection/Connection.php");
 if(isset($_POST["btn_submit"]))
 {
	$subcategory=$_POST["txt_subcategory"];
	$category=$_POST["selCategory"];
		$insQry="insert into tbl_subcategory(subcategory_name,category_id) values('$subcategory','$category')";
			if($con-> query($insQry))
		{
	?>
		<script>
					alert("inserted");
					window.location="Subcategory.php"
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
		$subcategoryID=$_GET["delID"];
		$delQry="delete from tbl_subcategory where subcategory_id=$subcategoryID";
		if($con-> query($delQry))
		{
	?>
		<script>
					alert("Deleted");
					window.location="Subcategory.php";
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
  <h2 class="text-center mb-4">Subcategory Management</h2>
  
  <form id="form1" name="form1" method="post" action="">
    <div class="card mb-4">
      <div class="card-header">Add Subcategory</div>
      <div class="card-body">
        <div class="form-group row">
          <label for="selCategory" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-10">
            <select name="selCategory" id="selCategory" class="form-control">
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
        <div class="form-group row">
          <label for="txt_subcategory" class="col-sm-2 col-form-label">Subcategory</label>
          <div class="col-sm-10">
            <input type="text" name="txt_subcategory" id="txt_subcategory" class="form-control" />
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-sm-2">
            <input type="submit" name="btn_submit" id="btn_submit" value="Save" class="btn btn-primary" />
            <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" class="btn btn-secondary" />
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="card">
    <div class="card-header">Subcategory List</div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Sl No</th>
            <th scope="col">Category</th>
            <th scope="col">Subcategory</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $selQry = "select * from tbl_subcategory s inner join tbl_category c on s.category_id=c.category_id";
          $result = $con->query($selQry);
          $i = 0;
          while ($data = $result->fetch_assoc()) {
            $i++;
          ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $data['category_name'] ?></td>
              <td><?php echo $data['subcategory_name'] ?></td>
              <td>
                <a href="SubCategory.php?delID=<?php echo $data['subcategory_id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
