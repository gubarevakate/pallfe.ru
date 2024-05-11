<?php
session_start();
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
<!doctype html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
        <!-- Адаптация под мобильные приложения -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="mycss/base.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="mycss/style.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <script src="script.js" defer></script>
        <title>Palffe</title>
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
                        <li class="nav-item"><a class="nav-link" href="about.php">О нас</a></li>
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
            </div>
        </header>
        <section id="intro-header">
            <div class="container bg">
            <!-- строка 2 -->
            <div class="row">
                <div class="wrap-headline">
                    <h1 class="text-center">Cosmetics Palffe</h1>
                    <h2 class="text-center">by paletka & ffevle</h2>
                    <hr>
                    <ul id="hideUl" class="list-inline list-unstyled text-center">
                        <li class="list-inline-item">
                        <a id="sign-btn" class="btn btn-default btn-login btn-lg" href="login.php" role="button">Вход</a>
                        </li>
                        <li class="list-inline-item">
                        <a id="why-btn" class="btn btn-primary btn-reg btn-lg" href="registration.php" role="button">Регистрация</a>
                        </li>
                    </ul>
                    <form id="signid hidden-element" class="form-inline col-6 container hidden-element">
                        <div id="show-content" class="row g-3 align-items-center forma justify-content-center">
                            <div class="col-auto">
                                <span id="basic-addon1" class=" text-white text-white">
                                  @
                                </span>
                              </div>
                            <div class="col-auto">
                              <input type="email" id="contact-email" class="form-control" aria-describedby="emailHelp">
                            </div>
                            <div class="col-auto">
                              <span id="basic-addon1" class="form-text text-white">
                                *
                              </span>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="contact-email" class="form-control" aria-describedby="passwordHelpInline">
                              </div>
                              <div class="col-auto">
                                <button id="out-btn" type="submit" class="btn btn-primary">Log in</button>
                              </div>
                          </div>
                    </form>
                </div>
            </div> <!-- end row -->
            </div> <!-- end container -->
            </section>
            <br><br>
            
            <section id="about">
                <div class="container">
                    <!-- строка 3 -->
                    <div class="row new-first-product">
                            <h3 class="new">NEW</h3>
                            <div class="col-sm-6"> <!-- Столбец 1 -->
                                <img class="glazing" src="img/glazing.jpg" style="width: 285px; height: 300px; margin-right: 43px;" class="img-responsive img-fluid">
                                <img src="img/services-1.png"  class="img-responsive img-fluid">
                            </div>
                            <div class="col-sm-6 new-product-content"> <!-- Столбец 2 -->
                                <h3 class="new-product-title">PEPTIDE GLAZING FLUIDE</h3>
                                <p>Легкая, быстро впитывающаяся гелевая сыворотка, которая заметно уплотняет и увлажняет кожу, поддерживая здоровый вид кожного барьера. Размер: 50 мл/1,7 унции.</p>
                                    <h5 class="title-benefits">преимущества</h5>
                                    <ul class="benefits"> <li>Заметно уплотняет и увлажняет кожу.</li> 
                                        <li>Мгновенно придает сияние, создавая сияющий вид.</li>
                                        <li>Поддерживает здоровый кожный барьер с течением времени.</li>
                                    </ul>
                                    <a id="sign-btn" class="btn btn-default btn-new btn-lg offset-7" href="#" role="button" name="add_to_cart">в корзину</a>
                                    <a id="sign-btn" class="btn btn-default btn-new btn-lg pull-right" href="card-f.php" role="button">подробнее</a>
                            </div>
                    </div> <!-- end row -->
                            <hr>
                    <!-- строка 4 -->
                        <div class="row new-first-product new-first-product-dop">
                            <h3 class="new text-end new-two">NEW</h3>
                            <div class="col-sm-6 new-product-content">
                                <h3 class="new-product-title">PEPTIDE LIP TINT</h3>
                                <p>Тинт для губ. Прозрачный, но стойкий цвет, который тает на губах, создавая легкий оттенок и насыщенный глянцевый оттенок. Восстанавливающая формула без отдушек делает губы естественно пухлыми, увлажненными и питаемыми изнутри. Размер: 10 мл / 0,3 жидких унции.
                                </p>
                                <h5 class="title-benefits">преимущества</h5>
                                <ul class="benefits"> <li>Тинт для губ и уход в одном средстве.</li> 
                                    <li>Восстанавливает и восполняет сухие губы.</li>
                                    <li>Помогает удерживать влагу, делая губы заметно более пухлыми и мягкими.</li>
                                </ul>
                                <a id="sign-btn" class="btn btn-default btn-new btn-lg " href="#" role="button">в корзину</a>
                                <a id="sign-btn" class="btn btn-default btn-new btn-lg pull-right" href="card-t.php" role="button">подробнее</a>
                        </div>
                        <div class="col-sm-6">
                            <img class="glazing" src="img/lip-bg.jpg" style="width: 285px; height: 300px; margin-right: 43px;" class="img-responsive img-fluid">
                        <img src="img/services-2.png" class="img-responsive img-fluid ">
                        </div>
                        </div> <!-- end row -->
                    </div> <!-- end container -->
                </section>
                <br><br>

                <section class="products">

