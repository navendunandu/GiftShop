<?php
ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
    /* Custom style for complaint replies */
    .reply-text {
      color: #343a40; /* Dark gray color for replies */
      font-weight: bold;
    }
    /* Custom style for warning messages */
    .warning-text {
      color: #856404; /* Darker yellow for warning */
      font-weight: bold;
    }
  </style>
</head>

<body>

<div class="container mt-5">
  <!-- Complaints Table -->
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="card-title">Your Complaints</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>SlNo</th>
            <th>Title</th>
            <th>Description</th>
            <th>Product</th>
            <th>File</th>
            <th>Reply</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $userid = $_SESSION['uid'];
          $selQry = "select * from tbl_complaint c inner join tbl_product p on c.product_id=p.product_id WHERE user_id=".$userid;
          $result = $con->query($selQry);
          $i = 0;
          while ($data = $result->fetch_assoc()) {
              $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['complaint_title']; ?></td>
            <td><?php echo $data['complaint_description']; ?></td>
            <td><?php echo $data['product_name']; ?></td>
            <td>
              <img src="../Assets/Files/Userdocs/<?php echo $data['complaint_file']; ?>" width="100" height="100" class="img-fluid">
            </td>
            <td>
            <?php 
              if ($data['complaint_status'] == 0) {
                  echo "<span class='warning-text'>Your complaint is not reviewed yet</span>"; // Apply custom class for warning
              } else if ($data['complaint_status'] == 1) {
                  echo "<span class='reply-text'>" . $data['complaint_reply'] . "</span>"; // Apply custom class for replies
              }
              ?>
            </td>
            <td><?php echo $data['complaint_date']; ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
