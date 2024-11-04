<?php
include("../Assets/Connection/Connection.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';


function welcomeEmail($email, $name){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "thegiftshop925@gmail.com"
; // Your Gmail
    $mail->Password = "mvzk jmld zjqa rfip"; // Your Gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('thegiftshop925@gmail.com', 'TheGiftShop'); // Your Gmail with sender name

    $mail->addAddress($email);

    $mail->isHTML(true);
    $message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Welcome to TheGiftShop</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
        .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { font-size: 24px; margin-bottom: 20px; color: #e67e22; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            Welcome to TheGiftShop, " . htmlspecialchars($name) . "!
        </div>
        <p>Hi " . htmlspecialchars($name) . ",</p>
        <p>Thank you for joining TheGiftShop as a seller! We are thrilled to have you on board and can't wait to see the amazing products you will bring to our community.</p>
        <p><strong>Important:</strong> Your account is currently under review by our administrator. Once your account has been verified, you'll receive a notification, and you'll be able to log in and start selling.</p>
        <p>Warm regards,<br>TheGiftShop Team</p>
        <div class='footer'>
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
";


    $mail->Subject = "Welcome to TheGiftShop!";
    $mail->Body = $message;
  
    if($mail->send()) {
        echo "<script>
                alert('Welcome email sent successfully');
                window.location='Login.php';
              </script>";
    } else {
        echo "<script>
                alert('Email sending failed');
              </script>";
    }
}

if (isset($_POST["btn_submit"])) {
    $district = $_POST["selDistrict"];
    $place = $_POST["selPlace"];
    $name = $_POST["txt_name"];
    $gender = $_POST["rd_gender"];
    $contact = $_POST["txt_cotact"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    $confirm = $_POST["txt_confirm"];

    // Check if email already exists
    $selUser = "select * from tbl_user where user_email='$email'";
    $selAdmin = "select * from tbl_admin where admin_email='$email'";
    $selSeller = "select * from tbl_seller where seller_email='$email'";
    $SelDAgent = "select * from tbl_deliveryagent where deliveryagent_email='$email'";

    $resUser = $con->query($selUser);
    $resAdmin = $con->query($selAdmin);
    $resSeller = $con->query($selSeller);
    $resDAgent = $con->query($SelDAgent);

    if ($resAdmin->num_rows > 0 || $resDAgent->num_rows > 0 || $resSeller->num_rows > 0 || $resUser->num_rows > 0) {
        echo '<script>alert("Mail id already exists")</script>';
    } else {
        // Handle file uploads
        $photo = $_FILES['file_photo']['name'];
        $tempphoto = $_FILES['file_photo']['tmp_name'];
        move_uploaded_file($tempphoto, '../Assets/Files/Userdocs/' . $photo);

        $profile = $_FILES['file_proof']['name'];
        $tempprofile = $_FILES['file_proof']['tmp_name'];
        move_uploaded_file($tempprofile, '../Assets/Files/Userdocs/' . $profile);

        $logo = $_FILES['file_logo']['name'];
        $templogo = $_FILES['file_logo']['tmp_name'];
        move_uploaded_file($templogo, '../Assets/Files/Userdocs/' . $logo);

        // Insert query
        $insQry = "INSERT INTO tbl_seller(district_id, place_id, seller_name, seller_gender, seller_contact, seller_email, seller_password, seller_photo, seller_proof, seller_logo) 
                    VALUES ('$district', '$place', '$name', '$gender', '$contact', '$email', '$password', '$photo', '$profile', '$logo')";

        if ($con->query($insQry)) {
            welcomeEmail($email,$name);
        } else {
            echo "Error: " . $con->error;
        }
    }
}
?>
<?php
ob_start();
include("Head.php");
?>

<section style="background: #F9F3EC; padding: 50px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg p-5">
                    <h2 class="text-center mb-4" style="color: black; font-weight: bold;">Seller Registration</h2>
                    <form id="form1" name="form1" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="selDistrict" style="font-weight: bold;">District</label>
                                <select name="selDistrict" class="form-control" onchange="getPlace(this.value)" required>
                                    <option value="---select---">---Select---</option>
                                    <?php
                                    $selQry = "SELECT * FROM tbl_district";
                                    $result = $con->query($selQry);
                                    while ($data = $result->fetch_assoc()) {
                                        echo '<option value="' . $data['district_id'] . '">' . $data['district_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="selPlace" style="font-weight: bold;">Place</label>
                                <select name="selPlace" class="form-control" id="place" required>
                                    <option value="---select---">---Select---</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="txt_name" style="font-weight: bold;">Name</label>
                            <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Enter your name" required />
                        </div>

                        <div class="form-group mb-3">
                            <label style="font-weight: bold;">Gender</label><br>
                            <input type="radio" name="rd_gender" value="Male" required /> Male
                            <input type="radio" name="rd_gender" value="Female" required /> Female
                        </div>

                        <div class="form-group mb-3">
                            <label for="txt_cotact" style="font-weight: bold;">Contact</label>
                            <input type="text" class="form-control" name="txt_cotact" id="txt_cotact" placeholder="Enter your contact number" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="txt_email" style="font-weight: bold;">Email</label>
                            <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Enter your email" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="txt_password" style="font-weight: bold;">Password</label>
                            <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Enter your password" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="txt_confirm" style="font-weight: bold;">Confirm Password</label>
                            <input type="password" class="form-control" name="txt_confirm" id="txt_confirm" placeholder="Confirm your password" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="file_photo" style="font-weight: bold;">Photo</label>
                            <input type="file" class="form-control" name="file_photo" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="file_proof" style="font-weight: bold;">Proof</label>
                            <input type="file" class="form-control" name="file_proof" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="file_logo" style="font-weight: bold;">Logo</label>
                            <input type="file" class="form-control" name="file_logo" required />
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Submit" />
                            <input type="reset" class="btn btn-secondary" name="btn_cancel" id="btn_cancel" value="Cancel" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getPlace(cid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?cid=" + cid,
            success: function (result) {
                $("#place").html(result);
            }
        });
    }
</script>

<?php
include("Foot.php");
ob_flush();
?>
