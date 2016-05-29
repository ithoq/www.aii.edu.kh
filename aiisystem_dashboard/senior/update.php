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

if(isset($_POST["update"])) {
    if(!isset($_POST["update_id"]) && empty($_POST["update_id"])) {
        $user->redirect("index.php");
    } else {
        $required_errors_message = array();
        $upload_errors_message = array();

        $upload_errors = array(
            UPLOAD_ERR_OK => "No Errors",
            UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize",
            UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE",
            UPLOAD_ERR_PARTIAL => "Partial upload",
            UPLOAD_ERR_NO_FILE => "No File",
            UPLOAD_ERR_NO_TMP_DIR => "No temporary directory",
            UPLOAD_ERR_CANT_WRITE => "Can't write to disk",
            UPLOAD_ERR_EXTENSION => "File upload stopped by extension"
        );

        $update_id = (isset($_POST["update_id"]) && !empty($_POST["update_id"])) ? $_POST["update_id"] : "";
        $senior_name = (isset($_POST["name"]) && !empty($_POST["name"])) ? $_POST["name"] : "";
        $senior_position = (isset($_POST["position"]) && !empty($_POST["position"])) ? $_POST["position"] : "";
        $old_image = (isset($_POST["old_image"]) && !empty($_POST["old_image"])) ? $_POST["old_image"] : "";
        $content = (isset($_POST["contents"]) && !empty($_POST["contents"])) ? $_POST["contents"] : "";

        if($senior_name == "") {
            $required_errors_message["senior_name_required"] = "Senior Name Field Required!";
        }

        if($senior_position == "") {
            $required_errors_message["senior_position_required"] = "Senior Position Field Required!";
        }

        if($old_image == "") {
            $required_errors_message["senior_image_required"] = "Senior Image Field Required!";
        }

        if($content == "") {
            $required_errors_message["content_required"] = "Content Field Required!";
        }

        $temp_folder = $_FILES["myFile"]["tmp_name"];
        $image_type = $_FILES["myFile"]["type"];
        $image_name = $_FILES["myFile"]["name"];
        $upload_folder = "../uploads/";

        if(empty($required_errors_message)) {
            if(empty($_FILES["myFile"]["name"])) {
                $sql_update = "UPDATE senior_admin SET name = :senior_name, senior_position = :senior_position, image = :image, content = :content WHERE id = :update_id";
                $stmt = $conn->prepare($sql_update);
                $stmt->bindParam(":senior_name", $senior_name);
                $stmt->bindParam(":senior_position", $senior_position);
                $stmt->bindParam(":image", $old_image);
                $stmt->bindParam(":content", $content);
                $stmt->bindParam(":update_id", $update_id);
                if($stmt->execute()) {
                    $user->redirect("index.php");
                }
            } else {
                if(($image_type !="image/jpeg") && ($image_type !="image/jpg") && ($image_type !="image/png") && ($image_type !="image/gif")) {
                    $upload_errors_message["extension"] = "Sorry, only jpeg, jpg, png, gif allow!";
                } else {
                    if(file_exists($upload_folder.$image_name)) {
                        unlink($upload_folder.$image_name);
//                        $upload_errors_message["file_exists"] = "Sorry, This is already exists!";
                    } else {
                        if(!empty($old_image)) {
                            unlink($upload_folder.$old_image);
                        }

                        if(move_uploaded_file($temp_folder, $upload_folder.$image_name)) {
                            $sql_update = "UPDATE senior_admin SET name = :senior_name, senior_position = :senior_position, image = :image, content = :content WHERE id = :update_id";
                            $stmt = $conn->prepare($sql_update);
                            $stmt->bindParam(":senior_name", $senior_name);
                            $stmt->bindParam(":senior_position", $senior_position);
                            $stmt->bindParam(":image", $image_name);
                            $stmt->bindParam(":content", $content);
                            $stmt->bindParam(":update_id", $update_id);
                            if($stmt->execute()) {
                                $user->redirect("index.php");
                            } else {
                                print_r($conn->errorInfo());
                            }
                        } else {
                            $error = $_FILES["image"]["error"];
                            $upload_errors_message["upload_error"] = $upload_errors[$error];
                        }
                    }
                }
            }
        }
    }
}
