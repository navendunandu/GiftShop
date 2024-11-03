<?php
 ob_start();
 include("Head.php");
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

<section style="background: #F9F3EC; padding: 50px 0;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Login Form Wrapper -->
            <div class="content-wrapper col-md-7 p-8 mb-5">
                <div class="card shadow-lg p-5">
                    <h2 class="text-center mb-4" style="color: #E37383; font-weight: bold;">LOGIN TO YOUR ACCOUNT</h2>
                    <form id="form1" name="form1" method="post" action="">
                        <div class="form-group mb-3">
                            <label for="txt_email" style="font-weight: bold;">Email</label>
                            <input type="text" class="form-control" name="txt_email" id="txt_email" placeholder="Enter your email" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="txt_password" style="font-weight: bold;">Password</label>
                            <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Enter your password" required />
                        </div>
                        <div class="form-group mb-4">
                            <a href="ForgetPassword.php" style="color: #4E2A84;">Forgot Password?</a>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" name="btn_login" id="btn_login" value="Login" style="width: 100%;" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- Image Wrapper -->
            <div class="img-wrapper col-md-5">
			<img src="../Assets/Templates/Main/images/cupcake.png" class="img-fluid" alt="Login Image" />
            </div>
        </div>
    </div>
</section>

<?php
include("Foot.php");
ob_flush();
?>
