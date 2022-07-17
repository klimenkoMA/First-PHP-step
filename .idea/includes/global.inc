<?php
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/classes/User.php';
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/classes/UserTools.php';
require_once  'D:/JAVA/PROJECTS/phpLesson/.idea/classes/DB.php';

/*
 * connect to database
 * */
$db = new DB();
$db->connect();

// initialize UserTools object
$userTools = new UserTools();

//start the session
session_start();

//refresh the session variables if logged in
if (isset($_SESSION['logged_in'])){
    $user = unserialize($_SESSION['user']);
    $_SESSION['user'] = serialize($userTools-> get($user->id));
}


?>