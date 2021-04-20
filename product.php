<?php
$region = $_GET['region'];
$id = $_GET['id'];
$product_id = "product" . $id;
$json_file = fopen("$region.json", 'r');
$json_string = fread($json_file, filesize("$region.json"));
fclose($json_file);
$region_products = json_decode($json_string, true);
function get_info($param){
    global $region_products, $product_id;
    echo $region_products[$product_id][$param];
}
?>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <title>Region Wear</title>
 <link href="style.css" rel="stylesheet">
 <link rel="icon" type="image/png" href="./favicon.ico"/>
</head>
<body>
    <div id="navigation">
        <ul>
            <li><img onclick="window.location = './home.html';" class="logo" src="logo.jpg" alt="region wear"/></li>
            <li><a href="home.html">home</a></li>
            <li><a id="active_tab" href="products.php">products</a></li>
            <li><a href="info.html">info</a></li>
            <li><a href="contact.html">contact us</a></li>
            <li><span id="cart"><img style="position: absolute; right: 25px; height: 30px; top: 13px;" alt="cart" src="cart.png"/></span></li>
        </ul>
    </div>
    <div id="main-content">
        <div class="productdiv">
            <h2><?php get_info('productName') ?> | <?php get_info('productZone') ?> </h2>
            <img  class="pimg" src="./180.png" alt="PRODUCT NAME">
            <div class="details">
                <h3 class="priceusd"><?php get_info('productPrice') ?></h3>
                <form action="cart.php?region=<?php echo $region ?>&id=<?php echo $id ?>" method="POST">
                    <label for="size">Choose a size:</label>
                    <select name="size" id="size">
                        <option value="large">Large</option>
                        <option value="medium">Medium</option>
                        <option value="small">Small</option>
                    </select>
                    <p class="description"><?php get_info('productDescription') ?></p>
                    <input type="submit" class="addcart" value="add to cart">
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <span style="float:left">&nbsp;&copy; Regionwear 2021 all rights reserved&nbsp; </span>
        <span style="float:right">&nbsp;Updated April 19, 2021 &nbsp; - The Project 29 Team&nbsp; </span>
    </div>
</body>
</html>