<?php

//user.class.php
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/classes/DB.php';

class User
{
    public $id;
    public $username;
    public $hashedPassword;
    public $email;
    public $joinDate;

//Constructor call when it create new object
    /*
     * Takes an associative array with the DB row as an argument.
     * */

    function __construct($data)
    {
        $this->id(isset($data['id'])) ? $data : "";
        $this->username(isset($data['username'])) ? $data['username'] : "";
        $this->hashedPassword(isset($data['password'])) ? $data['password'] : "";
        $this->email(isset($data['email'])) ? $data['email'] : "";
        $this->joinDate(isset($data['join_date'])) ? $data['join_date'] : "";
    }

    public function save($isNewUser = false)
    {
        //create a new database object
        $db = new DB();

        //if user is already registered and were
        //just updaiting their info
        if (!$isNewUser) {
            //set the data array
            $data = array(
                "username" => "'$this->username'",
                "password" => "'$this->hashedPassword'",
                "email" => "'$this->email'"
            );
            //update the row in database
            $db->update($data, 'users', 'id=' . $this->id);
        } else {
            //if user is being registered for the first time
            $data = array(
                "username" => "'$this->username'",
                "password" => "'$this->hashedPassword'",
                "email" => "'$this->email'",
                "join_date" => "'" . date("Y-m-d H:i:s", time()) . "'"
            );
            $this->id = $db->insert($data, 'users');
            $this->joinDate = time();
        }
        return true;

    }


}

?>