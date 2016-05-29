<?php
session_start();
require_once("../../config/User.php");
require_once('../../config/Database.php');

$user = new User();
$database = new Database();
$conn = $database->getConnection();

if(!$user->is_logged_in()) {
    $user->redirect('index.php');
}

if(isset($_POST['create'])) {
    $error_messages = array();
    $required_error_messages = array();
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

    //assign the values to the variable
    $accolades_title = (isset($_POST['accolades_title']) && !empty($_POST['accolades_title'])) ? $_POST['accolades_title'] : '';
    $published_date = (isset($_POST['published_date'])) ? $_POST['published_date'] : '';

    $temp_file = $_FILES['myFile']['tmp_name'];
    $image_type = $_FILES['myFile']['type'];
    $target_file = basename($_FILES['myFile']['name']);
    $directory = "../uploads";

    if($accolades_title == "") {
        $required_error_messages["accolades_title_required"] = "Accolades Title Field is required!";
    }

    if($published_date == "") {
        $required_error_messages["published_date_required"] = "Published Date Filed is required!";
    }

    if(empty($_FILES['myFile'])) {
        $required_error_messages["image_required"] = "Accolades Image Field is required!";
    }

    if(empty($required_error_messages)) {

        if(($image_type != "image/jpeg") && ($image_type != "image/png") && ($image_type != "image/jpg") && ($image_type != "image/gif")) {
            $error_messages["extension"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            if(file_exists($directory."/".$target_file)) {
                $error_messages["file_exists"] = "File already exists";
            } else {
                if(move_uploaded_file($temp_file, $directory."/".$target_file)) {
                    $sql_insert = "INSERT INTO accolades(title, image, published_date) VALUES(:title, :image, :published_date)";
                    $stmt = $conn->prepare($sql_insert);
                    $stmt->bindParam(":title", $accolades_title);
                    $stmt->bindParam(":image", $target_file);
                    $stmt->bindParam(":published_date", $published_date);
                    $stmt->execute();
                    if($stmt->rowCount() > 0) {
                        $user->redirect('index.php');
                    }
                } else {
                    $error = $_FILES['myFile']['error'];
                    $error_messages["upload_error"] = $upload_errors[$error];
                }
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
                <div class="col-md-6 col-md-offset-3">
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg bg-white">
                        <!-- START PANEL -->
                        <div class="panel panel-transparent">
                            <div class="panel-heading">
                                <div class="panel-title">Form Create Accolades</div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <form id="form-personal" role="form" autocomplete="off" method="post" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group <?php echo $title_error = (isset($required_error_message['accolades_title_required'])) ? $title_error = 'has-error' : ''?>">
                                                <label>Accolades Title</label>
                                                <input type="text" class="form-control" name="accolades_title">
                                                <?php if(isset($required_error_message['accolades_title_required'])):?>
                                                    <span class="help-block"><?= $required_error_message['accolades_title_required']?></span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Accolades Image</label>
                                                <input class="" type="file" name="myFile" id="accolades_img">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group <?php echo $published_error = (isset($required_error_message['published_date_required'])) ? $published_error = 'has-error' : ''?>">
                                                <label>Published Date</label>
                                                <div id="datepicker-component" class="input-group date">
                                                    <input type="text" class="form-control" name="published_date" placeholder="Published Date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <?php if(isset($required_error_messages['published_date_required'])):?>
                                                    <span class="help-block"><?= $required_error_messages['published_date_required']?></span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" name="create" type="submit">Create a new Accolades</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END PANEL -->
                    </div>

                    <?php if(!empty($error_messages)):?>
                        <div class="alert alert-info">
                            <?php foreach($error_messages as $upload_error):?>
                                <p><?= $upload_error?></p>
                            <?php endforeach?>
                        </div>
                    <?php endif;?>

                    <!-- END CONTAINER FLUID -->
                </div>
            </div>
            <!--end row-->
        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->
    <?php include_once('../include_footer.php');?>
