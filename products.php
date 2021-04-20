<!DOCTYPE html>
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
        <h1>Products  </h1>
        <h2 style="text-align: center;">Palestine</h2>
        <div class="products">
            <?php get_prods('palestine') ?>
        </div>
        <h2 style="text-align: center;">Syria</h2>
        <p>
        
        <div class="products">
            <?php get_prods('syria') ?>
        </div>
        <p>
        <h2 style="text-align: center;">Jordan</h2>
        <div class="products">
           <?php get_prods('jordan') ?>
        </div>
      </div>
      <div class="footer">
        <span style="float:left">&nbsp;&copy; Regionwear 2021 all rights reserved&nbsp; </span>
        <span style="float:right">&nbsp;Updated April 19, 2021 &nbsp; - The Project 29 Team&nbsp; </span>
    </div>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set("display_errors", "on");
function get_prods($region){
    $json_file = fopen("$region.json", 'r');
    $json_string = fread($json_file, filesize("$region.json"));
    fclose($json_file);
    $region_products = json_decode($json_string, true);
    $prod_im_string = 'productImage';
    $prod_name_string = 'productName';
    $prod_desc_string = 'productDescription';
    $i = 0;
    while(isset($region_products["product".$i])){
        $prod_i_string = 'product' . $i;
        echo "<div class='product'>", "\n";
        echo "<img src=", '180.png' /*$region_products[$prod_i_string]['productImage']*/," class='prodimg' alt='placeholder'/>", "\n";
        echo "<a href='product.php?region=", $region, "&id=", $i, "'><h4> ", $region_products[$prod_i_string]['productName'], "</h4></a>", "\n";
        echo "<p> ", $region_products[$prod_i_string]['productDescription'], "</p>", "\n";
        echo "</div>"; 
        $i++;
    }
}
?>