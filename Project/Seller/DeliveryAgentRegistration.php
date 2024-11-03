<?php
 ob_start();
 include("Head.php");
include("../Assets/Connection/Connection.php");


if(isset($_POST["btn_submit"]))
{
	$sellerid=$_SESSION['sid'];
	$name=$_POST["txt_name"];
	$gender=$_POST["rd_gender"];
	$contact=$_POST["txt_contact"];
	$email=$_POST["txt_email"];
	$password=$_POST["txt_password"];
	$confirm=$_POST["txt_confirm"];
	
	
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/'.$photo);
	$contact=$_POST["txt_contact"];

	$insQry="insert into tbl_deliveryagent(seller_id,deliveryagent_name,deliveryagent_gender,deliveryagent_email,deliveryagent_password,deliveryagent_photo,deliveryagent_contact)values('$sellerid','$name','$gender','$email','$password','$photo','$contact')";
	
	if($con-> query($insQry))
	{
	?>
		<script>
			alert("inserted");
			window.location="SellerRegistration.php";
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
<title>NewUser</title>
</head>

<body>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4>Delivery Agent Registration</h4>
            </div>
            <div class="card-body">
                <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="txt_name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Enter Name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <input type="radio" name="rd_gender" id="rd_gender_male" value="Male" class="form-check-input">
                            <label for="rd_gender_male" class="form-check-label">Male</label>

                            <input type="radio" name="rd_gender" id="rd_gender_female" value="Female" class="form-check-input ms-3">
                            <label for="rd_gender_female" class="form-check-label">Female</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="txt_email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Enter Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="txt_password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Enter Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="txt_confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="txt_confirm" id="txt_confirm" placeholder="Confirm Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="file_photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="file_photo" id="file_photo" required>
                    </div>

                    <div class="mb-3">
                        <label for="txt_contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" name="txt_contact" id="txt_contact" placeholder="Enter Contact Number" required>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-success">Submit</button>
                        <button type="reset" name="btn_cancel" id="btn_cancel" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
        include("Foot.php");
        ob_flush();
        ?>

