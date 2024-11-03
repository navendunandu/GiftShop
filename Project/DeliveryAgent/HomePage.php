<?php
ob_start();
include("Head.php");
session_start();
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
        <div class="card-body">
            <h5 class="card-title">Welcome, <?php echo htmlspecialchars($_SESSION['dname']); ?></h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="MyProfile.php" class="btn btn-link">My Profile</a></li>
                <li class="list-group-item"><a href="EditProfile.php" class="btn btn-link">Edit Profile</a></li>
                <li class="list-group-item"><a href="ChangePassword.php" class="btn btn-link">Change Password</a></li>
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>