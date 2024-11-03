<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
$category='';
$cId=0;
if(isset($_POST["btn_submit"]))
{
	$cId=$_POST["txt_cid"];
	$category=$_POST["txt_category"];
	if($cId!=0)
	{
		$upQry="update tbl_category SET category_name='$category' WHERE category_id='$cId'";
		if($con-> query($upQry))
		{
			?>
            <script>
			alert("Updated");
				window.location="Category.php";
			
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
	$insqry= "insert into tbl_category(category_name)values('$category')";
if($con-> query($insqry))
{
?>
	<script>
    alert("inserted");
    window.location="Category.php";
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
	$categoryID=$_GET["delID"];
	$delQry="delete from tbl_category where category_id=$categoryID";
	if($con-> query($delQry))
	{
?>
	<script>
				alert("Deleted");
				window.location="Category.php";
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
	 $cId=$_GET["eID"];
	$selqry="select * from tbl_category where category_id='$cId'";
	$result=$con->query($selqry);
	$data=$result->fetch_assoc();
	$category=$data['category_name']; 
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="HomePage.php">Home </a>
<!-- <style>
        .table {
            border-top: 2px solid #000; /* Add a solid top border */
        }
        .table-bordered th, .table-bordered td {
            border: 2px solid #000; /* Set the border color and thickness for cells */
        }
        .table-bordered {
            border-collapse: collapse; /* Ensure borders collapse for a cleaner look */
        }
    </style> -->
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Category Management</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_category">Category Name</label>
                <input type="hidden" name="txt_cid" id="txt_cid" value="<?php echo $cId ?>"/>
                <input required type="text" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" name="txt_category" id="txt_category" class="form-control" value="<?php echo $category ?>"/>
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
            <thead class="table-dark">
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selqry="SELECT * FROM tbl_category";
                    $result = $con->query($selqry);
                    $i = 0;
                    while ($data = $result->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['category_name']; ?></td>
                        <td>
                            <a href="Category.php?delID=<?php echo $data['category_id']?>" class="btn btn-danger btn-sm">DELETE</a>
                            <a href="Category.php?eID=<?php echo $data['category_id']?>" class="btn btn-warning btn-sm">EDIT</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
