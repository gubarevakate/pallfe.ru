<?php

$host="localhost";
$user="root";
$password="";
$db="user";

session_start();


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST["email"];
	$password=$_POST["password"];


	$sql="select * from login where email='".$email."' AND password='".$password."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row["usertype"]=="user")
	{	

		$_SESSION["email"]=$email;

		header("location:products.php");
	}

	elseif($row["usertype"]=="admin")
	{

		$_SESSION["email"]=$email;
		
		header("location:admin.php");
	}

	else
	{
		echo "email or password incorrect";
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
                    <a class="navbar-brand pull-left" href="index.php">Cosmetics Palffe</a>
                    <ul class="navbar-nav pull-right">
                        <li class="nav-item"><a class="nav-link" href="contact.php">Контакты</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">О нас</a></li>

                    </ul>
                </div> <!-- end container-fluid -->
            </nav>
            </div> <!-- end row -->
            </div> <!-- end container -->
            </div>
        </header>
        <section class="entry">
            <div class="container">
            <div class="wrapper-main d-flex">
            <div class="wrapper-left ">
                <img src="img/bg-kylie.png" alt="It’s time to invest in your BEAUTY." style="width: 562px; height: 600px;" class="bg-kylie">
            </div>
            <div class="wrapper-right offset-2">
            <center>
<br><br>
<br><br>

	<h1 class="section-title-entry">ВХОД</h1>
	<div>
		<br><br>


		<form action="#" method="POST">

	<div>
		<div class="form-group row">
		<label class="col-sm-2 col-form-label text-start">Email</label>
		<div class="col-sm-10">
		<input style=" width: 350px; border-color: black" class="form-control" type="email" id="email" name="email" oninput="checkEmail()" required>
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
		</div>
	</div>
	<br><br>

	<div>
		<div class="form-group row">
		<label class="col-sm-2 col-form-label ">Пароль</label>
		<div class="col-sm-10">
		<input style=" width: 350px; border-color: black" class="form-control" type="password" name="password" pattern=".{8,}" onblur="if (this.value.length < 8) { this.style.borderColor='red'; } else { this.style.borderColor=''; }" required>
		</div>
		</div>
	</div>
	<br><br>

	<div>
		
		<input class="btn btn-primary btn-reg btn-lg btn-entry" type="submit" value="Войти">
	</div>
	<br>


	</form>
 </div>
 <p>Нет аккаунта?<a class="reg-link" href="registration.php">Зарегистрироваться</a></p>
 <br></br>
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