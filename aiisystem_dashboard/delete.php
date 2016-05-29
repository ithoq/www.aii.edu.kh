<?php
session_start();
require_once("../config/User.php");
require_once("../config/Database.php");

$user = new User();
$database = new Database();
$conn = $database->getConnection();

if(!$user->is_logged_in()) {
    $user->redirect('index.php');
}

if(isset($_POST['delete'])) {
    $confirm_id = $_POST['confirm_id'];
    $sql_delete = "DELETE FROM menus WHERE id = :id";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bindParam(":id", $confirm_id);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $user->redirect('dashboard.php');
    }
}