<h1 class="heading text-center">Все продукты</h1>

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
         <input type="submit" class="btn btn-reg btn-cart-index" value="Добавить в корзину" name="add_to_cart">
      </div>
   </form>
   </div>
      </div>
   <?php
      };
   };
   ?>
   </section>
        <!-- Раздел 4 -->
        <br><br>
        <br><br>
<section id="features">
        <div class="container">
        <!-- строка 5 -->
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-center sostav">Состав косметики</h3>
                    <p class="text-center">Для более точного и быстрого подбора косметических средств вы можете ознакомиться <br> с основными составлющими, а также обратиться к нашим онлайн- консультантам</p>
                </div>
            </div> <!-- end row -->
            <!-- строка 6 -->
            <div class="row">
                    <div class="col-sm-2 col-md-4">
                    <div class="feature"><h5>ПЕПТИДЫ</h5>
                        <p>Активные аминокислоты, которые заметно разглаживают кожу и уменьшают видимость тонких линий.
                        </p>
                        </div>
            </div>
                    <div class="col-sm-2 col-md-4">
                    <div class="feature"> <h5>МАСЛО ШИ</h5>
                        <p>Увлажняет при помощи 5 незаменимых жирных кислот (включая витамины Е, D, А и аллантион)
                        </p></div>
            </div>
                    <div class="col-sm-2 col-md-4">
                    <div class="feature"> <h5>НИАЦИНАМИД</h5>
                        <p>Питает и уменьшает морщины + улучшает общую текстуру кожи
                        </p></div>
            </div>
                    <div class="col-sm-2 col-md-4">
                    <div class="feature"> <h5>БАБАССУ</h5>
                        <p>Богатый природный источник лауриновой кислоты, известный своей способностью укреплять микробиом и восполнять общую влажность кожи.
                        </p></div>
            </div>
                    <div class="col-sm-2 col-md-4">
                    <div class="feature"> <h5>ГИАЛУРОНОВАЯ <br>КИСЛОТА</h5>
                        <p>Поддерживает гидратацию, удерживает воду + восполняет влагу в клетках
                        </p></div>
            </div>
                    <div class="col-sm-2 col-md-4">
                    <div class="feature"> <h5>СКВАЛАН</h5>
                        <p>Мощное смягчающее средство, увлажняет и смягчает кожу.
                        </p></div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
    </section>
    <br><br>
    <br><br>
    <!-- Раздел 5 -->
