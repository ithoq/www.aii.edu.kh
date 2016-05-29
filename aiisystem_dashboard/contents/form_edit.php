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

if(!isset($_GET['id']) && empty($_GET['id'])) {
    $user->redirect("index.php");
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $content_id = $_GET['id'];
    $sql_select = "SELECT * FROM contents WHERE id = :content_id";
    $stmt = $conn->prepare($sql_select);
    $stmt->bindParam(":content_id", $content_id);
    $stmt->execute();

    $list_items = array(
        "aboutus" => "About Us", "whyaii" => "Why Aii", "athletics" => "Athletics", "alumni" => "Alumni"
    );
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
                        <?php if($stmt->rowCount() > 0):?>
                            <?php
                                $record_found = $stmt->fetch(PDO::FETCH_ASSOC);
                                extract($record_found);
                            ?>
                            <!-- START PANEL -->
                            <div class="panel panel-transparent">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Form Edit Content</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <form id="form-personal" role="form" autocomplete="off" method="post" action="update.php">
                                        <input type="hidden" name="update_id" value="<?= $id;?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group <?php echo $page_type_error = (isset($required_error_message['page_required'])) ? $page_type_error = 'has-error' : ''?>">
                                                    <label>Page Type</label>
                                                    <select class="form-control" name="page_type" id="page_type">
                                                        <option value="<?= $page_type ?>"><?= $page_type?></option>
                                                        <?php foreach($list_items as $key => $value):?>
                                                            <?php if($page_type == $key):?>
                                                                <?php continue;?>
                                                            <?php else:?>
                                                                <option value="<?= $key?>"><?= $value?></option>
                                                            <?php endif;?>
                                                        <?php endforeach;?>
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
                                                    <textarea name="contents" id="summernote"><?php echo $content_value = (isset($content)) ? $content_value = $content : ''?></textarea>
                                                    <?php if(isset($required_error_message["content_required"])):?>
                                                        <span class="help-block"><?= $required_error_message["content_required"]?></span>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <button class="btn btn-success" name="update" type="submit">Update Content</button>
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
                        <?php else:?>
                            <div class="alert alert-info">
                                <p>Record Not Found!</p>
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

