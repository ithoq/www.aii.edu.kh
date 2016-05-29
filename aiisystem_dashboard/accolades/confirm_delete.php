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

if(!isset($_GET['id']) && empty($_GET['id'])) {
    $user->redirect('index.php');
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $delete_id = $_GET['id'];
    $sql_select = "SELECT * FROM accolades WHERE id = :delete_id";
    $stmt = $conn->prepare($sql_select);
    $stmt->bindParam(":delete_id", $delete_id);
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
                                <div class="panel-title">Are you sure, you want to delete this?</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <form id="form-personal" role="form" autocomplete="off" method="post" action="delete.php" enctype="multipart/form-data">
                                    <input type="hidden" name="delete_id" value="<?= $id?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Accolades Title</label>
                                                <input readonly="readonly" type="text" class="form-control" name="accolades_title" placeholder="" value="<?php echo $title_output = (isset($title)) ? $title_output = $title : ''?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <img width="250px" height="250px;" src="../uploads/<?= $image?>" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Published Date</label>
                                                <div id="datepicker-component" class="input-group date">
                                                    <input readonly="readonly" type="text" class="form-control" name="published_date" placeholder="Published Date" value="<?php echo $published_date_value = (isset($published_date)) ? $published_date : ''?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="clearfix"></div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" name="delete" type="submit">Delete</button>
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
</div>

<!-- END PAGE CONTENT -->
<?php include_once("../include_footer.php");?>

