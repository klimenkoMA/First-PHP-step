<?php

require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/classes/User.php';
require_once 'D:/JAVA/PROJECTS/phpLesson/.idea/classes/UserTools.php';
class DB
{
    protected $db_name = 'phplessondb';
    protected $db_user = 'root';
    protected $db_pass = '';
    protected $db_host = 'localhost';

//Открывает соединение к БД. Убедитесь, что
//эта функция вызывается на каждой странице
    public function connect()
    {
//        $connection = mysql_connect($this->db_host,
        $connection = mysqli_connect($this->db_host,
            $this->db_user, $this->db_pass);

//        mysql_select_db($this->db_name);
        mysqli_select_db($connection,$this->db_name);
        return true;
    }

    //Берет ряд mysql и возвращает ассоциативный массив, в котором
    //названия колонок являються ключами массива. Если singleRow - true,
    //тогда выводиться только 1 ряд
    public function processRowSet($rowSet, $singleRow = false)
    {
        $resultArray = array();
        while ($row = mysqli_fetch_assoc($rowSet)) {
//        while ($row = mysql_fetch_assoc($rowSet)) {
            array_push($resultArray, $row);
        }

        if ($singleRow == true)
            return $resultArray[0];
        return $resultArray;
    }

    //Выбирает ряды из БД
    //Выводит полный ряд или ряды из $table используя $where
    public function select($table, $where)
    {
        $sql = "select * from $table where $where";
        $result = mysqli_query($sql);
//        $result = mysql_query($sql);

        if (mysqli_num_rows($result == 1))
//        if (mysql_num_rows($result == 1))
            return $this->processRowSet($result, true);
        return $this->processRowSet($result);
    }

    // Вносит изменения в БД
    public function update($data, $table, $where)
    {
        foreach ($data as $column => $value) {
            $sql = "update $table set $column = $value where $where";
            mysqli_query($sql) or die(mysqli_error());
//            mysql_query($sql) or die(mysqli_error());
        }
        return true;
    }

    //Вставляет новый ряд в таблицу
    public function insert($data, $table)
    {

        $columns = "";
        $values = "";

        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
            $values .= $value;
        }

        $sql = "insert into $table($columns) values ($values)";
        mysqli_query($sql) or die(mysqli_error());
//        mysql_query($sql) or die(mysql_error());

        //Выводит ID пользователя в БД
        return mysqli_insert_id();
//        return mysql_insert_id();
    }
}

?>