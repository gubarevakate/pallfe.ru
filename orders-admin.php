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

    <style>
    table {
      border-collapse: collapse;
      width: 70%;
      margin: 0 auto;
    }

    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>

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
                    <li class="nav-item"><a class="nav-link" href="admin.php">Добавить продукт</a></li></li>
                        
            </div>
                    </ul>
                </div> <!-- end container-fluid -->
            </nav>
            </div> <!-- end row -->
            </div> <!-- end container -->
        </header>
        <?php include 'header.php'; ?>
        <div class="container">
  <br>
  <center>
  <h1 class="section-title">История заказов</h1>
  <br>
  </center>
  </div>
  <?php 
include 'config.php';   
// Выборка данных из базы данных 
$sql = "SELECT name, number, email, method, street, total_product, total_price, status FROM `order`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
              <th>Имя</th>
              <th>Номер телефона</th>
              <th>Email</th>
              <th>Способ оплаты</th>
              <th>Адрес</th>
              <th>Заказ</th>
              <th>Итого</th>
              <th>Действие</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        $status = $row["status"];
        $buttonClass = ($status == "выполнен") ? "btn-completed" : "btn-not-completed";
        
        echo "<tr>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["number"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["method"] . "</td>
                    <td>" . $row["street"] . "</td>
                    <td>" . $row["total_product"] . "</td>
                    <td>" . $row["total_price"] . "</td>
                    <td>";
        
                    echo "<button class='btn-in-progress' data-orderid='$order_id'>В обработке</button>";  

                    if ($status == "выполнен") {  
                        echo "<button class='btn-completed'>Выполнен</button>"; 
        }
        
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
 
$conn->close(); 
?>  
  <script>
     $('.btn-in-progress').click(function() {
       var orderId = $(this).data('orderid');
       $.ajax({
           type: 'POST',
           url: 'update_status.php',
           data: { orderId: orderId, newStatus: 'выполнен' },
           success: function(response) {
               alert(response); // Выводим ответ от сервера
               location.reload(); // Перезагружаем страницу
           },
           error: function(xhr, status, error) {
               alert('Произошла ошибка при обновлении статуса заказа.');
           }
       });
   });
  </script>
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