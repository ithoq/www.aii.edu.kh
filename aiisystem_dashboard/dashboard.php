<?php
session_start();
require_once('../config/User.php');
$user = new User();

$database = new Database();
$conn = $database->getConnection();

if(!$user->is_logged_in()) {
    $user->redirect('index.php');
}

$sql_select = "SELECT * FROM menus";
$stmt = $conn->prepare($sql_select);
$stmt->execute();

?>
<?php include_once('header.php');?>

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
                                                <th style="width:20%">ID</th>
                                                <th style="width:20%">Title</th>
                                                <th style="width:29%">Parent Menu</th>
                                                <th>Menu Link</th>
                                                <th style="width:15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($stmt->rowCount() > 0):?>
                                                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                                                    <tr>
                                                        <td class="v-align-middle">
                                                            <p><?= $row['id'] ?></p>
                                                        </td>

                                                        <td class="v-align-middle">
                                                            <p><?= $row['title'] ?></p>
                                                        </td>

                                                        <td class="v-align-middle">
                                                          <?php
                                                            $sql_select_menu_title = "SELECT * FROM menus WHERE id = :parent_id";
                                                            $stmt2 = $conn->prepare($sql_select_menu_title);
                                                            $stmt2->bindParam(":parent_id", $row['parent']);
                                                            $stmt2->execute();
                                                            $record = $stmt2->fetch(PDO::FETCH_ASSOC);
                                                          ?>
                                                            <?php if($stmt2->rowCount() > 0):?>
                                                              <p><?= $record['title']?> </p>
                                                            <?php else:?>
                                                                <p>None</p>
                                                            <?php endif;?>
                                                        </td>

                                                        <td class="v-align-middle"><?= $row["link"]?></td>

                                                        <td class="v-align-middle">
                                                            <a class="form-control btn btn-success" href="form_edit_menu.php?id=<?= $row['id']?>">Edit</a>
                                                            <a class="form-control btn btn-danger" href="confirm_delete.php?id=<?= $row['id']?>">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile;?>
                                            <?php endif;?>
                                        </tbody>
                                    </table>
                                    <a href="form_create_menu.php" class="btn btn-success">Add New Menu</a>
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


<?php include_once('footer.php');?>
