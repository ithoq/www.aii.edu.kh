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

$sql_select = "SELECT * FROM contents";
$stmt = $conn->prepare($sql_select);
$stmt->execute();
?>

<?php include_once('../include_header.php');?>
<div class="page-content-wrapper">
    <div class="content sm-gutter">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="row">
                <!-- START CONTAINER FLUID -->
                <div class="container-fluid container-fixed-lg bg-white">
                    <!-- START PANEL -->
                    <div class="panel panel-transparent">
                        <div class="panel-heading">
                            <div class="panel-title">Accolades</div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="basicTable">
                                    <thead>
                                    <tr>
                                        <th style="width:20%">ID</th>
                                        <th style="width:20%">Page</th>
                                        <th style="width:29%">Contents</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($stmt->rowCount() > 0):?>
                                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                                            <tr>
                                                <td><span><?= $row['id']?></span></td>
                                                <td><span><?= $row['page_type']?></span></td>
                                                <td><span><?= $row['content']?></span></td>
                                                <td>
                                                    <a href="form_edit.php?id=<?= $row['id'] ?>" class="btn btn-success">Edit</a>
                                                    <a href="confirm_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile;?>
                                    <?php endif;?>
                                    </tbody>
                                </table>
                                <a href="form_create.php" class="btn btn-success">Add New Contents</a>
                            </div>
                        </div>
                    </div>
                    <!-- END PANEL -->
                </div>
                <!-- END CONTAINER FLUID -->
            </div>
        </div>
    </div>
</div>
<?php include_once('../include_footer.php');?>


