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
   <title>Товар</title>

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
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand pull-left logo" href="index.php">Cosmetics Palffe</a>
                    <ul class="navbar-nav pull-right">
                        <li class="nav-item"><a class="nav-link" href="contact.php">Контакты</a></li>
                        <li class="nav-item"><a class="nav-link" href="orders.php">История заказов</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">О нас</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Выйти</a></li>
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
        <section class="ware">
            <div class="container">
                <div class="bg-ware">
                    <div class="wrapper-inf float-end ">
                        <div class="inf-good">
                        <h1 class="peptide-title">PEPTIDE GLAZING FLUIDE</h1>
                        <h3 class="wrapper-inf-text">Сыворотка для сияния и увлажнения кожи</h3>
                        <p class="peptide-text">Богатая питательными веществами легкая эссенция, которая усиливает барьерную функцию и обеспечивает мгновенное сияющее увлажнение. Важный подготовительный шаг, чтобы успокоить кожу и начать процедуру.</p>
                        <br>
                        <p class="peptide-text peptide-text-m">Та же формула глазури, теперь в нашей новой глазурованной упаковке с ног до головы. Размер: 140 мл/4,7 жидких унций.</p>
                        <a href="cart.php" class="ware-buy">Купить - $30.00</a>
                        <ul class="accordion-list">
    <li class="line-list">
        <h3>ПРЕИМУЩЕСТВА <span class="mouse float-end">+</span></h3>
        <p class="text-start">
            • Обеспечивает увлажнение в течение всего дня<br>
            • Подготавливает кожу к лучшему впитыванию продукта<br>
            • Помогает уменьшить покраснения с течением времени<br>
            • Успокаивает раздраженную кожу
        </p>
    </li>
    <li class="line-list">
        <h3>ПРИМЕНЕНИЕ <span class="mouse float-end">+</span></h3>
        <p class="text-start">После утреннего/ вечернего очищения нанесите достаточное количество крема на руки и аккуратно распределите по коже лица, шеи и декольте. Затем нанесите глазурь и взбейте для достижения оптимального результата. Перед использованием взболтайте.</p>
    </li>
    <li class="line-list">
        <h3>СОСТАВ <span class="mouse float-end">+</span></h3>
        <p class="text-start">Water (Aqua) (Eau), C12-15 Alkyl Benzoate, Coconut Alkanes, Glycerin, Polyglyceryl-3 Oleate, Polyglyceryl-10 Mono/Dioleate, Tocopheryl Acetate, Sodium Hyaluronate.</p>
    </li>
</ul>
<script>
    let accordions = document.querySelectorAll('.accordion-list h3');

    for(let accordion of accordions) {
        let panel = accordion.nextElementSibling;
        panel.style.display = 'none';

        accordion.addEventListener('click', function() {
            for (let otherPanel of document.querySelectorAll('.accordion-list p')) {
                if (otherPanel !== panel) {
                    otherPanel.style.display = 'none';
                    otherPanel.previousElementSibling.querySelector('span').textContent = '+';
                }
            }

            if (panel.style.display === 'block') {
                panel.style.display = 'none';
                this.querySelector('span').textContent = '+';
            } else {
                panel.style.display = 'block';
                this.querySelector('span').textContent = '-';
            }
        });
    }
</script>
</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="review">
            <div class="container">
                <h1 class="section_title text-center">ОТЗЫВЫ</h1>
                <br>
                <center>
                <div class="rew">
                    <img src="img/ratingsta.png" alt="рейтинг" class="sta">
                    <img src="img/rew.png" alt="200 отзывов" class="rew offset-1">
                </div>
                </center>
                <div class="d-flex">
                    <h3 class="person">Kate</h3>
                    <img src="img/stars.png" alt="" class="starz">
                </div>
                <p class="rewik">Приятный аромат. Я не русская, брови у меня густые, жесткие и темные, поэтому когда я наношу этот гель, он никуда не слетает, сколько бы я ни морщила брови, они вообще не шевелятся.Приятный аромат. Я не русская, брови у меня густые, жесткие и темные, поэтому когда я наношу этот гель, он никуда не слетает, сколько бы я ни морщила брови, они вообще не шевелятся.</p>
                <center><a id="sign-btn" class="center-block btn-next btn-default btn-new btn-lg pull-right" href="#" role="button">далее</a></center>
                <br>
            </div>
        </section>

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