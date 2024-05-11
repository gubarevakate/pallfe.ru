<?php
session_start();


if(!isset($_SESSION["email"]))
{
	header("location:login.php");
}
?>

<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Продукт уже добавлен в корзину';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'Продукт успешно добавлен в корзину';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    <link href="mycss/base.css" rel="stylesheet">
   <title>Продукты</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="mycss/style.css">
</head>
<body>
<?php


if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<header>
   <div class="bg-light">
   <div class="container">
        <!-- Строка 1: Навигация -->
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand pull-left logo" href="index.php">Cosmetics Palffe</a>
                    <ul class="navbar-nav pull-right">
                        <li class="nav-item"><a class="nav-link" href="contact.php">Контакты</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">О нас</a></li>
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

   <section class="photo-nav">
   <div class="container">
  <div class="row">
    <div class="col p-0 d-flex justify-content-center align-items-center">
    <a class="skmk" href="#skincare"><img src="img/sk.png" class="img-fluid"></a>
    </div>
    <div class="col p-0 d-flex justify-content-center align-items-center">
    <a class="skmk" href="#makup"> <img src="img/mk.png" class="img-fluid"></a>
    </div>
  </div>
</div>

   </section>

<section class="products">

   <h1 class="heading">Все продукты</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="row">

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">₽<?php echo $fetch_product['price']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="Добавить в корзину" name="add_to_cart">
         </div>
      </form>
      </div>

      <?php
         };
      };
      ?>
      </section>
      <section class="skincare" id="skincare">
      <h1 class="heading">Товары для ухода</h1>
      <div class="box-container">
      <?php

      // SQL-запрос для выборки товаров категории "уход"
$sql_skincare = "SELECT id, name, price, image FROM products WHERE category = 'skincare'";
$result_skincare = $conn->query($sql_skincare);

// Выводим товары категории "уход" в форме
if ($result_skincare->num_rows > 0) {
    while($row = $result_skincare->fetch_assoc()) {
        ?>
        <div class="row">
        <form action="" method="post">
            <div class="box">
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="">
                <h3><?php echo $row['name']; ?></h3>
                <div class="price">₽<?php echo $row['price']; ?></div>
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                <input type="submit" class="btn" value="Добавить в корзину" name="add_to_cart">
            </div>
        </form>
        </div>
        <?php

    }
} else {
    echo "Нет товаров для ухода";
}
?>

</section>
<section class="makup" id="makup">
<h1 class="heading">Товары для макияжа</h1>
<div class="box-container">
<?php
// SQL-запрос для выборки товаров категории "макияж"
$sql_makeup = "SELECT id, name, price, image FROM products WHERE category = 'makeup'";
$result_makeup = $conn->query($sql_makeup);

// Выводим товары категории "макияж" в форме
if ($result_makeup->num_rows > 0) {
    while($row = $result_makeup->fetch_assoc()) {
        ?>
        <div class="row">
        <form action="" method="post">
            <div class="box">
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="">
                <h3><?php echo $row['name']; ?></h3>
                <div class="price">₽<?php echo $row['price']; ?></div>
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                <input type="submit" class="btn" value="Добавить в корзину" name="add_to_cart">
            </div>
        </form>
        </div>
        <?php
    }
} else {
    echo "Нет товаров для макияжа";
}
?>
</section>


   </div>

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
<!-- custom js file link  -->
<script src="myjs/script.js"></script>

</body>
</html>