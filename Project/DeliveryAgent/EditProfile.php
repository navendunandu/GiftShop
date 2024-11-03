<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();
$dagentid=$_SESSION['did'];

 if(isset($_POST["btn_submit"]))
  {
	 
	  $name=$_POST["txt_name"];
	  $email=$_POST["txt_email"];
	  $contact=$_POST["txt_contact"];
		  $upQry="update tbl_deliveryagent SET deliveryagent_name='$name',deliveryagent_email='$email',deliveryagent_contact='$contact' WHERE deliveryagent_id='".$_SESSION['did']."'";
		  if($con->query($upQry))
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
 $SelDAgent="select * from tbl_deliveryagent WHERE deliveryagent_id='".$_SESSION['did']."'";
 
  $resDAgent=$con->query($SelDAgent);
$data=$resDAgent->fetch_assoc();
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Edit Profile</h2>
    <form id="form1" name="form1" method="post" action="">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo htmlspecialchars($data['deliveryagent_name']); ?>" required />
                </div>
                <div class="form-group">
                    <label for="txt_email">Email</label>
                    <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo htmlspecialchars($data['deliveryagent_email']); ?>" required />
                </div>
                <div class="form-group">
                    <label for="txt_contact">Contact</label>
                    <input type="text" class="form-control" name="txt_contact" id="txt_contact" value="<?php echo htmlspecialchars($data['deliveryagent_contact']); ?>" required />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>