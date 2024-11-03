<?php
ob_start();
include("Head.php");

 include("../Assets/Connection/Connection.php");
 if(isset($_POST["btn_submit"]))
 {
	$place=$_POST["txt_place"];
	$pincode=$_POST["txt_pincode"];
	$district=$_POST["SelDistrict"];
	
	$selCheck="select * from tbl_place where place_name='".$place."'";
	$resCheck=$con->query($selCheck);
	if($resCheck->num_rows>0)
	{
		?>
<script>
alert("Already Exists")
</script>
		<?php
	}
	else{
		$insQry="insert into tbl_place(place_name,place_pincode,district_id) values('$place','$pincode','$district')";
			if($con-> query($insQry))
		{
	?>
		<script>
					alert("inserted");
					window.location="Place.php"
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
		$placeID=$_GET["delID"];
		$delQry="delete from tbl_place where place_id=$placeID";
		if($con-> query($delQry))
		{
	?>
		<script>
					alert("Deleted");
					window.location="Place.php";
		</script>
	<?php
	
		}
	else
		{
			echo "Error";
		}
	}
 }
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
</head>

<body>
<a href="HomePage.php">Home </a>
<div class="container my-5">
        <h2 class="text-center mb-4">Place Management</h2>

        <!-- Form Section -->
        <form id="form1" name="form1" method="post" action="">
            <div class="row mb-3">
                <label for="SelDistrict" class="col-sm-2 col-form-label">District</label>
                <div class="col-sm-10">
                    <select class="form-select" name="SelDistrict" id="SelDistrict" required>
                        <option value="----select---">----select---</option>
                        <?php
                        $selQry = "select * from tbl_district";
                        $result = $con->query($selQry);
                        while ($data = $result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="txt_place" class="col-sm-2 col-form-label">Place</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" name="txt_place" id="txt_place" />
                </div>
            </div>

            <div class="row mb-3">
                <label for="txt_pincode" class="col-sm-2 col-form-label">Pincode</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" name="txt_pincode" id="txt_pincode" />
                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Submit" />
                </div>
            </div>
        </form>

        <!-- Table Section -->
        <h3 class="text-center mt-5">Places List</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Sl No</th>
                        <th>Place</th>
                        <th>Pincode</th>
                        <th>District</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selQry = "select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
                    $result = $con->query($selQry);
                    $i = 0;
                    while ($data = $result->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $data['place_name'] ?></td>
                            <td><?php echo $data['place_pincode'] ?></td>
                            <td><?php echo $data['district_name'] ?></td>
                            <td>
                                <a href="Place.php?delID=<?php echo $data['place_id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
