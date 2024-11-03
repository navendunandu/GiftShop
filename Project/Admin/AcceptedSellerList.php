<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

if(isset($_GET['rID'])) { 
    $upQry = "UPDATE tbl_seller SET seller_status='2' WHERE seller_id=".$_GET['rID'];
    if($con->query($upQry)) {
        ?>
        <script>
            alert("Rejected");
            window.location="AcceptedSellerList.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Accepted Seller List</title>
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Accepted Seller List</h2>
    
    <form id="form1" name="form1" method="post" action="">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">SlNo</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Contact</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $selQry = "SELECT * FROM tbl_seller WHERE seller_status='1'";
            $result = $con->query($selQry);
            $i = 0;
            while($data = $result->fetch_assoc()) {
              $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $data['seller_name']; ?></td>
              <td><?php echo $data['seller_email']; ?></td>
              <td><?php echo $data['seller_contact']; ?></td>
              <td>
                <a href="ViewMoreSeller.php?seller_id=<?php echo $data['seller_id']; ?>" class="btn btn-info">View More</a>
                <a href="AcceptedSellerList.php?rID=<?php echo $data['seller_id']; ?>" class="btn btn-danger">Reject</a>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </form>

    <?php include("Foot.php"); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
