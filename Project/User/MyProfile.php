<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

//$username=$_SESSION['uname'];
$userid=$_SESSION['uid'];


$SelUser="select *from tbl_user where user_id=".$userid;
$resUser=$con->query($SelUser);
$data=$resUser->fetch_assoc();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .profile-info td {
            padding: 10px 15px;
        }
        .btn-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body text-center">
            <img src="../Assets/Files/Userdocs/<?php echo $data['user_photo']; ?>" class="profile-img" alt="User Photo">
            <h3><?php echo htmlspecialchars($data['user_name']); ?></h3>
            <table class="table table-bordered profile-info">
                <tr>
                    <td>Name</td>
                    <td><?php echo htmlspecialchars($data['user_name']); ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo htmlspecialchars($data['user_address']); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($data['user_email']); ?></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><?php echo htmlspecialchars($data['user_contact']); ?></td>
                </tr>
                <?php
                    $selQry="SELECT * FROM tbl_user n 
                              INNER JOIN tbl_place p ON n.place_id = p.place_id 
                              INNER JOIN tbl_district d ON d.district_id = p.district_id";
                    $result = $con->query($selQry);
                    $data = $result->fetch_assoc();
                ?>
                <tr>
                    <td>District</td>
                    <td><?php echo htmlspecialchars($data['district_name']); ?></td>
                </tr>
                <tr>
                    <td>Place</td>
                    <td><?php echo htmlspecialchars($data['place_name']); ?></td>
                </tr>
            </table>
            <div class="btn-container">
                <a href="EditProfile.php" class="btn btn-warning">Edit Profile</a>
                <a href="ChangePassword.php" class="btn btn-danger">Change Password</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
