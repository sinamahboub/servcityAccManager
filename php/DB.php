<?php
class DB extends PDO
{

    public function __construct($dbname = "servcityaccmanager", $user = "root", $pass = "", $host = "localhost")
    {
        try {
            parent::__construct("mysql:host=$host;dbname=$dbname;", $user, $pass);
            $this->exec("set names utf8");
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //تنظیم نوع پشفرض خروجی به آبجکت
        } catch (PDOException $e) {
            die('Database Error: ' . $e);
        }
    }
}
