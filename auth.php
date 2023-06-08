<?php session_start();
require_once "./php/autoload.php";

$Encryption = new Encryption();
$DB = new DB();
$Msg = new Msg();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = @$_POST['username'];
    $password = @$_POST['password'];
} else {
    header("location:login.php");
    exit;
}

$valid = true;

if ($username == "") {
    $Msg->error("enter username !");
    $valid = false;
}

if ($password == "") {
    $Msg->error("enter password !");
    $valid = false;
}

if ($valid == false) {
    header("location:login.php");
    exit;
}

$stmt = $DB->prepare("SELECT * FROM `users` WHERE username=:username");
$stmt->bindValue(":username", $username);
$stmt->execute();
$user = $stmt->fetch();

// var_dump($user);

if (isset($user->id)) {
    if ($Encryption->decode($user->password) == $password) {
        $_SESSION['user_id'] = $user->id;
        // $_SESSION['user_name'] = $user->name;
        $Msg->success("welcom !");
        header("location:index.php");
        exit;
    } else {
        $Msg->error("enter correct password !");
        header("location:login.php");
        exit;
    }
} else {
    $Msg->error("enter correct username !");
    header("location:login.php");
    exit;
}
