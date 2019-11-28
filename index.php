<?php 

error_reporting(-1);



if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))

{

$connect = mysqli_connect('localhost','root','','my_db');
if (!$connect) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_set_charset($connect,"utf8") or die ('Не установлена кодировка');


{
$this_name = mysqli_real_escape_string($connect,trim($_POST['username']));
$this_email = mysqli_real_escape_string($connect,trim($_POST['email']));
$this_password = mysqli_real_escape_string($connect,trim($_POST['password']));

if (!empty($this_name) && !empty($this_email) && !empty($this_password)) {
	
	
	
	$query = "SELECT * FROM `users` WHERE email = '$this_email'";
	$data = mysqli_query($connect,$query) or die (mysqli_error($connect));
	if (mysqli_num_rows($data) == 0) {
		mysqli_query($connect,"INSERT INTO `users` (name,email,password) VALUES ('$this_name','$this_email','$this_password')");
		echo 'Всё хорошо, можете авторизоваться';
		mysqli_close($connect);
		exit();
	}else {
		echo 'Почта уже существует';
	}
} 


}
} 

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="main.css">
	<title>Регистрация</title>
</head>
<body>
	<div class="mydiv1">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	
	<p><label for="username">Имя <span class="forSpan"><input class = <?php if (isset($_POST['submit'])&&empty($_POST['username'])) echo 'text1'; else echo 'text'?> type="text" name="username"></span></label></p>
	<?php if (isset($_POST['submit'])&&empty($_POST['username'])) echo '<p style="color:black;">Поле ввода логина пустое</p>'?>
	<p><label for="email">e-mail <span class="forSpan"><input class = <?php if (isset($_POST['submit'])&&empty($_POST['email'])) echo 'text1'; else echo 'text'?> type="text" name="email"></span></label></p>
	<?php if (isset($_POST['submit'])&&(empty($_POST['email'])||!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) echo '<p style="color:black;">Поле ввода почты пустое или некорректно</p>'?>
	
	<p><label for="password">Пароль <span class="forSpan"><input class = <?php if (isset($_POST['submit'])&&empty($_POST['password'])) echo 'text1'; else echo 'text'?> type="password" name="password"></span></label></p>
	<?php if (isset($_POST['submit'])&&empty($_POST['password'])) echo '<p style="color:black;">Поле ввода пароля пустое</p>'?>
	<p><button class="btn" type="submit" name="submit">Регистрация</button></p>
	</form>
	</div>
	
	
	
</body>
</html>










