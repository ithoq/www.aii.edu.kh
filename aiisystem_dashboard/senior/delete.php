<?php
session_start();
require_once("../../config/User.php");
require_once("../../config/Database.php");

$user = new User();
$database = new Database();
$conn = $database->getConnection();

if(!$user->is_logged_in()) {
    $user->redirect("../index.php");
}

if(isset($_POST["delete"])) {
    $delete_id = $_POST["delete_id"];
    $sql_delete = "DELETE FROM senior_admin WHERE id = :delete_id";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bindParam(":delete_id", $delete_id);
    if($stmt->execute()) {
        $user->redirect("index.php");
    }
}