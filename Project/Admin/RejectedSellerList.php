<?php
ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");
if(isset($_GET['aID']))	
		{ 
		 $upQry="update tbl_seller set seller_status='1' where seller_id=".$_GET['aID'];
		if($con-> query($upQry))
	 {
		  ?>
		 <script>
    alert("Accepted");
	window.location="RejectedSellerList.php";
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
  <h2 class="text-center mb-4">Rejected Seller List</h2>
  
  <form id="form1" name="form1" method="post" action="">
    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">District</th>
          <th scope="col">Place</th>
          <th scope="col">Name</th>
          <th scope="col">Gender</th>
          <th scope="col">Contact</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">Photo</th>
          <th scope="col">Proof</th>
          <th scope="col">Logo</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $selQry="select * from tbl_seller n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where seller_status='2'";
        $result=$con-> query($selQry);
        $i=0;
        while($data=$result->fetch_assoc())
        {
          $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['district_name']; ?></td>
            <td><?php echo $data['place_name']; ?></td>
            <td><?php echo $data['seller_name']; ?></td>
            <td><?php echo $data['seller_gender']; ?></td>
            <td><?php echo $data['seller_contact']; ?></td>
            <td><?php echo $data['seller_email']; ?></td>
            <td><?php echo $data['seller_password']; ?></td>
            <td><img src="../Assets/Files/Userdocs/<?php echo $data['seller_photo']; ?>" class="img-thumbnail" width="100" height="100" ></td>
            <td><a href="../Assets/Files/Userdocs/<?php echo $data['seller_proof']; ?>" target="_blank"><img src="../Assets/Files/Userdocs/<?php echo $data['seller_proof']; ?>" class="img-thumbnail" width="100" height="100"></a></td>
            <td><img src="../Assets/Files/Userdocs/<?php echo $data['seller_logo']; ?>" class="img-thumbnail" width="100" height="100" ></td>
            <td><a href="RejectedSellerList.php?aID=<?php echo $data['seller_id']?>" class="btn btn-success btn-sm">Accept</a></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
