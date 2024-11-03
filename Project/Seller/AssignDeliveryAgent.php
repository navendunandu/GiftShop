<?php
session_start();
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 if(isset($_POST["btn_submit"]))
 {
	$agent=$_POST["selAgent"];
	$upQry="update tbl_cart set cart_status=3, deliveryagent_id=".$_POST['selAgent']." where cart_id=".$_GET['id'];
	if($con->query($upQry)){
	?>
    <script>
	alert("Assigned")
	window.location="UserBooking.php"
	</script>
    <?php	
	}
 }
 
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4>Assign Delivery Agent</h4>
            </div>
            <div class="card-body">
                <form name="form1" method="post" action="">
                    <div class="mb-3">
                        <label for="selAgent" class="form-label">Select Delivery Agent</label>
                        <select class="form-select" name="selAgent" id="selAgent">
                            <option value="----select----">----select----</option>
                            <?php
                            $SelQry="select * from tbl_deliveryagent where seller_id='".$_SESSION['sid']."'";
                            $result=$con->query($SelQry);
                            while($data=$result->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data['deliveryagent_id']?>"><?php echo $data['deliveryagent_name'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
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