<?php
 ob_start();
 include("Head.php");
include("../Assets/Connection/connection.php");

if(isset($_POST['btn_submit']))
{
	$id=$_GET['pID'];
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto, '../Assets/Files/Gallery/'.$photo);
	$InsQry="insert into tbl_gallery(gallery_image,product_id) values('$photo','$id')";
	if($con->query($InsQry))
		{
			?>
			<script>
			alert("Inserted");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("Error");
			</script>
            <?php
		}
}

if(isset($_GET['did']))
{
	$DelQry="delete from tbl_gallery where gallery_id=".$_GET['did'];
	if($con->query($DelQry))
	{
			?>
			<script>
			window.location="Gallery.php";
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
        <!-- Gallery Form Card -->
        <div class="card">
            <div class="card-header bg-info text-white text-center">
                <h4>Upload Gallery Image</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="mb-3">
                        <label for="file_photo" class="form-label">Gallery Image</label>
                        <input type="file" class="form-control" name="file_photo" id="file_photo" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery Table Card -->
        <div class="card mt-4">
            <div class="card-header bg-warning text-center">
                <h4>Gallery</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Sl No.</th>
                            <th>Product Name</th>
                            <th>Gallery Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        $SelQry="select * from tbl_gallery g inner join tbl_product p on g.product_id=p.product_id where g.product_id=".$_GET['pID'];
                        $result=$con->query($SelQry);
                        while($data=$result->fetch_assoc())
                        {
                            $i++;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td class="text-center">
                                <img src="../Assets/Files/Userdocs/<?php echo $data['gallery_image']; ?>" width="100" height="100" class="img-thumbnail">
                            </td>
                            <td class="text-center">
                                <a href="Gallery.php?did=<?php echo $data['gallery_id'];?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</body>
</html>