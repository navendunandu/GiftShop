<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

if (isset($_GET['seller_id'])) {
    $sellerID = $con->real_escape_string($_GET['seller_id']);
    $sellerQry = "SELECT * FROM tbl_seller n 
                  INNER JOIN tbl_place p ON n.place_id = p.place_id 
                  INNER JOIN tbl_district d ON d.district_id = p.district_id 
                  WHERE n.seller_id = '$sellerID'";
    $sellerResult = $con->query($sellerQry);
    $sellerData = $sellerResult->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Seller Details</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Seller Details</h2>

    <?php if ($sellerData) { ?>
    <table class="table table-bordered">
      <tr><th>District</th><td><?php echo htmlspecialchars($sellerData['district_name']); ?></td></tr>
      <tr><th>Place</th><td><?php echo htmlspecialchars($sellerData['place_name']); ?></td></tr>
      <tr><th>Name</th><td><?php echo htmlspecialchars($sellerData['seller_name']); ?></td></tr>
      <tr><th>Gender</th><td><?php echo htmlspecialchars($sellerData['seller_gender']); ?></td></tr>
      <tr><th>Contact</th><td><?php echo htmlspecialchars($sellerData['seller_contact']); ?></td></tr>
      <tr><th>Email</th><td><?php echo htmlspecialchars($sellerData['seller_email']); ?></td></tr>
      <tr><th>Photo</th><td><img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($sellerData['seller_photo']); ?>" class="img-fluid rounded" width="100" height="100" alt="Seller Photo"></td></tr>
      <tr><th>Proof</th><td><a href="../Assets/Files/Userdocs/<?php echo htmlspecialchars($sellerData['seller_proof']); ?>" target="_blank"><img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($sellerData['seller_proof']); ?>" class="img-fluid rounded" width="100" height="100" alt="Seller Proof"></a></td></tr>
      <tr><th>Logo</th><td><img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($sellerData['seller_logo']); ?>" class="img-fluid rounded" width="100" height="100" alt="Seller Logo"></td></tr>
    </table>
    <a href="SalesReport.php?id=<?php echo $sellerID; ?>" class="btn btn-primary mt-3">View Sales Report</a>
    <?php } else { ?>
    <p class="text-center">Seller details not found.</p>
    <?php } ?>
    <a href="AcceptedSellerList.php" class="btn btn-secondary mt-3">Back to List</a>
  </div>
  <?php include("Foot.php"); ?>
</body>
</html>
<?php
ob_flush();
?>
