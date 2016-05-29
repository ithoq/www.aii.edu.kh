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

if(!isset($_GET["id"]) && empty($_GET["id"])) {
    $user->redirect("index.php");
}

if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $select_id = $_GET["id"];
    $sql_select = "SELECT * FROM senior_admin WHERE id = :select_id";
    $stmt = $conn->prepare($sql_select);
    $stmt->bindParam(":select_id", $select_id);
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
                <div class="col-md-10 col-md-offset-1">
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg bg-white">
                        <?php if($stmt->rowCount() > 0):?>
                            <?php
                            $record_found = $stmt->fetch(PDO::FETCH_ASSOC);
                            extract($record_found);
                            ?>
                            <!--                             START PANEL-->
                            <div class="panel panel-transparent">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Confirm Delete Senior Administration</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <form id="form-personal" role="form" autocomplete="off" method="post" action="delete.php" enctype="multipart/form-data">
                                        <input type="hidden" name="delete_id" value="<?= $id?>">

                                        <div class="form-group">
                                            <label for="name">Senior Administration Name</label>
                                            <input disabled="disabled" type="text" name="name" id="name" class="form-control" placeholder="" value="<?= $senior_name = (isset($name)) ? $senior_name = $name : ''?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="position">Position</label>
                                            <input disabled="disabled" type="text" name="position" id="position" class="form-control" placeholder="" value="<?= $position = (isset($senior_position)) ? $position = $senior_position : ''?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Administration Image</label>
                                            <div class="form-group">
                                                <img src="../uploads/<?= $image?>" width="200px" height="200px;" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <textarea readonly="readonly" id="edit" name="contents"><?= $senior_content = (isset($content)) ?$senior_content = $content : ''?></textarea>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <button class="btn btn-success" name="delete" type="submit">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--                             END PANEL-->
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

