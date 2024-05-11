<?php

@include 'config.php';

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $street = $_POST['street'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, street, total_product, total_price) VALUES('$name','$number','$email','$method','$street','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>спасибо за заказ!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> итого : ₽".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> ваше имя : <span>".$name."</span> </p>
            <p> ваш номер : <span>".$number."</span> </p>
            <p> ваша почта : <span>".$email."</span> </p>
            <p> ваш адрес : <span>".$street."</span> </p>
            <p> ваш способ оплаты : <span>".$method."</span> </p>
            <p>(*оплатите, когда товар будет у вас*)</p>
         </div>
            <a href='products.php' class='btn'>продолжить покупки</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Оформление заказа</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="mycss/style.css">
   <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="mycss/main.css" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="mycss/main.css">
    <link href="mycss/base.css" rel="stylesheet">

</head>
<body>
<header>
   <div class="bg-light">
   <div class="container">
        <!-- Строка 1: Навигация -->
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand pull-left logo" href="index.php">Cosmetics Palffe</a>
                    <ul class="navbar-nav pull-right">
                        <li class="nav-item"><a class="nav-link" href="contact.html">Контакты</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">О нас</a></li>
                        <li class="nav-item d-flex"><a class="nav-link" href="cart.php">Корзина</a><?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a class= "nav-link text-light d-flex" href="cart.php" class="cart "> <span class="cart-digit"><?php echo $row_count; ?></li>

			</span> </a>
            </div>
                    </ul>
                </div> <!-- end container-fluid -->
            </nav>
            </div> <!-- end row -->
            </div> <!-- end container -->
        </header>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">Оформление заказа</h1>

   <form class="checkout_form" action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>Ваша корзина пуста!</span></div>";
      }
      ?>
      <span class="grand-total"> Итого :  ₽<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>ФИО</span>
            <input type="text" placeholder="Введите ваше ФИО" name="name" required>
         </div>
         <div class="inputBox">
            <span>Номер телефона</span>
            <input type="number" placeholder="Введите ваш номер" name="number" required>
         </div>
         <div class="inputBox">
            <span>E-mail</span>
            <input type="email" placeholder="Введите ваш e-mail" name="email" required>
         </div>
         <div class="inputBox">
            <span>Способ оплаты</span>
            <select name="method">
               <option value="наличные" selected>Наличные</option>
               <option value="карта">Карта</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Адрес доставки</span>
            <input type="text" placeholder="Введите ваш адрес" name="street" required>
         </div>
      </div>
      <input type="submit" value="Заказать" name="order_btn" class="checkout__btn btn-reserv">
   </form>
   <br><br>

</section>

</div>

   
<footer class="row">
        <div class="container">
        <div class="row">
        <div class="col-sm-2">
        <!--<img src="img/logo.png" class="img-responsive img-fluid">-->
        </div>
        <div class="col-sm-2">
            <h5>О компании</h5>
            <ul class="list-unstyled">
            <li><a href="#">Документация</a></li>
            <li><a href="#">Контакты</a></li>
            <li><a href="#">О нас</a></li>
            </ul>
            </div>
            <div class="col-sm-2">
            <h5>Социальные сети</h5>
            <ul class="list-unstyled">
            <li><a href="#">Facebook</a></1li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Blog</a></1li>
            </ul>
            </div>
            <div class="col-sm-2">
            <h5>Поддержка</h5>
            <ul class="list-unstyled">
            <li><a href="#">Условия и положения</a></li>
            <li><a href="#">Лицензия</a></li>
            <li><a href="#">Референсы</a></1li>
            </ul>
            </div>
            <div class="col-sm-4">
            <address>
            <strong>ASU College</strong><br>
            Barnaul, Komsomolsky Prospekt, 100<br>
            <abbr title="Телефон">Num.:</abbr> +7 (3852) 111-2222
        </address>
        </div>
        </div> <!-- end row -->
        </div> <!-- end container -->
        </footer>     
                  <script src="myjs/script.js"></script>

</body>
</html>