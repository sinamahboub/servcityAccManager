<?php
require_once "./checkLogin.php";
require_once "./php/autoload.php";

$Msg = new Msg();
$DB = new DB();
$Encryption = new Encryption();

$valid = true;

$username = $_POST['username'];
$name = $_POST['name'];
$password = $_POST['password'];
$date = $_POST['date'];
$accType = strip_tags($_POST['accType']);
$telegramId = $_POST['telegramId'];
$payStatus = strip_tags($_POST['payStatus']);
$accStatus = strip_tags($_POST['accStatus']);
$about = $_POST['about'];

$password = $Encryption->encode($password);

$stmt = $DB->prepare("INSERT INTO `users`(`username`, `name`, `password`, `date`, `accType`, `telegramId`, `payStatus`, `accStatus`, `about`)
VALUES 
    (:username, :name, :password, :date, :accType, :telegramId, :payStatus, :accStatus, :about)");
$stmt->bindValue(":username", $username);
$stmt->bindValue(":name", $name);
$stmt->bindValue(":password", $password);
$stmt->bindValue(":date", $date);
$stmt->bindValue(":accType", $accType);
$stmt->bindValue(":telegramId", $telegramId);
$stmt->bindValue(":payStatus", $payStatus);
$stmt->bindValue(":accStatus", $accStatus);
$stmt->bindValue(":about", $about);

$result = $stmt->execute();
if (!$result) {
    $Msg->error("error in insert !");
} else {
    $Msg->success("success in insert !");
}

header("location:index.php");
exit;
