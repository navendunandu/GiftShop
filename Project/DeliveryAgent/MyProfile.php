<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();
$name=$_SESSION['dname'];
$dagentid=$_SESSION['did'];
$SelDAgent="select * from tbl_deliveryagent where deliveryagent_id=".$dagentid;
$resDAgent=$con->query($SelDAgent);
$data=$resDAgent->fetch_assoc();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .profile-card {
            margin-top: 20px;
        }
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%; /* Circular image */
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">YourAppName</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="MyProfile.php">My Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="EditProfile.php">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ChangePassword.php">Change Password</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="card profile-card">
        <div class="card-body text-center">
            <img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($data['deliveryagent_photo']); ?>" class="profile-image" alt="Profile Photo" />
            <h5 class="card-title mt-3"><?php echo htmlspecialchars($data['deliveryagent_name']); ?></h5>
            <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($data['deliveryagent_email']); ?></p>
            <p class="card-text"><strong>Contact:</strong> <?php echo htmlspecialchars($data['deliveryagent_contact']); ?></p>
            <a href="EditProfile.php" class="btn btn-primary">Edit Profile</a>
            <a href="ChangePassword.php" class="btn btn-secondary">Change Password</a>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; 2024 Your Company Name. All rights reserved.</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>