<?php
 ob_start();
 include("Head.php");
include("../Assets/Connection/Connection.php");

//$username=$_SESSION['uname'];
$sellerid=$_SESSION['sid'];


$SelSeller="select *from tbl_seller where seller_id=".$sellerid;
$resSeller=$con->query($SelSeller);
$data=$resSeller->fetch_assoc();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4>Your Profile</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="../Assets/Files/Userdocs/<?php echo $data['seller_photo']; ?>" class="rounded-circle" width="150" height="150" alt="Profile Photo">
                </div>
                <table class="table">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><?php echo $data['seller_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td><?php echo $data['seller_email']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact</strong></td>
                        <td><?php echo $data['seller_contact']; ?></td>
                    </tr>
                    <?php
                    $selQry = "SELECT * FROM tbl_seller n 
                                INNER JOIN tbl_place p ON n.place_id = p.place_id 
                                INNER JOIN tbl_district d ON d.district_id = p.district_id";
                    $result = $con->query($selQry);
                    $data = $result->fetch_assoc();
                    ?>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><?php echo $data['district_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Place</strong></td>
                        <td><?php echo $data['place_name']; ?></td>
                    </tr>
                </table>
                <div class="text-center">
                    <a href="EditProfile.php" class="btn btn-warning me-2">Edit Profile</a>
                    <a href="ChangePassword.php" class="btn btn-secondary">Change Password</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
