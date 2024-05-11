<?php 
include 'configM.php';
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
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand pull-left logo" href="index.php">Cosmetics Palffe</a>
                    <ul class="navbar-nav pull-right">
                        <li class="nav-item"><a class="nav-link" href="contact.php">Контакты</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">О нас</a></li>

			</span> </a>
                </div> <!-- end container-fluid -->
            </nav>
            </div> <!-- end row -->
            </div> <!-- end container -->
            </div>
        </header>
        <section class="entry">
            <center>
            <div class="container">
            <div class="wrapper-main d-flex">
            <div class="wrapper-left ">
                <img src="img/bg-kylie.png" alt="It’s time to invest in your BEAUTY." style="width: 562px; height: 600px;" class="bg-kylie">
            </div>
            <div class="wrapper-right offset-2">
            <div class="content">
            <br><br>
            <br>
            <h1 class="section-title-entry">регистрация</h1>
            <br><br>
    <form class="formm" action="" method="post">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="lname">Имя:</label>
        <div class="col-sm-10">
        <input style=" width: 350px; border-color: black" class="form-control itemf" type="text" id="lname" name="lname" required><br>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="fname">Фамилия:</label>
        <div class="col-sm-10">
        <input style=" width: 350px; border-color: black" class="form-control itemf" type="text" id="fname" name="fname" required><br>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="password">Пароль:</label>
        <div class="col-sm-10">
        <input style=" width: 350px; border-color: black" class="form-control itemf" type="password" id="password" name="password" pattern=".{8,}" onblur="if (this.value.length < 8) { this.style.borderColor='red'; } else { this.style.borderColor=''; }" required>
        <p class="password_comm d-flex justify-content-end">*Не менее 8 символов</p>
        
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="email">Почта:</label>
        <div class="col-sm-10">
        <input style=" width: 350px; border-color: black" class="form-control itemf" type="email" id="email" oninput="checkEmail()" name="email" required><br>
        </div>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $lname = $_POST['lname'];  
    $fname = $_POST['fname'];  
    $email = $_POST['email'];  
    $password = $_POST['password']; 

    // Подготавливаем запрос для выбора пользователя с такой почтой
    $stmt = $mysqli -> prepare("SELECT id FROM login WHERE email = ?");
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $stmt -> store_result();
    
    if($stmt->num_rows > 0) {
        echo "<script>alert('Ошибка: пользователь с такой почтой уже существует');</script>";
    } else {
        // Используем подготовленный запрос для вставки данных для предотвращения SQL-инъекций
        $stmt = $mysqli -> prepare("INSERT INTO login (lname, fname, email, password) VALUES (?, ?, ?, ?)");
        $stmt -> bind_param("ssss", $lname, $fname, $email, $password);
        
        if ($stmt -> execute()) { 
            echo "<script>alert('Регистрация успешна!');</script>";
        } else { 
            echo "<script>alert('Ошибка при регистрации: " . $mysqli->error . "');</script>";
        }
    }
    

    $stmt -> close();
    $mysqli -> close(); 
}
?>
        <script>
          function checkEmail() {
            let emailField = document.getElementById('email');
            let emailValue = emailField.value;
            let isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue);
            if (!isValid) {
              emailField.style.borderColor = 'red';
            } else {
              emailField.style.borderColor = '';
            }
          }

          </script>
      </div>
      <input class="btn btn-primary btn-reg btn-lg" type="submit" value="Зарегистрироваться">
    </form>
    <br>

</div>
<p>Уже есть аккаунт?<a class="reg-link" href="login.php">Войти</a></p>
<br><br>
</div>
</center>
            </div>
            </div>
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
<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>