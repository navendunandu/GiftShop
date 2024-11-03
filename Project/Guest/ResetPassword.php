<?php
include("../Assets/Connection/connection.php");
session_start();

if (isset($_POST['btn_change'])) {
    $new = $_POST['txt_pass'];
    $retype = $_POST['txt_cpass'];

    if ($new != $retype) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $updateQuery = "";

        if (isset($_SESSION['rwid'])) {
            $updateQuery = "UPDATE tbl_weaver SET weaver_password='$new' WHERE weaver_ID=" . $_SESSION['rwid'];
        } elseif (isset($_SESSION['ruid'])) {
            $updateQuery = "UPDATE tbl_user SET user_password='$new' WHERE user_ID=" . $_SESSION['ruid'];
        } elseif (isset($_SESSION['rsid'])) {
            $updateQuery = "UPDATE tbl_artisan SET artisan_password='$new' WHERE artisan_ID=" . $_SESSION['rsid'];
        }

        if ($updateQuery && $con->query($updateQuery)) {
            echo "<script>alert('Password Updated'); window.location='LogOut.php';</script>";
            session_destroy();
        } else {
            echo "<script>alert('Password update failed');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text-center mb-4">Reset Password</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="txt_pass">New Password</label>
                    <input type="password" name="txt_pass" id="txt_pass" class="form-control" placeholder="Enter new password" required>
                </div>
                <div class="form-group">
                    <label for="txt_cpass">Confirm Password</label>
                    <input type="password" name="txt_cpass" id="txt_cpass" class="form-control" placeholder="Re-enter new password" required>
                </div>
                <button type="submit" name="btn_change" class="btn btn-primary btn-block">Change Password</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
