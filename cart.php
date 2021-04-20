<?php

if(isset($_GET['drop']) && $_GET['drop'] == "true"){
    $cartSize = count($_COOKIE['cart']);
    for ($i = 0; $i < $cartSize; $i++) {
        $encArr = ['region' => 'xx', 'id' => '0', 'size' => '0'];
        setcookie("cart[$i]", json_encode($encArr), time()-300);
    }
    header("Location: ./cart.php?success=true");
    die("Redirecting.");
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_COOKIE['cart'])){
        $enc_arr = ['region' => $_GET['region'], 'id' => $_GET['id'], 'size' => $_POST['size']];
        setcookie("cart[0]", json_encode($enc_arr), time()+300);
    }
    else{
        $cartSize = count($_COOKIE['cart']);
        $encArr = ['region' => $_GET['region'], 'id' => $_GET['id'], 'size' => $_POST['size']];
        setcookie("cart[$cartSize]", json_encode($encArr), time()+300);
    }
    header("Location: ./cart.php?success=true");
    die("Redirecting.");
}
function cartItems(){
    $cart_arr = $_COOKIE['cart'];
    $total_price = 0.0;
    $cartSize = count($_COOKIE['cart']);
    if ($cartSize == 0) {
        echo "<h3>Your cart is empty, please browse the <a href='./products.php'>products here</a>!</h3>";
    }
    foreach($cart_arr as $item){
        $dec_item = json_decode($item, true);
        $region = $dec_item['region'];
        $id = $dec_item['id'];
        $product_id = "product" . $id;
        $json_file = fopen("$region.json", 'r');
        $json_string = fread($json_file, filesize("$region.json"));
        $dec_list = json_decode($json_string, true);
        echo '<div class="cartdiv">';
        echo '<div class="cartitem">';
        echo "<img  class='cimg' src='./180.png' alt='", $dec_list[$product_id]['productName'], "'>";
        echo '<div class="details">';
        echo "<h3 class='priceusd'>",$dec_list[$product_id]['productName'], ' | ', $dec_list[$product_id]['productZone'], "</h3>";
        echo "<h3 class='priceusd'>", $dec_list[$product_id]['productPrice'], ' USD</h3>';
        echo '<p>Selected size: <b>', $dec_item['size'], '</b></p>';
        echo '<p class="description">', $dec_list[$product_id]['productDescription'], '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        $total_price += floatval($dec_list[$product_id]['productPrice']);
    }
    $cartSize = count($_COOKIE['cart']);
    if (!$cartSize == 0) {
        echo "<h2 class='totals'>Total: $", round($total_price, 2)," USD + free shipping</h2>";
    }
}
?>
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
        <h2>Shopping Cart (<?php echo count($_COOKIE['cart']) ?>)</h2>
        <!-- repeat cart div like this in a loop -->
        <?php cartItems() ?>
        
        <div class="cartcontrols">
            <button disabled="disabled" class="checkout" style="cursor: not-allowed;">checkout cart</button>
            <button onclick="window.location.href = './cart.php?drop=true';" class="removecart">clear cart</button>
        </div>
    </div>
    <div style="margin-bottom: 50px;">
        <p>&nbsp;</p>
    </div>
    <div class="footer">
        <span style="float:left">&nbsp;&copy; Regionwear 2021 all rights reserved&nbsp; </span>
        <span style="float:right">&nbsp;Updated April 19, 2021 &nbsp; - The Project 29 Team&nbsp; </span>
    </div>
</body>
</html>