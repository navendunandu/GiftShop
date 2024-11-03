<?php
ob_start();
include("Head.php");
include("../Assets/Connection/connection.php");

$id = $_GET['pID'];
$selQry = "SELECT * FROM tbl_product p 
           INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcategory_id 
           INNER JOIN tbl_category c ON s.category_id = c.category_id 
           INNER JOIN tbl_seller sl ON sl.seller_id = p.seller_id 
           INNER JOIN tbl_brand b ON b.brand_id = p.brand_id 
           WHERE p.product_id = " . $id;
$result = $con->query($selQry);
$row = $result->fetch_assoc();
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <style>
    .product-main-img {
      width: 100%;
      height: 450px;
      object-fit: cover;
      border-radius: 5px;
    }
    .thumbnail-img {
      height: 100px;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.2s;
    }
    .thumbnail-img:hover {
      transform: scale(1.1);
    }
    .details-section h2, .details-section h4 {
      color: #343a40;
    }
    .price {
      color: #28a745;
      font-weight: bold;
      font-size: 1.5rem;
    }
    .star-rating {
      color: #DEAD6F;
      font-size:32px;
    }
    .btn-cart, .btn-wishlist {
      padding: 10px 20px;
      font-weight: bold;
      font-size: 1.1rem;
    }
    .btn-cart {
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-cart:hover {
      background-color: #218838;
    }
    .btn-wishlist {
      background-color: transparent;
      color: #FF6B6B;
      border: none;
      cursor: pointer;
      transition: transform 0.2s;
    }
    .btn-wishlist:hover {
      transform: scale(1.2);
    }
  </style>
</head>

<body>
<div class="container mt-5">
  <div class="row">
    <!-- Product Image Section -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body text-center">
          <img src="../Assets/Files/Gallery/<?php echo $row['product_photo'] ?>" id="mainImage" class="product-main-img mb-3" alt="Main Product Image">
          <div class="d-flex justify-content-center">
            <?php
              echo '<img src="../Assets/Files/Gallery/' . $row['product_photo'] . '" class="thumbnail-img mx-1" onclick="changeMainImage(this.src)" alt="Product Image">';
            $selGal = "SELECT * FROM tbl_gallery WHERE product_id=" . $id;
            $gresult = $con->query($selGal);
            while ($pic = $gresult->fetch_assoc()) {
              echo '<img src="../Assets/Files/Gallery/' . $pic['gallery_image'] . '" class="thumbnail-img mx-1" onclick="changeMainImage(this.src)" alt="Product Image">';
            }
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Details Section -->
    <div class="col-md-6">
      <div class="details-section">
        <h2><?php echo $row['product_name']; ?></h2>
        <h4 class="text-muted"><?php echo $row['category_name'] . " / " . $row['subcategory_name']; ?></h4>
        <h4 class="brand text-muted">Brand: <?php echo $row['brand_name']; ?></h4>
        
        <!-- Star Rating Section -->
        <a href="Rating.php?pid=<?php echo $id?>&action=view"><div class="star-rating mb-2">
          <?php
            for ($i = 1; $i <= 5; $i++) {
              echo $i <= $averageRating ? "<span>&#9733;</span>" : "<span>&#9734;</span>";
            }
          ?>
        </div></a>

        <p class="price">Price: ₹<?php echo $row['product_price']; ?></p>
        <p class="description"><?php echo $row['product_details']; ?></p>

        <!-- Cart and Wishlist Buttons -->
        <div class="d-flex flex-wrap mt-3">
          <?php if($rem > 0) { ?>
            <button onclick="addCart('<?php echo $row['product_id']?>')" class="btn-cart me-3">
              Add to Cart
            </button>
          <?php } else { ?>
            <button onclick="toast('Out of stock', 'error')" class="btn-cart me-3" style="background-color: red;">
              Out of Stock
            </button>
          <?php } ?>
          
          <button onclick="wishlist('<?php echo $row['product_id']?>')" class="btn-wishlist">
            <span style="font-size: 1.5rem;">&#10084;</span> <!-- Heart icon -->
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to change main image on thumbnail click -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  function changeMainImage(src) {
    document.getElementById('mainImage').src = src;
  }
  function addCart(pid) {
    $.ajax({
      url: '../Assets/AjaxPages/AjaxAddCart.php?pid=' + pid,
      success: function (response) {
        if (response == "Added to cart") {
          toast(response, 'success');
        } else if (response == "Already Added to Cart") {
          toast(response, 'warning');
        } else {
          toast("Something Went Wrong!", 'error');
        }
      }
    });
  }

  function wishlist(pid) {
    $.ajax({
      url: '../Assets/AjaxPages/AjaxWishList.php?id=' + pid,
      success: function (response) {
        if (response == "Added to Wishlist") {
          toast(response, 'success');
        } else if (response == "Removed from Wishlist") {
          toast(response, 'success');
        } else {
          toast("Something Went Wrong!", 'error');
        }
      }
    });
  }

  // Create a toast notification when the button is clicked
  function toast(msg, varient) {
    // Set the background color based on the variant
    let backgroundColor;
    if (varient === "success") {
      backgroundColor = "#4CAF50"; // Green for success
    } else if (varient === "warning") {
      backgroundColor = "#FFC107"; // Yellow for warning
    } else if (varient === "error") {
      backgroundColor = "#F44336"; // Red for error
    } else {
      backgroundColor = "#333"; // Default color (gray) if no valid variant is provided
    }

    // Show the toast notification
    Toastify({
      text: msg,        // Message to display
      duration: 3000,   // 3 seconds
      close: true,      // Show close button
      gravity: "top",   // Position at the top
      position: "right", // Align to the right
      backgroundColor: backgroundColor, // Set the background color
    }).showToast();
  }
</script>
</script>
</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
