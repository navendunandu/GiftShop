<?php 
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();
$dagentid=$_SESSION['did'];
$SelDAgent="select * from tbl_deliveryagent where deliveryagent_id=".$dagentid;
$resDAgent=$con->query($SelDAgent);
$data=$resDAgent->fetch_assoc();
 if(isset($_POST["btn_submit"]))
 {
   $oldpassword=$_POST["txt_oldpassword"];
   $newpassword=$_POST["txt_newpassword"];
   $retypepassword=$_POST["txt_retypepassword"];
	 if($data['deliveryagent_password']==$oldpassword)
	 {
		 if($newpassword==$retypepassword)
         {
	         $upQry="update tbl_deliveryagent SET deliveryagent_password='$newpassword' WHERE deliveryagent_id='".$_SESSION['did']."'";
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
      else
   {
	   ?>
     <script>
	 alert('New Password and Re-Type Password does not match!');
	 </script>
     <?php
   }
	 }
   else
  {
	  ?>
	  <script>
	 alert('Incorrect Old Password!');
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
    <h2 class="text-center">Change Password</h2>
    <form id="form1" name="form1" method="post" action="">
        <div class="card">
            <div class="card-body">
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
                    <input type="password" class="form-control" name="txt_retypepassword" id="txt_retypepassword" placeholder="Re-Type New Password" required />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
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