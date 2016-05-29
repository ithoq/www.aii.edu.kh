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

$sql_select = "SELECT * FROM news";
$stmt = $conn->prepare($sql_select);
$stmt->execute();

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

                <!-- START CONTAINER FLUID -->
                <div class="container-fluid container-fixed-lg bg-white">
                    <!-- START PANEL -->
                    <div class="panel panel-transparent">
                        <div class="panel-heading">
                            <div class="panel-title">Menus</div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="basicTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Short Description</th>
                                        <th>Posted Data</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($stmt->rowCount() > 0):?>
                                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                                            <?php extract($row)?>
                                            <tr>
                                                <td class="v-align-middle">
                                                    <p><?= $id ?></p>
                                                </td>

                                                <td class="v-align-middle">
                                                    <p><?= $title ?></p>
                                                </td>

                                                <td class="v-align-middle">
                                                    <img src="../uploads/<?= $image?>" width="100%" alt="">
                                                </td>

                                                <td class="v-align-middle">
                                                    <p><?= $des ?></p>
                                                </td>

                                                <td class="v-align-middle">
                                                    <p><?= $post_date ?></p>
                                                </td>

                                                <td class="v-align-middle">
                                                    <a class="form-control btn btn-success" href="form_edit.php?id=<?= $id?>">Edit</a>
                                                    <a class="form-control btn btn-danger" href="confirm_delete.php?id=<?= $id?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile;?>
                                    <?php endif;?>
                                    </tbody>
                                </table>
                                <a href="form_create.php" class="btn btn-success">Add New News</a>
                            </div>
                        </div>
                    </div>
                    <!-- END PANEL -->
                </div>
                <!-- END CONTAINER FLUID -->

            </div>
            <!--end row-->

        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->


    <?php include_once('../include_footer.php');?>

