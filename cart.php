<?php

@include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/base.css">
   <link href="mycss/base.css" rel="stylesheet">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Корзина</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="mycss/style.css">

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
                        <li class="nav-item"><a class="nav-link" href="contact.php">Контакты</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">О нас</a></li>
                        <li class="nav-item"><a class="nav-link" href="orders.php">История заказов</a></li>
                        

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

<section class="shopping-cart">

<h1 class="section-title text-center">КОРЗИНА</h1>

   <table>

      <thead>
         <th>Фото</th>
         <th>Наименование</th>
         <th>Цена</th>
         <th>Кол-во</th>
         <th>Всего</th>
         <th>Операция</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>₽<?php echo number_format($fetch_cart['price']); ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="Редактировать" name="update_update_btn">
               </form>   
            </td>
            <td>₽<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('удалить товар из коризины?')" class="delete-btn"> <i class="fas fa-trash"></i> удалить</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="products.php" class="option-btn shop-cont" style="margin-top: 0;">Продолжить покупки</a></td>
            <td colspan="3">Итого:</td>
            <td>₽<?php echo $grand_total; ?></td>
            <td><a href="cart.php?delete_all" onclick="return confirm('вы уверены, что хотите удалить всё?');" class="delete-btn"> <i class="fas fa-trash"></i> удалить всё </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn btn-ord<?= ($grand_total > 1)?'':'disabled'; ?>">Перейти к оформлению</a>
   </div>

</section>

</div>
<footer class="row fixed-bottom">
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
<!-- custom js file link  -->
<script src="myjs/script.js"></script>

</body>
</html>