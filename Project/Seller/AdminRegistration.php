<?php

include("../Assets/Connection/Connection.php");
$name='';
$email='';
$password='';
$aId=0;


if(isset($_POST["btn_submit"]))
{
	$aId= $_POST['txt_aid'];
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$password=$_POST["txt_pass"];
	
	if($aId!=0)
		{
		$upQry="update tbl_admin SET admin_name= '$name', admin_email= '$email', admin_password= '$password' WHERE admin_id= '$aId'";
			if($con-> query($upQry))
			{
				?>
		<script>
			alert("Updated");
				window.location="AdminRegistration.php";
			
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
		
		$insqry= "insert into tbl_admin(admin_name,admin_email,admin_password) values('$place','$email','$password')";
			if($con-> query($insqry))
		{
	?>
		<script>
					alert("inserted");
					window.location="AdminRegistration.php"
		</script>
	<?php
		}
	else
		{
			echo "Error";
		}
	}
}
	if(isset($_GET["delID"]))
	{
		$adminID=$_GET["delID"];
		$delQry="delete from tbl_admin where admin_id=$adminID";
		if($con-> query($delQry))
		{
	?>
		<script>
					alert("Deleted");
					window.location="AdminRegistration.php";
		</script>
	<?php
	
		}
	else
		{
			echo "Error";
		}
		
}
 if(isset($_GET["eID"]))
 {
	 $aId=$_GET["eID"];
	$selqry="select * from tbl_admin where admin_id='$aId'";
	$result=$con->query($selqry);
	$data=$result->fetch_assoc();
	$name=$data['admin_name'];
	$email=$data['admin_email'];
	$password=$data['admin_password'];
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AdminRegistration</title>
</head>

<body>
<a href="../Admin/HomePage.php">Home </a>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="hidden" name="txt_aid" id="txt_aid" value="<?php echo $aId;?>"/> 
      <input required type="text" name="txt_name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" placeholder="Enter Name" value="<?php echo $name; ?>"/></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input required type="email" required name="txt_email" id="txt_email" value="<?php echo $email;?>" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_pass"></label>
      <input required type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_password"  id="txt_password" value="<?php echo $password;?>"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><label for="txt_pass">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </label></td>
    </tr>
  </table>
  <table><table border="1">
  <tr>
    <td>Sl No</td>
    <td>Name</td>
    <td>Email</td>
    <td>Password</td>
    <td>Action</td>
  </tr>
 <?php
  	$selqry="select * from tbl_admin";
	$result=$con->query($selqry);
	$i=0;
while($data=$result->fetch_assoc())
	{
		$i++;
?>	  
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['admin_name'] ?></td>
        <td><?php echo $data['admin_email'] ?></td>
        <td><?php echo $data['admin_password']?></td>
        <td><a href="AdminRegistration.php?delID=<?php echo $data['admin_id']?>">DELETE</a>
        <a href="AdminRegistration.php?eID=<?php echo $data['admin_id']?>">EDIT</a>
        </td>
  </tr>
<?php
	}
	?>
</table>

</form>

</body>

</html>