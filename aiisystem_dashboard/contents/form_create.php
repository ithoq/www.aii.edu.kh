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

if(isset($_POST['create'])) {
    $required_error_message = array();
    $error_message = array();

    $page_type = (isset($_POST['page_type']) && !empty($_POST['page_type'])) ? $_POST['page_type'] : '';
    $content = (isset($_POST['contents']) && !empty($_POST['contents'])) ? $_POST['contents'] : '';

    if($page_type == "") {
        $required_error_message["page_required"] = "Page Type Field Required!";
    }

    if($content == "") {
        $required_error_message["content_required"] = "Contents Field Required!";
    }

    if(empty($required_error_message)) {
        $sql_select = "SELECT * FROM contents WHERE page_type = :page_type";
        $stmt = $conn->prepare($sql_select);
        $stmt->bindParam(":page_type", $page_type);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $error_message["exist"] = "The contents for {$page_type} is already exist!";
        } else {
            $sql_insert = "INSERT INTO contents (page_type, content) VALUES(:page_type, :content)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(":page_type", $page_type);
            $stmt->bindParam(":content", $content);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $user->redirect("index.php");
            } else {
                $error_message["error_insert"] = "Look like something went wrong!!!";
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
                <div class="col-md-8 col-md-offset-2">
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg bg-white">
                        <!-- START PANEL -->
                        <div class="panel panel-transparent">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Form Create Content</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <form id="form-personal" role="form" autocomplete="off" method="post" action="<?= $_SERVER['PHP_SELF']?>">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group <?php echo $page_type_error = (isset($required_error_message['page_required'])) ? $page_type_error = 'has-error' : ''?>">
                                                <label>Page Type</label>
                                                <select class="form-control" name="page_type" id="page_type">
                                                    <option value="0">None</option>
                                                    <option value="aboutus">About Us</option>
                                                    <option value="whyaii">Why Aii</option>
                                                    <option value="athletics">Athletics</option>
                                                    <option value="alumni">Alumni</option>
                                                </select>
                                                <?php if(isset($required_error_message['page_required'])):?>
                                                    <span class="help-block"><?= $required_error_message['page_required']?></span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo $content_error = (isset($required_error_message["content_required"])) ? $content_error = 'has-error' : ''?>">
                                                <label>Content</label>
                                                <textarea name="contents" id="summernote"></textarea>
                                                <?php if(isset($required_error_message["content_required"])):?>
                                                    <span class="help-block"><?= $required_error_message["content_required"]?></span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <button class="btn btn-success" name="create" type="submit">Create New Content</button>
                                </form>
                            </div>
                        </div>
                        <!-- END PANEL -->
                        <?php if(!empty($error_message)):?>
                            <div class="alert alert-info">
                                <?php foreach($error_message as $error):?>
                                    <p><?= $error?></p>
                                <?php endforeach;?>
                            </div>
                        <?php endif;?>
                    </div>
                    <!-- END CONTAINER FLUID -->
                </div>
            </div>
            <!--end row-->
        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->

    <?php include_once('../include_footer.php');?>

