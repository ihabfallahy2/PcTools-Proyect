<?php
include "../conectarbd.php";
if(isset($_REQUEST['nombre'])){
  // echo $_REQUEST['nombre'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php foreach (product_nf($_REQUEST['nombre']) as $element) {echo $element['nombre'];}?></title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- CSS -->
    <link href="../../conf/product-style.css" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />

  </head>

  <body>
    <main class="container">

      <!-- Left Column / Headphones Image -->
      <div class="left-column">
        <img data-image="black" src="../productos/<?php foreach (product_nf($_REQUEST['nombre']) as $element) {echo $element['nombre'];}?>.jpg" alt="">
        <img data-image="blue" src="../productos/<?php foreach (product_nf($_REQUEST['nombre']) as $element) {echo $element['nombre'];}?>.jpg" alt="">
        <img data-image="red" class="active" src="../productos/<?php foreach (product_nf($_REQUEST['nombre']) as $element) {echo $element['nombre'];}?>.jpg" alt="">
      </div>


      <!-- Right Column -->
      <div class="right-column">

        <!-- Product Description -->
        <div class="product-description">
          <span><?php foreach (product_nf($_REQUEST['nombre']) as $element) {echo $element['familia'];}?></span>
          <h1><?php foreach (product_nf($_REQUEST['nombre']) as $element) {echo $element['nombre'];}?></h1>
          <p><?php foreach (product_nf($_REQUEST['nombre']) as $element) {echo $element['descripcion'];}?></p>
        </div>

        <!-- Product Configuration -->
        <div class="product-configuration">

          <!-- Product Color -->
          <div class="product-color">
            <span>Color</span>

            <div class="color-choose">
              <div>
                <input data-image="black" type="radio" id="black" name="color" value="black">
                <label for="black"><span></span></label>
              </div>
            </div>

          </div>

          <!-- Cable Configuration -->
          <div class="cable-config">
            <span>Cable configuration</span>

            <div class="cable-choose">
              <button>Straight</button>
              <button>Coiled</button>
              <button>Long-coiled</button>
            </div>

            <a href="#">How to configurate your headphones</a>
          </div>
        </div>

        <!-- Product Pricing -->
        <div class="product-price">
          <span>148$</span>
          <a href="#" class="cart-btn">Add to cart</a>
        </div>
      </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="../../js/script.js" charset="utf-8"></script>
  </body>
</html>
<?php }?>