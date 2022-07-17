<?php
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/classes/User.php';
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/classes/DB.php';

/**
 * Class UserTools
 * Log the user in. First check to see if the
 * username and password match a row in the database.
 * If it successfull, set the session variables
 * and store the user object within.
 */
class UserTools
{

    private $db;

    public function __construct(){
        $this->db = new DB();
    }
    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username, $password)
    {
        $hashedPassword = md5($password);
        $connections = $this;

//        $result = mysql_query("Select * from users
        $result = mysqli_query($connections,"Select * from users 
            where username = '$username' and password = '$hashedPassword'");

        if (mysqli_num_rows($result) == 1)
//        if (mysql_num_rows($result) == 1)
        {
            $_SESSION['user'] = serialize(new User(mysqli_fetch_assoc($result)));
            $_SESSION['login_time'] = time();
            $_SESSION['logged_in'] = 1;
            return true;
        }else{
            return false;
        }
    }


    /**
     *Log the user out. Destroy the session variables
     */
    public function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['login_time']);
        unset($_SESSION['logged_in']);
        session_destroy();
    }


    /**
     * Check to see if a username exists.
     * This is called during registration to make sure all
     * user names are unique.
     * @param $username
     */
    public function checkUsernameExists($username){
        $result = mysqli_query($this.connection_status(),"select id from users where username = '$username'");
//        $result = mysql_query("select id from users where username = '$username'");

        if (mysqli_num_rows($result == 0)){
//        if (mysql_num_rows($result == 0)){
            return false;
        }else{
            return true;
        }
    }


    /**
     * Get a user.
     * Returns a User object. Takes the users id as an input
     * @param $id
     */
    public function get($id){
        $db = new DB();
        $result = $db->select('users', "id=$id");
        return new User($result);
    }

}

?>