<?php
ob_start();
include("Head.php");


include("../Assets/Connection/Connection.php");
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>SEARCH</title>
  <style>
    <style>.star-rating {
      font-size: 24px;
      color: #DEAD6F !important;
    }

    .star-rating span {
      margin-right: 5px;
      font-size: xx-large;
    }

    body {
      background-color: #f7f7f7;
    }

    .filter-form {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
      margin: 20px auto;
      max-width: 1200px;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    /* Style for the input and select fields */
    .form-control,
    .form-select {
      padding: 10px 10px;
      border-radius: 5px;
      background-color: #fff;
      border: 1px solid #ced4da;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Style for the label */
    .form-label {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      /* background-color: white; */
      padding: 0 5px;
      transition: all 0.3s ease;
      pointer-events: none;
      color: #6c757d;
    }

    /* When input is focused or filled */
    .form-control:focus~.form-label,
    .form-control:not(:placeholder-shown)~.form-label,
    .form-select:focus~.form-label,
    .form-select:not([value=""])~.form-label {
      top: -10px;
      left: 8px;
      font-size: 0.8rem;
      color: #007bff;
    }

    .filter-form .form-control,
    .form-select {
      min-width: 180px;
    }

    /* To ensure the label behaves properly with select elements */
    .form-select:not([value=""])~.form-label {
      top: -10px;
      left: 8px;
      font-size: 0.8rem;
      color: #007bff;
    }
  </style>

  </style>
</head>


<body onload="getSearch()">
<a style="color:#48d1cc" href="MyCart.php">My Cart</a>  
<a style="color:#48d1cc" href="Wishlist.php">My Wishlist</a>
<div class="container">
<form id="form1" name="form1" method="post" class="filter-form">

      <!-- Product Name -->
      <div class="form-group">
        <input type="text" class="form-control" name="txt_pname" id="txt_pname" placeholder=" " onChange="getSearch()" />
        <label for="txt_pname" class="form-label">Product Name</label>
      </div>

      <!-- Category -->
      <div class="form-group">
        <select class="form-select" name="selCategory" id="selCategory" onChange="getSubCat(this.value),getSearch()">
          <option value="">Select</option>
          <?php
              $selqry="select * from tbl_category";
              $result=$con->query($selqry);
              while($data=$result->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['category_id']?>">
            <?php echo $data['category_name'];?>
          </option>
          <?php
          }
          ?>
        </select>
        <label for="selCategory" class="form-label">Category</label>
      </div>

      <!-- SubCategory -->
      <div class="form-group">
        <select class="form-select" name="selSubCategory" id="SubCat" onChange="getSearch()">>
          <option value="" >Select</option>
        </select>
        <label for="selSubCategory" class="form-label">SubCategory</label>
      </div>

      <!-- Brand -->
      <div class="form-group">
        <select class="form-select" name="brand_name" id="SubBrand" onChange="getSearch()">
          <option value="">Select</option>
          <?php
              $selqry="select * from tbl_brand";
              $result=$con-> query($selqry);
              while($data=$result->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['brand_id']?>">
            <?php echo $data['brand_name'];?>
          </option>
          <?php
          }
          ?>
        </select>
        <label for="SubBrand" class="form-label">Brand</label>
      </div>

      <!-- Min Price -->
      <div class="form-group">
          <input type="number" class="form-control" name="min_price" id="min_price" placeholder=" " onChange="getSearch()" />
          <label for="min_price" class="form-label">Min Price</label>
      </div>

      <!-- Max Price -->
      <div class="form-group">
          <input type="number" class="form-control" name="max_price" id="max_price" placeholder=" " onChange="getSearch()" />
          <label for="max_price" class="form-label">Max Price</label>
      </div>

    </form>
    <!-- Filter Form End -->

    <!-- Result Container -->
    <div class="container mt-4" id="result"></div>
  </div>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getSubCat(cid) {
    $.ajax({
      url: "../Assets/AjaxPages/Ajaxsubcat.php?cid=" + cid,
      success: function (result) {

        $("#SubCat").html(result);
      }
    });
  }
  function getSearch() {
    var cat = document.getElementById("selCategory").value;
    var pname = document.getElementById("txt_pname").value;
    var subcat = document.getElementById("SubCat").value;
    var brand = document.getElementById("SubBrand").value;
    var minPrice = document.getElementById("min_price").value;
    var maxPrice = document.getElementById("max_price").value;

    $.ajax({
        url: "../Assets/AjaxPages/AjaxSearch.php?cat=" + cat + "&pname=" + pname + "&subcat=" + "&minPrice=" + minPrice + "&maxPrice=" + maxPrice + subcat + "&brand=" + brand,
        success: function (result) {
            $("#result").html(result);
        }
    });
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

</html>
<?php
        include("Foot.php");
        ob_flush();
        ?>