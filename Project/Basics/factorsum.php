<?php
	if(isset($_POST["btn_submit"]))
	{	
			$number=$_POST["txt_no"];
	}
	$sum=0;
		for($i=1;$i<=$number;$i++)
			{
				if($number%$i==0)
				 {
					 $sum+=$i;
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
  <table width="200" border="1" align="center">
    <tr>
      <td>Number</td>
      <td><label for="txt_no"></label>
      <input type="text" name="txt_no" id="txt_no" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
    <tr>
      <td>Sum</td>
      <td><?php echo $sum ?> </td>
    </tr>
  </table>
</form>
</body>
</html>