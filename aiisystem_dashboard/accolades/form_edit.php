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

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $accolades_id = $_GET['id'];
    $sql_select = "SELECT * FROM accolades WHERE id = :accolades_id";
    $stmt = $conn->prepare($sql_select);
    $stmt->bindParam(":accolades_id", $accolades_id);
    $stmt->execute();
    $record_found = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($record_found);
}

?>
<?php include_once("../include_header.php");?>
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
                                    <div class="panel-title">Form Create Menu</div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                        <form id="form-personal" role="form" autocomplete="off" method="post" action="update.php" enctype="multipart/form-data">
                                            <input type="hidden" name="accolades_id" value="<?= $id?>">
                                            <input type="hidden" name="old_file" value="<?= $image?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group <?php echo $title_error = (isset($required_error_message['accolades_title_required'])) ? $title_error = 'has-error' : ''?>">
                                                        <label>Accolades Title</label>
                                                        <input type="text" class="form-control" name="accolades_title" placeholder="" value="<?php echo $title_output = (isset($title)) ? $title_output = $title : ''?>">
                                                        <?php if(isset($required_error_message['accolades_title_required'])):?>
                                                            <span class="help-block"><?= $required_error_message['accolades_title_required']?></span>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <img width="250px" height="250px;" src="../uploads/<?= $image?>" alt="">
                                                        <input type="file" class="form-control" name="myFile">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group <?php echo $published_error = (isset($required_error_message['published_date_required'])) ? $published_error = 'has-error' : ''?>">
                                                        <label>Published Date</label>
                                                        <div id="datepicker-component" class="input-group date">
                                                            <input type="text" class="form-control" name="published_date" placeholder="Published Date" value="<?php echo $published_date_value = (isset($published_date)) ? $published_date : ''?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                                                    <button class="btn btn-success" name="update" type="submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                            <!-- END PANEL -->
                    </div>
                    <!-- END CONTAINER FLUID -->
                </div>
            </div>
            <!--end row-->

        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->
<?php include_once("../include_footer.php");?>
