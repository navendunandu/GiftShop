<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
	
$userid=$_SESSION['uid'];
$SelUser="select *from tbl_user where user_id=".$userid;
$resUser=$con->query($SelUser);
$data=$resUser->fetch_assoc();
if(isset($_POST["btn_submit"]))
{
	$oldpassword=$_POST["txt_oldpassword"];
	$newpassword=$_POST["txt_newpassword"];
	$retypepassword=$_POST["txt_retypepassword"];

if($data['user_password']==$oldpassword)
{
 if($newpassword==$retypepassword)
 {
	 $upQry="update tbl_user SET user_password='$newpassword' WHERE user_id='".$_SESSION['uid']."'";
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
    <div class="card-header bg-warning text-white">
      <h4 class="card-title">Change Password</h4>
    </div>
    <div class="card-body">
      <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
          <label for="txt_oldpassword">Old Password</label>
          <input type="password" class="form-control" name="txt_oldpassword" id="txt_oldpassword" placeholder="Enter Old Password" required />
        </div>
        <div class="form-group">
          <label for="txt_newpassword">New Password</label>
          <input type="password" class="form-control" name="txt_newpassword" id="txt_newpassword" placeholder="Enter New Password" required />
        </div>
        <div class="form-group">
          <label for="txt_retypepassword">Re-Type Password</label>
          <input type="password" class="form-control" name="txt_retypepassword" id="txt_retypepassword" placeholder="Retype New Password" required />
        </div>
        <div class="text-center">
          <input type="submit" class="btn btn-success" name="btn_submit" id="btn_submit" value="Change Password" />
          <input type="submit" class="btn btn-secondary" name="btn_cancel" id="btn_cancel" value="Cancel" />
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
