<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

$userid=$_SESSION['uid'];


if(isset($_POST["btn_edit"]))
{
	
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	
		$upQry="update tbl_user SET user_name='$name', user_email='$email',user_contact='$contact' WHERE user_id='".$_SESSION['uid']."'";
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
	$SelUser="select * from tbl_user WHERE user_id='".$_SESSION['uid']."'";
	$resUser=$con->query($SelUser);
$data=$resUser->fetch_assoc();

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
    <div class="card-header bg-primary text-white">
      <h4 class="card-title">Edit Profile</h4>
    </div>
    <div class="card-body">
      <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
          <label for="txt_name">Name</label>
          <input type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo htmlspecialchars($data['user_name']); ?>" required />
        </div>
        <div class="form-group">
          <label for="txt_email">Email</label>
          <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo htmlspecialchars($data['user_email']); ?>" required />
        </div>
        <div class="form-group">
          <label for="txt_contact">Contact</label>
          <input type="tel" class="form-control" name="txt_contact" id="txt_contact" value="<?php echo htmlspecialchars($data['user_contact']); ?>" required />
        </div>
        <div class="text-center">
          <input type="submit" class="btn btn-success" name="btn_edit" id="btn_edit" value="Edit" />
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
