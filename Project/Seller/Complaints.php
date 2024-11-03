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
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-danger text-white text-center">
                <h4>Customer Complaints</h4>
            </div>
            <div class="card-body">
                <form id="form1" name="form1" method="post" action="">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">User</th>
                                <th scope="col">Product</th>
                                <th scope="col">File</th>
                                <th scope="col">Description</th>
                                <th scope="col">Reply</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $selQry = "select * from tbl_complaint c INNER JOIN tbl_product P ON c.product_id=p.product_id INNER JOIN tbl_user n ON c.user_id=n.user_id WHERE p.seller_id=".$_SESSION['sid'];
                        $result = $con->query($selQry);
                        $i = 0;
                        while ($data = $result->fetch_assoc())
                        {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['complaint_date']; ?></td>
                                <td><?php echo $data['complaint_title']; ?></td>
                                <td><?php echo $data['user_name']; ?></td>
                                <td><?php echo $data['product_name']; ?></td>
                                <td><img src="../Assets/Files/Userdocs/<?php echo $data['complaint_file']; ?>" class="img-thumbnail" width="100" height="100" /></td>
                                <td><?php echo $data['complaint_description']; ?></td>
                                <td><a href="Reply.php?cid=<?php echo $data['complaint_id']; ?>" class="btn btn-sm btn-info">Reply</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>
