<?php
session_start();

include("../Assets/Connection/Connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

function generateOTP($length = 6) {
    $digits = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $otp;
}

function otpEmail($email,$otp){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'thegiftshop925@gmail.com';
    $mail->Password = 'mvzk jmld zjqa rfip';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('thegiftshop925@gmail.com');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
        .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { font-size: 24px; margin-bottom: 20px; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Your OTP Code</div>
        <p>Hello,</p>
        <p>Here is your One-Time Password (OTP) for verification:</p>
        <h2 style="font-size: 36px; color: #333;">' . $otp . '</h2>
        <p>This OTP is valid for the next 5 minutes. Please use it to complete your verification process.</p>
        <p>If you did not request this OTP, please ignore this email or contact support if you have concerns.</p>
        <p>Best regards,<br>Nethra Handloom</p>
        <div class="footer">This is an automated message. Please do not reply.</div>
    </div>
</body>
</html>
';
    $mail->Subject = "Reset your password";
    $mail->Body = $message;

    if($mail->send()) {
        echo "<script>alert('Email Sent'); window.location='OTP_Validator.php';</script>";
    } else {
        echo "<script>alert('Email Failed');</script>";
    }
}

if(isset($_POST['btn_submit'])){
    $email = $_POST['txt_email'];
    $selUser = "SELECT * FROM tbl_user WHERE user_email='".$email."'";    
    $selAdmin = "SELECT * FROM tbl_admin WHERE admin_email='".$email."'";
    $selSeller = "SELECT * FROM tbl_seller WHERE seller_email='".$email."'";
    $selDeliveryAgent = "SELECT * FROM tbl_deliveryagent WHERE deliveryagent_email='".$email."'";
    $resUser = $con->query($selUser);
    $resAdmin = $con->query($selAdmin);
    $resSeller = $con->query($selSeller);
    $resDeliveryAgent = $con->query($selDeliveryAgent);

    $otp = generateOTP();
    $_SESSION['otp'] = $otp;

    if($userData = $resUser->fetch_assoc()) {
        $_SESSION['ruid'] = $userData['user_ID'];
        otpEmail($email, $otp);
    } else if($adminData = $resAdmin->fetch_assoc()) {
        $_SESSION['raid'] = $adminData['admin_ID'];
        otpEmail($email, $otp);
    } else if($SellerData = $resSeller->fetch_assoc()) {
        $_SESSION['rwid'] = $SellerData['weaver_ID'];
        otpEmail($email, $otp);
    } else if($DeliveryAgentData = $resDeliveryAgent->fetch_assoc()) {
        $_SESSION['rsid'] = $DeliveryAgentData['artisan_ID'];
        otpEmail($email, $otp);
    } else {
        echo "<script>alert('Account Doesn\'t Exist');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text-center mb-4">Forgot Password</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="txt_email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button type="submit" name="btn_submit" class="btn btn-primary btn-block">Reset Password</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
