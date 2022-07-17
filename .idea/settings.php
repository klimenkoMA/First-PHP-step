<?php
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/includes/global.inc';

//Проверить, вошел ли пользователь
if (isset($_SESSION['logged_in'])){

    header("Location: login.php");
}

//Взять объект из сессии
$user = unserialize($_SESSION['user']);

//Инициализировать php переменные, используемые в форме
$email = $user->email;
$message = "";

//проверить, отправлена ли форма
if (isset($_POST['submit_settings'])){
    //достать переменные из $_POST
    $email = $_POST['email'];

    $user->email = $email;
    $user->save();

    $message = "Settings Saved<br/>";
}

//Если форма не отправлена или не прошла проверку - показать форму снова
?>
<html>
<head>
    <title>Change Settings</title>
</head>
<body>
<?php echo $message;?>
<form action="settings.php" method="post">
    E-Mail: <input type="text" value="<?php echo $email;?>"
    name="email"/><br/>
    <input type="submit" value="Update" name="submit_settings" />
</form>
</body>

</html>
