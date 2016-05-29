<?php
session_start();
require_once("../../config/User.php");
require_once("../../config/Database.php");

$user = new User();
$database = new Database();
$conn = $database->getConnection();

if(!$user->is_logged_in()) {
    $user->redirect('../index.php');
}

if(isset($_POST['update'])) {
    $error_messages = array();
    $required_error_message = array();
    $accolade_id = (isset($_POST['accolades_id'])) ? $_POST['accolades_id'] : 0;
    $accolade_title = (isset($_POST['accolades_title']) && !empty($_POST['accolades_title'])) ? $_POST['accolades_title'] : '';
    $published_date = (isset($_POST['published_date']) && !empty($_POST['published_date'])) ? $_POST['published_date'] : '';
    $old_file = $_POST['old_file'];

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

    if($accolade_title == "") {
        $required_error_message["accolades_title_required"] = "Accolades Title Filed Required!";
    }

    if($published_date == "") {
        $required_error_message["published_date_required"] = "Published Date Filed Required!";
    }


    $temp_file = $_FILES['myFile']['tmp_name'];
    $file_name =  basename($_FILES['myFile']['name']);
    $file_type = $_FILES['myFile']['type'];
    $directory = "../uploads";

    if(empty($required_error_message)) {

        if(empty($_FILES['myFile']['name'])) {

            $sql_update = "UPDATE accolades SET title = :title, image = :image, published_date = :published_date WHERE id = :update_id";
            $stmt = $conn->prepare($sql_update);
            $stmt->bindParam(":title", $accolade_title);
            $stmt->bindParam(":image", $old_file);
            $stmt->bindParam(":published_date", $published_date);
            $stmt->bindParam(":update_id", $accolade_id);
            if($stmt->execute()) {
                $user->redirect('index.php');
            }

        } else {
            if(($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/png") && ($file_type != "image/gif")) {
                $error_messages["extension"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            } else {
                if(file_exists($directory."/".$file_name)) {
                    $error_messages["file_exists"] = "File already exists";
                } else {
                    if(!empty($old_file)) {
                        unlink($directory."/".$old_file);
                    }

                    if(move_uploaded_file($temp_file, $directory."/".$file_name)) {
                        $sql_update = "UPDATE accolades SET title = :title, image = :image, published_date = :published_date WHERE id = :update_id";
                        $stmt = $conn->prepare($sql_update);
                        $stmt->bindParam(":title", $accolade_title);
                        $stmt->bindParam(":image", $file_name);
                        $stmt->bindParam(":published_date", $published_date);
                        $stmt->bindParam(":update_id", $accolade_id);
                        $stmt->execute();

                        if($stmt->rowCount() > 0) {
                            $user->redirect('index.php');
                        } else {
                            foreach($conn->errorInfo() as $err) {
                                echo "<p>{$err}</p>";
                            }
                        }
                    } else {
                        $error = $_FILES['myFile']['error'];
                        $error_messages["upload_error"] = $upload_errors[$error];
                    }
                }
            }
        }

    }

}
?>

<?php if(!empty($required_error_message)):?>
    <div class="alert alert-info">
        <?php foreach($required_error_message as $error):?>
            <p><?= $error?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>
