<?php session_start();
require_once "./php/autoload.php";

$Encryption = new Encryption();
$DB = new DB();

$username = $_POST['username'];
$password = $_POST['password'];



$stmt = $DB->prepare("SELECT * FROM `users` WHERE username=:username");
$stmt->bindValue(":username", $username);
$stmt->execute();
$user = $stmt->fetch();

// var_dump($user);

if (isset($user->id)) {
    if ($Encryption->decode($user->password) == $password) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['access'] = $user->access;
        header("location:index.php");
        exit;
    } else {
        header("location:login.php");
        exit;
    }
} else {
    header("location:login.php");
    exit;
}
