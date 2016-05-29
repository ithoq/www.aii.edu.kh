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

if(isset($_POST['update'])) {
    $required_error_message = array();
    $title = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';
    $link = (isset($_POST['link']) && !empty($_POST['link'])) ? $_POST['link'] : '';
    $parent = (int) $_POST['parent'];
    $update_id = (int) $_POST['update_id'];

    if($title == "") {
        $required_error_message["title_required"] = "Title filed is required!";
    }

    if($link == "") {
        $required_error_message["link_required"] = "Menu Link field is required!";
    }

    if(empty($required_error_message)) {
        $sql_update = "UPDATE menus SET title = :title, parent = :parent_id, link = :link WHERE id = :id";
        $stmt4 = $conn->prepare($sql_update);
        $stmt4->bindParam(":title", $title);
        $stmt4->bindParam(":parent_id", $parent);
        $stmt4->bindParam(":link", $link);
        $stmt4->bindParam(":id", $update_id);
        $stmt4->execute();

        if($stmt4->rowCount() > 0) {
            $user->redirect("dashboard.php");
        }
    }
}