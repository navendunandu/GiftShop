
<div class="isotope-container row">
<?php
include("../Connection/Connection.php");
session_start();
$cat=$_GET["cat"];
$pname=$_GET["pname"];
$subcat=$_GET["subcat"];
$brand=$_GET["brand"];
$minPrice = $_GET["minPrice"];
$maxPrice = $_GET["maxPrice"];

$selQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on s.category_id=c.category_id inner join tbl_brand b on p.brand_id=b.brand_id WHERE TRUE";
if($cat!="")
{
	$selQry=$selQry." and s.category_id=".$cat;
}
if($pname!="")
{
	$selQry=$selQry." and p.product_name LIKE '%$pname%'";
}
if($subcat!="")
{
	$selQry=$selQry." and p.subcategory_id=".$subcat;
}
if($brand!="")
{
	$selQry=$selQry." and p.brand_id=".$brand;
}
if ($minPrice != "") {
    $selQry .= " AND p.product_price >= " . $minPrice;
}
if ($maxPrice != "") {
    $selQry .= " AND p.product_price <= " . $maxPrice;
}
$result=$con->query($selQry);
$i=0;
while($data=$result->fetch_assoc())
{
	$id=$data['product_id'];
	$cart="select sum(cart_quantity) as cart_total from tbl_cart where product_id='$id'";
	$cresult=$con->query($cart);
	$cdata=$cresult->fetch_assoc();
	$Stock="select sum(stock_quantity) as total_stock from tbl_stock where product_id='$id'";
	$sresult=$con->query($Stock);
	$sdata=$sresult->fetch_assoc();
	$rem=$sdata['total_stock']-$cdata['cart_total'];
	$query = "SELECT SUM(rating_value) as rating, COUNT(*) as count FROM tbl_rating WHERE product_id = $id";
$resultS = $con->query($query);

// Check if the query returned a resultS
    $rowS = $resultS->fetch_assoc();
    $totalRating = $rowS['rating'];
    $ratingCount = $rowS['count'];

    // Avoid division by zero
    if ($ratingCount > 0) {
        $averageRating = $totalRating / $ratingCount;
    } else {
        $averageRating = 0;
    }

?>	

<div class="item cat col-md-4 col-lg-3 my-4">
  <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
	New
  </div> -->
  <div class="card position-relative">
	<a href="ViewMore.php?pID=<?php echo $data['product_id'] ?>"><img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" class="img-fluid rounded-4 search-img" alt="image"></a>
	<div class="card-body p-0">
	  <a href="ViewMore.php?pID=<?php echo $data['product_id'] ?>">
		<h3 class="card-title pt-4 m-0"><?php echo $data ["product_name"]; ?></h3>
	  </a>

	  <div class="card-text">
	 <a href="Rating.php?pid=<?php echo $data['product_id']?>&action=view"> <div class='star-rating' style="
    color: #DEAD6F;
">
		<?php
for ($i = 1; $i <= 5; $i++) {
	if ($i <= $averageRating) {
		echo "<span>&#9733;</span>"; // Filled star
	} else {
		echo "<span>&#9734;</span>"; // Empty star
	}
}
		?>
		</div></a>

		<h3 class="secondary-font text-primary">₹&nbsp;<?php echo $data ["product_price"]; ?></h3>

		<div class="d-flex flex-wrap mt-3">
			<?php
				if($rem>0){
			?>
		  <a href="javascript:void(0)" onClick="addCart('<?php echo $data['product_id']?>')" class="btn-cart me-3 px-4 pt-3 pb-3">
			<h5 class="text-uppercase m-0">Add to Cart</h5>
		  </a>
		  <?php
				}
				else{
					?>
		<a href="javascript:void(0)" onclick="toast('Out of stock', 'error')"  class="btn-cart me-3 px-4 pt-3 pb-3">
			<h5 class="text-uppercase m-0" style="color:red">Out of Stock</h5>
		  </a>
					<?php
				}
				?>
		  <a href="javascript:void(0)" onclick="wishlist('<?php echo $data['product_id']?>')" class="btn-wishlist px-4 pt-3 ">
			<iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
		  </a>
		</div>


	  </div>

	</div>
  </div>
</div>




<?php
}

?>
</div>

<style>
	.search-img{
		height: 350px !important;
    width: 100% !important;
    object-fit: cover !important;
	}
</style>