<section id="pricing">
    <div class="container">
    <!-- строка 7 -->
    <div class="row">
    <div class="col-sm-12">
    <h3 class="text-center price-headline heading">PAFFLE MAKE UP BOX</h3>
    </div>
    </div>
    <!-- строка 8 -->
    <div class="row">
    <div class="col-sm-12">
    <table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
    <th class="table-secondary">
    <h4 class="text-center">paletka</h4>
    </th>
    <th class="table-secondary">
    <h4 class="text-center">ffevle</h4>
    </th>
    <th class="table-secondary">
    <h4 class="text-center">hunted</h4>
    </th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td class="table-hover">
    <h5 class="text-center">&#8364; 100</h5>
    </td>
    <td class="table-hover">
    <h5 class="text-center">&#8364; 190</h5>
    </td>
    <td class="table-hover">
    <h5 class="text-center">&#8364; 350</h5>
    </td>
    </tr>
    <tr>
    <td>fade cream</td>
    <td>powder</td>
    <td>blush</td>
    </tr>
    <tr>
    <td>fade cream</td>
    <td>blush</td>
    <td>highliter</td>
    </tr>
    <tr>
    <td>sponges</td>
    <td>sponges</td>
    <td>sponges</td>
    </tr>
    <tr>
    <td>-</td>
    <td>lipstick</td>
    <td>mascara</td>
    </tr>
    <tr>
    <td>-</td>
    <td>-</td>
    <td>matt lipstick</td>
    </tr>
    <tr>
    <td><a href="#" class="btn btn-dark btn-block col-12">Заказать</a></td>
    <td><a href="#" class="btn btn-dark btn-block col-12">Заказать</a></td>
    <td><a href="#" class="btn btn-dark btn-block col-12">Заказать</a></td>
    </tr>
    </tbody>
    </table>
    </div> <!-- end сol -->
    </div> <!-- end row -->
    </div> <!-- end container -->
    </section>
    <br><br>
    <!-- Форма -->
<section id="pricing">
<div class="container">
    <h4>Подпишитесь на рассылку, чтобы узнавать о скидках и поступлениях.</h4>
    <form class="row justify-content-center gy-2" method="POST">
    <div class="col-auto">
    </div>
    <div class="col-auto">
    </div>
    <input class="form-control" placeholder="Name" name="name">
    <input class="form-control" placeholder="E-mail" name="email">
    <div class="col-auto">
    <button type="submit" class="btn btn-reg btn-subscribe">Подписаться</button>
    </div>
    </form>
    </div>
    <hr>
    </section>
    <br><br>
    <section class="slider">
      <div class="container">
        <div class="slider-bg">
        <h1 class="text-start slider-title">
          YOU + PALFFE
        </h1>
        <center>
        <div class="wrapper">
          <div class="carousel">
            <img src="images/img-1.png" alt="img" draggable="false">
            <img src="images/img-2.png" alt="img" draggable="false">
            <img src="images/img-3.png" alt="img" draggable="false">
            <img src="images/img-4.jpg" alt="img" draggable="false">
            <img src="images/img-5.jpg" alt="img" draggable="false">
            <img src="images/img-6.jpg" alt="img" draggable="false">
            <img src="images/img-7.jpg" alt="img" draggable="false">
            <img src="images/img-8.jpg" alt="img" draggable="false">
            <img src="images/img-9.jpg" alt="img" draggable="false">
          </div>
          <div class="float-right">
            <i id="left" class="fa-solid float-right fa-angle-left"></i>
          <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
      
        </div>
      </div>
    </center>
  </div>
  <br><br>
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
        <?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";



// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

if (isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];

  // Добавляем данные в базу данных
  $sql = "INSERT INTO subscribers (name, email) VALUES ('$name', '$email')";

  if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Вы успешно подписались на рассылку!");</script>';
  } else {
      echo "Ошибка: " . $sql . "<br>" . $conn->error;

  }
}

// Закрываем соединение с базой данных
$conn->close();
?>
<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>