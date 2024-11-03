<?php
include("../Assets/Connection/Connection.php");
session_start();
 if(isset($_POST["btn_login"]))
 {
	 $email=$_POST["txt_email"];
      $password=$_POST["txt_password"];
	  
	  $selUser="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
	   $selAdmin="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
	  $selSeller="select * from tbl_seller where seller_email='".$email."' and seller_password='".$password."'";
	  $SelDAgent="select * from tbl_deliveryagent where deliveryagent_email='".$email."' and deliveryagent_password='".$password."'";
	  
	  $resUser=$con->query($selUser);
	   $resAdmin=$con->query($selAdmin);
	 $resSeller=$con->query($selSeller);
	 $resDAgent=$con->query($SelDAgent);
	 
	  if($userData=$resUser->fetch_assoc())
	  {
		   $_SESSION['uid']=$userData['user_id'];
		  $_SESSION['uname']=$userData['user_name'];
		  header("location:../User/HomePage.php");
	  }
	  else if($adminData=$resAdmin->fetch_assoc())
	  {
		  $_SESSION['aid']=$adminData['admin_id'];
		  $_SESSION['aname']=$adminData['admin_name'];
		  header("location:../Admin/HomePage.php");
	  }
	  else if($sellerData=$resSeller->fetch_assoc())
	  {
		   $_SESSION['sid']=$sellerData['seller_id'];
		  $_SESSION['sname']=$sellerData['seller_name'];
		  header("location:../Seller/SellerHomePage.php");
	  }
	  else if($DAgentData=$resDAgent->fetch_assoc())
	  {
		  $_SESSION['did']=$DAgentData['deliveryagent_id'];
		  $_SESSION['dname']=$DAgentData['deliveryagent_name'];
	      header("location:../DeliveryAgent/HomePage.php");
	  
	  
	  }
	  else
	 {
		?>
        	<script>
			alert('Invalid Credential')
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
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" /></td>
    </tr>
	<tr>
	<a href="ForgotPassword.php">ForgotPassword</a>
</tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_login" id="btn_login" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html>