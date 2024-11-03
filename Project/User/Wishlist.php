<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

$user_id = $_SESSION['uid'];
$selQry = "SELECT * FROM tbl_product p 
            INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcategory_id 
            INNER JOIN tbl_category c ON s.category_id = c.category_id 
            INNER JOIN tbl_brand b ON p.brand_id = b.brand_id  
            INNER JOIN tbl_wishlist w ON w.product_id = p.product_id 
            WHERE user_id = " . $user_id;

$result = $con->query($selQry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Link to your CSS file -->
    <style>
        <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .wishlist-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex; /* Use Flexbox */
        flex-wrap: wrap; /* Allow wrapping to the next line */
        gap: 20px; /* Space between items */
    }
    .product-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        flex: 1 1 30%; /* Allow the cards to grow and shrink, with a base width of 30% */
        box-sizing: border-box; /* Include padding and border in width calculations */
    }
    .product-card img {
        width: 150px; /* Fixed width */
        height: 150px; /* Fixed height */
        object-fit: cover; /* Maintain aspect ratio and cover the area */
        border-radius: 8px;
    }
    .product-info {
        text-align: center;
    }
    .product-info p {
        margin: 5px 0;
    }
</style>

    </style>
</head>
<body>

<div class="wishlist-container">
    <h1>Your Wishlist</h1>
    <?php
    while ($data = $result->fetch_assoc()) {
    ?>
        <div class="product-card">
            <img src="../Assets/Files/Userdocs/<?php echo $data['product_photo']; ?>" alt="<?php echo $data['product_name']; ?>">
            <div class="product-info">
                <p><strong>Product:</strong> <?php echo $data['product_name']; ?></p>
                <p><strong>Category:</strong> <?php echo $data['category_name']; ?></p>
                <p><strong>SubCategory:</strong> <?php echo $data['subcategory_name']; ?></p>
                <p><strong>Brand:</strong> <?php echo $data['brand_name']; ?></p>
                <p><strong>Price:</strong> $<?php echo number_format($data['product_price'], 2); ?></p>
                <p><strong>Details:</strong> <?php echo $data['product_details']; ?></p>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<?php
include("Foot.php");
?>
</body>
</html>
