<?php
 ob_start();
 include("Head.php");
include("../Assets/Connection/Connection.php");
	
$sellerid=$_SESSION['sid'];


if(isset($_POST["btn_edit"]))
{
	
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	
		$upQry="update tbl_seller SET seller_name='$name', seller_email='$email',seller_contact='$contact' WHERE seller_id='".$_SESSION['sid']."'";
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
	$SelSeller="select * from tbl_seller WHERE seller_id='".$_SESSION['sid']."'";
	$resSeller=$con->query($SelSeller);
$data=$resSeller->fetch_assoc();

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
                <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <form id="form1" name="form1" method="post" action="">
                    <div class="mb-3">
                        <label for="txt_name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo $data['seller_name']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="txt_email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $data['seller_email']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="txt_contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" name="txt_contact" id="txt_contact" value="<?php echo $data['seller_contact']; ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="btn_edit" id="btn_edit" class="btn btn-primary">Edit Profile</button>
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
