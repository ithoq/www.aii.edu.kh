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
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM contents WHERE id =:id";
    $stmt = $conn->prepare($sql_select);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
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
                                                <p>Confirm Delete Content</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <form id="form-personal" role="form" autocomplete="off" method="post" action="delete.php">
                                        <input type="hidden" name="delete_id" value="<?= $id;?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label>Page Type</label>
                                                    <select class="form-control" name="page_type" id="page_type" disabled="disabled">
                                                        <option value="<?= $page_type ?>"><?= $page_type?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Content</label>
                                                    <textarea disabled="disabled" name="contents" id="summernote"><?php echo $content_value = (isset($content)) ? $content_value = $content : ''?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <button class="btn btn-success" name="delete" type="submit">Delete Content</button>
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


