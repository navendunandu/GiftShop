<?php
session_start();
include("../Connection/Connection.php");
$sel="SELECT * FROM tbl_wishlist where user_id=".$_SESSION['uid']." and product_id=".$_GET['id'];
$res=$con->query($sel);
if($res->fetch_assoc()){
    $qry="DELETE from tbl_wishlist where user_id=".$_SESSION['uid']." and product_id=".$_GET['id'];
    if($con->query($qry)){
        echo "Removed from Wishlist";
    }
    else{
        echo "Failed";
    }
}
else{
    $qry="INSERT into tbl_wishlist(user_id,product_id) values(".$_SESSION['uid'].",".$_GET['id'].")";
    if($con->query($qry)){
        echo "Added to Wishlist";
    }
    else{
        echo "Failed";
    }
}
?>