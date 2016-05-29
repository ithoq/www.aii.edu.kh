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

if(isset($_POST["create"])) {
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

    $senior_name = (isset($_POST["name"]) && !empty($_POST["name"])) ? $_POST["name"] : "";
    $position = (isset($_POST["position"]) && !empty($_POST["position"])) ? $_POST["position"] : "";
    $image_name = (isset($_FILES["image"]["name"])) ? $_FILES["image"]["name"] : "";
    $content = (isset($_POST["contents"]) && !empty($_POST["contents"])) ? $_POST["contents"] : "";

    if($senior_name == "") {
        $required_errors_message["name_required"] = "Senior Administration Name Field Required!";
    }

    if($position == "") {
        $required_errors_message["position_required"] = "Position Field Required!";
    }

    if($image_name == "") {
        $required_errors_message["image_required"] = "Senior Administration Image Field Required!";
    }

    if($content == "") {
        $required_errors_message["content_required"] = "Content Field Required!";
    }

    $image_type = $_FILES["image"]["type"];
    $temp_folder = $_FILES["image"]["tmp_name"];
    $folder_upload = "../uploads/";

    if(empty($required_errors_message)) {
        if(($image_type !="image/jpeg") && ($image_type !="image/jpg") && ($image_type != "image/png") && ($image_type !="gif")) {
            $upload_errors["extension"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed!";
        } else {
            if(move_uploaded_file($temp_folder, $folder_upload.$image_name)) {
                    $sql_insert = "INSERT INTO senior_admin(name, senior_position , image, content) VALUES(:senior_name, :senior_position, :image, :content)";
                    $stmt = $conn->prepare($sql_insert);
                    $stmt->bindParam(":senior_name", $senior_name);
                    $stmt->bindParam(":senior_position", $position);
                    $stmt->bindParam(":image", $image_name);
                    $stmt->bindParam(":content", $content);
                    $stmt->execute();

                    if($stmt->rowCount() > 0) {
                        $user->redirect("index.php");
                    }

                } else {
                    $error = $_FILES["image"]["error"];
                    $upload_errors_message["upload_error"] = $upload_errors[$error];
                }
        }
    }

}

?>
<?php include_once('../include_header.php');?>
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper ">
    <!-- START PAGE CONTENT -->
    <div class="content sm-gutter">
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid padding-25 sm-padding-10">
            <!-- start row-->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="<?= $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <div class="form-group <?php echo $name_error = (isset($required_errors_message['name_required'])) ? $name_error = 'has-error' : ''?>">
                            <label for="name">Senior Administration Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="">
                            <?php if(isset($required_errors_message["name_required"])):?>
                                <span class="help-block"><?= $required_errors_message["name_required"]?></span>
                            <?php endif;?>
                        </div>

                        <div class="form-group <?php echo $position_error = (isset($required_errors_message['position_required'])) ? $position_error = 'has-error' : ''?>">
                            <label for="position">Position</label>
                            <input type="text" name="position" id="position" class="form-control" placeholder="">
                            <?php if(isset($required_errors_message["position_required"])):?>
                                <span class="help-block"><?= $required_errors_message["position_required"]?></span>
                            <?php endif;?>
                        </div>

                        <div class="form-group <?php echo $image_error = (isset($required_errors_message['image_required'])) ? $image_error = 'has-error' : ''?>">
                            <label for="image">Administration Image</label>
                            <input type="file" name="image" id="image">
                            <?php if(isset($required_errors_message["image_required"])):?>
                                <span class="help-block"><?= $required_errors_message["image_required"]?></span>
                            <?php endif;?>
                        </div>

                        <div class="form-group <?php echo $content_error = (isset($required_errors_message['content_required'])) ? $content_error = 'has-error' : ''?>">
                            <textarea id="edit" name="contents"></textarea>
                            <?php if(isset($required_errors_message["content_required"])):?>
                                <span class="help-block"><?= $required_errors_message["content_required"]?></span>
                            <?php endif;?>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="create" class="btn btn-success" value="Create New Senior_Admin">
                        </div>
                    </form>

                    <?php if(!empty($upload_errors_message)):?>
                        <div class="alert alert-info">
                            <?php foreach($upload_errors_message as $error):?>
                                <p><?= $error ?></p>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <!--end row-->

        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->


    <?php include_once('../include_footer.php');?>

