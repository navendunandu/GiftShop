<?php

ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");
$district='';
$aId=0;
if(isset($_POST["btn_submit"]))
{
	$aId=$_POST["txt_aid"];
	$district=$_POST["txt_district"];
	if($aId!=0)
	{
		$upQry="update tbl_district SET district_name='$district' WHERE district_id='$aId'";
		if($con-> query($upQry))
		{
			?>
            <script>
			alert("Updated");
				window.location="District.php";
			
		</script>
		<?php
		}
	else
		{
			echo "Error";
		}
	}
	else
	{
		$selCheck="select * from tbl_district where district_name='".$district."'";
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
	$insQry= "insert into tbl_district(district_name)values('$district')";
if($con-> query($insQry))
{
?>
	<script>
    alert("inserted");
    window.location="District.php";
    </script>
<?php
}
else
	{
	  	echo "Error";
	}
}
}
}
if(isset($_GET["delID"]))
	{
		$districtID=$_GET["delID"];
		$delQry="delete from tbl_district where district_id=$districtID";
		if($con-> query($delQry))
		{
	?>
		<script>
					alert("Deleted");
					window.location="District.php";
		</script>
	<?php
	
		}
	else
		{
			echo "Error";
		}
		
}
if(isset($_GET["eID"]))
 {
	 $aId=$_GET["eID"];
	$selqry="select * from tbl_district where district_id='$aId'";
	$result=$con->query($selqry);
	$data=$result->fetch_assoc();
	$district=$data['district_name'];
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
</head>

<body>
<style>
    .btn-edit {
        background-color: #EFB26F/* Custom green */
        color: white; /* Text color */
        border: none; /* Optional: remove border */
    }
    .btn-edit:hover {
        background-color: #EFB26F; /* Darker shade on hover */
    }
	
</style>
    <div class="container mt-5">
        <h2 class="text-center mb-4">District Form</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="card p-4">
                <div class="mb-3">
                    <label for="txt_district" class="form-label">District Name</label>
                    <input type="hidden" name="txt_aid" id="txt_aid" value="<?php echo $aId; ?>">
                    <input required type="text" class="form-control" title="Name Allows Only Alphabets, Spaces, and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" name="txt_district" id="txt_district" value="<?php echo $district; ?>" />
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit">Submit</button>
                </div>
            </div>
        </form>

        <div class="mt-5">
            <h3 class="text-center">District List</h3>
            <table class="table table-striped table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">District</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $selQry = "SELECT * FROM tbl_district";
                    $result = $con->query($selQry);
                    $i = 0;
                    while ($data = $result->fetch_assoc()) {
                        $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['district_name']; ?></td>
                        <td>
                            <a href="District.php?delID=<?php echo $data['district_id']; ?>" class="btn btn-danger btn-sm">DELETE</a>
							<a href="District.php?eID=<?php echo $data['district_id']; ?>" class="btn btn-sm btn-edit">EDIT</a>

                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, but needed for some interactive elements) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
