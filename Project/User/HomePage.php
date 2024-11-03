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
        .myBg {
  background: linear-gradient(135deg, #f9f3ec, #ffffff);
  padding: 40px 0;
}
    .filter-container {
      margin-top: 20px;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-label {
      position: absolute;
      top: -8px;
      left: 15px;
      background: #fff;
      padding: 0 5px;
      font-size: 0.8rem;
      color: #6c757d;
    }

    /* Ensure label styling for select elements */
    .form-select:not([value=""])~.form-label {
      top: -8px;
      font-size: 0.8rem;
      color: #007bff;
    }
  </style>
</head>


<body onload="getSearch()">
<section id="banner" style="background: #F9F3EC;">
    <div class="container">
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="../Assets/Templates/Main/images/cupcake.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal" style="
                color: rgb(255, 234, 172);
            ">Best place for buying <span class="text-primary" style="
            color: #e88b95 !important;">gifts
                    for your loved ones</span>
                </h2>
                <a href="#result" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="../Assets/Templates/Main/images/cupcake.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary"> gifts crafted with care
                  </span>
                </h2>
                <a href="#result" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="../Assets/Templates/Main/images/banner-img4.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary">your
                    pets</span>
                </h2>
                <a href="#result" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
        </div>

        <div class="swiper-pagination mb-5"></div>

      </div>
    </div>
  </section>  
  
<div class="container-fluid myBg  py-5">
<div class="container">
<form id="form1" name="form1" method="post">
      <!-- First Row: Product Name, Min Price, Max Price -->
      <div class="row mb-3">
        <div class="col-md-4">
          <input type="text" class="form-control" name="txt_pname" id="txt_pname" placeholder="Product Name" onChange="getSearch()" />
          
        </div>

        <div class="col-md-4">
          <input type="number" class="form-control" name="min_price" id="min_price" placeholder="Min Price" onChange="getSearch()" />
       
        </div>

        <div class="col-md-4">
          <input type="number" class="form-control" name="max_price" id="max_price" placeholder="Max Price" onChange="getSearch()" />
          
        </div>
      </div>

      <!-- Second Row: Category, SubCategory, Brand -->
      <div class="row">
        <div class="col-md-4">
          <select class="form-select" name="selCategory" id="selCategory" onChange="getSubCat(this.value),getSearch()">
            <option value="">Select Category</option>
            <?php
                $selqry="select * from tbl_category";
                $result=$con->query($selqry);
                while($data=$result->fetch_assoc()) {
            ?>
            <option value="<?php echo $data['category_id']?>"><?php echo $data['category_name'];?></option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="col-md-4">
          <select class="form-select" name="selSubCategory" id="SubCat" onChange="getSearch()">
            <option value="">Select</option>
          </select>
          
        </div>

        <div class="col-md-4">
          <select class="form-select" name="brand_name" id="SubBrand" onChange="getSearch()">
            <option value="">Select Brand</option>
            <?php
                $selqry="select * from tbl_brand";
                $result=$con->query($selqry);
                while($data=$result->fetch_assoc()) {
            ?>
            <option value="<?php echo $data['brand_id']?>"><?php echo $data['brand_name'];?></option>
            <?php
            }
            ?>
          </select>
          
        </div>
      </div>
    </form>

    <!-- Result Container -->
    <div class="container mt-4" id="result"></div>
  </div>
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