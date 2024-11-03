<?php
ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$userid=$_SESSION["uid"];
	$pid=$_GET["pID"];
	$title=$_POST["txt_title"];
	$description=$_POST["txt_description"];
		$file=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/'.$file);
	
	$insQry="insert into tbl_complaint(complaint_title,complaint_description,complaint_date,complaint_file,product_id,user_id)values('$title','$description',curdate(),'$file','$pid','$userid')";
	
	if($con-> query($insQry))
	{
	?>
		<script>
			alert("inserted");
			window.location="MyComplaints.php";
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
<title>COMPLAINT</title>
</head>

<body>


<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="card-title">Post a Complaint</h4>
    </div>
    <div class="card-body">
      <form id="form1" name="form1" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txt_title">Title</label>
          <input type="text" class="form-control" name="txt_title" id="txt_title" required />
        </div>
        <div class="form-group">
          <label for="txt_description">Description</label>
          <textarea class="form-control" name="txt_description" id="txt_description" rows="5" required></textarea>
        </div>
        <div class="form-group">
          <label for="file_photo">File</label>
          <input type="file" class="form-control-file" name="file_photo" id="file_photo" />
        </div>
        <div class="text-center">
          <input type="submit" class="btn btn-success" name="btn_submit" id="btn_submit" value="Submit" />
        </div>
      </form>
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
