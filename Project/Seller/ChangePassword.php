<?php
 ob_start();
 include("Head.php");
include("../Assets/Connection/Connection.php");
	
$sellerid=$_SESSION['sid'];
$SelSeller="select *from tbl_seller where seller_id=".$sellerid;
$resSeller=$con->query($SelSeller);
$data=$resSeller->fetch_assoc();
if(isset($_POST["btn_submit"]))
{
	$oldpassword=$_POST["txt_oldpassword"];
	$newpassword=$_POST["txt_newpassword"];
	$retypepassword=$_POST["txt_retypepassword"];

if($data['seller_password']==$oldpassword)
{
 if($newpassword==$retypepassword)
 {
	 $upQry="update tbl_seller SET seller_password='$newpassword' WHERE seller_id='".$_SESSION['sid']."'";
		if($con-> query($upQry))
		{
			?>
            <script>
			window.location="MyProfile.php";
			
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
?>
            <script>
			alert('New Password and Re-type Password does not match!!');
			</script>
            <?php
		}
}
else
{
	?>
	           <script>
			alert('Incorrect Old Password');
			</script>
            <?php
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
        <div class="card">
            <div class="card-header bg-warning text-center">
                <h4>Change Password</h4>
            </div>
            <div class="card-body">
                <form id="form1" name="form1" method="post" action="">
                    <div class="mb-3">
                        <label for="txt_oldpassword" class="form-label">Old Password</label>
                        <input type="password" class="form-control" name="txt_oldpassword" id="txt_oldpassword" placeholder="Enter Old Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="txt_newpassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="txt_newpassword" id="txt_newpassword" placeholder="Enter New Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="txt_retypepassword" class="form-label">Re-Type New Password</label>
                        <input type="password" class="form-control" name="txt_retypepassword" id="txt_retypepassword" placeholder="Retype New Password" required>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Change Password</button>
                        <button type="reset" name="btn_cancel" id="btn_cancel" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
