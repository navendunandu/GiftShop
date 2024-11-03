<?php
$total=0;
$fname==" ";
$lname==" ";
$gender==" ";
$dept==" ";
$fname==" ";
$percent==" ";

if(isset($_POST["btn_sumbit"]))
{
	$fname=$_POST["txt_fname"];
	$lname=$_POST["txt_lname"];
	$gender=$_POST["rd_gender"];
	$deptt=$_POST["slc_dept"];
	$mark1=$_POST["txt_mark1"];
	$mark2=$_POST["txt_mark2"];
	$mark3=$_POST["txt_mark3"];
	$total = $mark1 + $mark2 + $mark3;
    $Percent = ($total/300)*100;	
}
	if($gender == "Male")
   $name = "Mr." .$fname."".$lname;
    if($gender == "Female")
   $name = "Mrs." .$fname."".$lname;
if($percent>=90)
 {
	$grade="A+";
 }
 else if($percent>=80)
 {
	$grade="A";
 }
 else if($percent>=70)
 {
	$grade="B+"; 
 }
else if($percent>=60)
 {
	$grade="B"; 
 }
else if($percent>=50)
 {
	$grade="C"; 
 }
else
{
	$grade="FAILED"; 
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
      <td>First Name</td>
      <td><label for="txt_fname"></label>
      <input type="text" name="txt_fname" id="txt_fname" /></td>
    </tr>
    <tr>
      <td>Last Name</td>
      <td><label for="txt_lname"></label>
      <input type="text" name="txt_lname" id="txt_lname" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="rd_gender" id="rd_gender" value="Male"/>
        Male
        <input type="radio" name="rd_gender" id="rd_gender" value="Female"/>
      </label>Female</td>
    </tr>
    <tr>
      <td>Department</td>
      <td><label for="slc_dept"></label>
        <select name="slc_dept" id="slc_dept">
          <option value="IT">BCA</option>
          <option value="BUSINESS">BBA</option>
          <option value="FINANCE">BCOM</option>
      </select></td>
    </tr>
    <tr>
      <td>Mark 1</td>
      <td><label for="txt_mark1"></label>
      <input type="text" name="txt_mark1" id="txt_mark1" /></td>
    </tr>
    <tr>
      <td>Mark 2</td>
      <td><label for="txt_mark2"></label>
      <input type="text" name="txt_mark2" id="txt_mark2" /></td>
    </tr>
    <tr>
      <td>Mark 3</td>
      <td><label for="txt_mark3"></label>
      <input type="text" name="txt_mark3" id="txt_mark3" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
  <table width="200" border="1">
  <tr>
    <td>Name</td>
    <td><?php echo $name ?></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td><?php echo $gender ?></td>
  </tr>
  <tr>
    <td>Department</td>
    <td><?php echo $dept ?> </td>
  </tr>
  <tr>
    <td>Total</td>
    <td><?php echo $total ?></td>
  </tr>
  <tr>
    <td>%</td>
    <td><?php echo $Percent ?></td>
  </tr>
  <tr>
    <td>Grade</td>
    <td><?php echo $grade ?></td>
  </tr>
</table>
</form>
</body>
</html>