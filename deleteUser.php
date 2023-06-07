<?php
require_once "./checkLogin.php";
require_once "./php/autoload.php";

$DB = new DB();

$id = $_GET['id'];

if (!is_numeric($id))
    exit("error id is not valid");

$stmt = $DB->prepare("DELETE FROM `users` WHERE id=:id");
$stmt->bindValue(":id", $id);
$result = $stmt->execute();
if (!$result) {
    echo "no delete";
} else {
    echo "delete";
}

header("location:index.php");
exit;
