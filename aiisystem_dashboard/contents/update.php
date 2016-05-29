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

if(isset($_POST['update'])) {
    $required_error_message = array();
    $update_id = (isset($_POST['update_id'])) ? $_POST['update_id'] : 0;
    $page_type = (isset($_POST['page_type'])) ? $_POST['page_type'] : '';
    $content = (isset($_POST['contents'])) ? $_POST['contents'] : '';

    $sql_update = "UPDATE contents SET page_type = :page_type, content = :content WHERE id = :update_id";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(":page_type", $page_type);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":update_id", $update_id);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $user->redirect("index.php");
    }
}