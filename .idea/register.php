<?php

//register php
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/includes/global.inc';

//инициализируем php переменные, которые используются в форме
$username = "";
$password = "";
$password_confirm = "";
$email = "";
$error = "";

//проверить, отправлена ли форма
if (isset($_POST['submit_form'])) {

    //получить переменные $_POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];

    //инициализировать переменные для проверки формы
    $success = true;
    $userTools = new UserTools();

    //проверить правильность заполнения формы
    //проверить, не занят ли этот логин
    if ($userTools->checkUserNameExists($username)) {
        $error = "Passwords do not match.<br/> \n\r";
        $success = false;
    }

    if ($success) {
        //подготовить информацию для сохранения объекта нового пользователя
        $data['username'] = $username;
        $data['password'] = $password;
        $data['email'] = $email;

        //создать новый объект пользователя
        $newUser = new User($data);

        //сохранить нового пользователя в БД
        $newUser->save(true);

        //войти
        $userTools->login($username, $password);

        //редирект на страницу приветствия
        header("Location: welcome.php");


    }

}
//если форма не отправлена или не прошла проверку, тогда показать форму снова

?>
<html>
<head>
    <title>
        Registration
    </title>
</head>
<body>
<?php echo ($error != "") ? $error : ""; ?>
<form action="register.php" method="post">

    Username: <input type="text" value="<?php echo $username; ?>"
                     name="username"/><br/>
    Password: <input type="password" value="<?php echo $password; ?>"
                     name="password"/><br/>
    Password (confirm): <input type="password" value="<?php echo
    $password_confirm; ?>"
                     name="password_confirm"/><br/>
    E-mail: <input type="email" value="<?php echo $email;?>"
    name = "email"/><br/>
    <input type="submit" value="Register" name="submit_form" /><br/>

</form>
</body>
</html>

