<?php
 ob_start();
 include("Head.php");
 include("../Assets/Connection/connection.php");

 if(isset($_POST['btn_reply']))
 {
    // Escape special characters in the reply text
    $reply = mysqli_real_escape_string($con, $_POST['txt_reply']);
    
    // Prepare the query
    $insQry = "UPDATE tbl_complaint SET complaint_reply='$reply', complaint_status='1' WHERE complaint_id=" . $_GET['cid'];

    if($con->query($insQry))
    {
        // Successfully updated
    }
    else
    {
        echo "Error: " . $con->error;
    }
 }
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
      <div class="card-header bg-primary text-white">
        <h4 class="card-title">Reply</h4>
      </div>
      <div class="card-body">
        <form id="form1" name="form1" method="post" action="">
          <div class="form-group">
            <label for="txt_reply">Your Reply</label>
            <input type="text" class="form-control" name="txt_reply" id="txt_reply" placeholder="Type your reply here" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" id="btn_reply" name="btn_reply">Reply</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>