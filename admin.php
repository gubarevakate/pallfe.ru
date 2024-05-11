 <?php
session_start();


if(!isset($_SESSION["email"]))
{
	header("location:login.php");
}

?>


<?php

@include 'config.php';

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_category = $_POST['p_category'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, category, price, image) VALUES('$p_name', '$p_category', '$p_price', '$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Продукт добавлен успешно';
   }else{
      $message[] = 'Продукт не был добавлен';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'Продукт удален';
   }else{
      header('location:admin.php');
      $message[] = 'Продукт не был удален';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_category = $_POST['update_p_category'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', category = '$update_p_category', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'Продукт обновлен успешно';
      header('location:admin.php');
   }else{
      $message[] = 'Продукт не был обновлен';
      header('location:admin.php');
   }

}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="mycss/style.css">
        <link href="mycss/base.css" rel="stylesheet">
        <script src="myjs/script.js" defer></script>
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
                        <li class="nav-item"><a class="nav-link" href="orders-admin.php">История заказов</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Выйти</a></li>

                    </ul>
                </div> <!-- end container-fluid -->
            </nav>
            </div> <!-- end row -->
            </div> <!-- end container -->
            </div>
        </header>
         <section>
            <div class="container">

            <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
               <h3 class="section-title">Добавить новый продукт</h3>
               <input style="border: 1px solid black" type="text" name="p_name" placeholder="Введите наименование" class="box" required>
               <input style="border: 1px solid black" type="number" name="p_price" min="0" placeholder="Введите цену" class="box" required>
               <input style="border: 1px solid black" type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
               <select style="border: 1px solid black" name="p_category" class="box" required>
               <option value="skincare">Уход</option>
               <option value="makeup">Макияж</option>
            </select>
               <input type="submit" value="Добавить продукт" name="add_product" class="btn">
            </form>

         </section>

         <section class="display-product-table">
            <div class="container">

               <table>

                  <thead>
                     <th>Фото</th>
                     <th>Наименование</th>
                     <th>Категория</th>
                     <th>Цена</th>
                     <th>Операция</th>
                  </thead>

                  <tbody>
                     <?php
                     
                        $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                        if(mysqli_num_rows($select_products) > 0){
                           while($row = mysqli_fetch_assoc($select_products)){
                     ?>

                     <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td>₽<?php echo $row['price']; ?></td>
                        <td>
                           <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Вы уверены, что хотите удалить данный товар?');"> <i class="fas fa-trash"></i> Удалить </a>
                           <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Редактировать </a>
                        </td>
                     </tr>

                     <?php
                        };    
                        }else{
                           echo "<div class='empty'>no product added</div>";
                        };
                     ?>
                  </tbody>
               </table>
               </div>

         </section>
         <section class="edit-form-container">

               <?php
               
               if(isset($_GET['edit'])){
                  $edit_id = $_GET['edit'];
                  $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
                  if(mysqli_num_rows($edit_query) > 0){
                     while($fetch_edit = mysqli_fetch_assoc($edit_query)){
               ?>

               <form action="" method="post" enctype="multipart/form-data">
                  <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                  <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                  <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                  <select name="update_p_category" class="box" required>
                     <option value="skincare" <?php if($fetch_edit['category'] == 'skincare') echo "selected"; ?>>skincare</option>
                     <option value="makeup" <?php if($fetch_edit['category'] == 'makeup') echo "selected"; ?>>makeup</option>
                     <!-- Добавьте другие категории по мере необходимости -->
                  </select>
                  <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                  <input type="submit" value="Редактировать" name="update_product" class="btn">
                  <input type="reset" value="Назад" id="close-edit" class="option-btn">
               </form>

               <?php
                        };
                     };
                     echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
                  };
               ?>

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
            <!-- Bootstrap JS -->
            <script>
               document.querySelector('#close-edit').onclick = () =>{
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = 'admin.php';
};
            </script>
            <script src="js/bootstrap.min.js"></script>
            </body>
            </html>