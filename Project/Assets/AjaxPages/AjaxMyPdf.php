<?php
session_start();
include("../Connection/Connection.php");
require '../phpMail/src/Exception.php';
require '../phpMail/src/PHPMailer.php';
require '../phpMail/src/SMTP.php';
require '../dompdf/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Print the request method for debugging



// Check if any data was received
if (isset($_POST["printContents"])) {
    // Decode the JSON data
    $selUser="SELECT * FROM tbl_user where user_id =". $_SESSION["uid"];
    $resUser=$con->query($selUser);
    $data=$resUser->fetch_assoc(); 
    $name=$data['user_name'];
    $email=$data['user_email'];

    // Now you have the JSON data as an associative array
    $htmlContent = $_POST["printContents"];




  

    // Replace the <img> tag in your HTML content with the base64-encoded image
    
    $html = $htmlContent;


    // Create a PDF object
    $pdf = new Dompdf\Dompdf();

    // Load HTML content
    $pdf->loadHtml($html);

    // Render the PDF (optional: set paper size, orientation, etc.)
    $pdf->setPaper('A3', 'portrait');

    // Render the PDF
    $pdf->render();

    // Get the PDF content
    $pdfContent = $pdf->output();

    $pdfFilename = sys_get_temp_dir() . '/bill.pdf'; // Specify the filename directly
    file_put_contents($pdfFilename, $pdfContent);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "thegiftshop925@gmail.com"
; // Your Gmail
    $mail->Password = "mvzk jmld zjqa rfip"; // Your Gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('thegiftshop925@gmail.com', 'TheGiftShop'); 
    $mail->addAddress($email);//to Gmail Address

    $mail->addAttachment($pdfFilename);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your Payment Confirmation and Invoice';
        $mail->Body = "
            <p>Dear $name,</p>
            <p>Thank you for your recent payment. Please find attached the invoice for your records.</p>
            <p>If you have any questions, feel free to reach out to us.</p>
            <p>Best regards,<br>TheGiftShop</p>
        ";

    if ($mail->send()) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed. Error: " . $mail->ErrorInfo;
    }

    unlink($pdfFilename);

} else {
    // Handle the case where no data was received in the POST request
    echo "No data received.";
}

?>