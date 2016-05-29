<?php
session_start();
require_once("../config/User.php");
require_once("../config/Database.php");

$user = new User();
$database = new Database();
$conn = $database->getConnection();

if(!$user->is_logged_in()) {
    $user->redirect('index.php');
}

if(isset($_GET['id'])) {
    $confirm_id = $_GET['id'];
    $sql_select = "SELECT * FROM menus WHERE id = :id";
    $stmt = $conn->prepare($sql_select);
    $stmt->bindParam(":id", $confirm_id);
    $stmt->execute();
    $menu_found = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<?php include_once("header.php");?>

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
                        <?php if($stmt->rowCount() > 0):?>
                            <!-- START PANEL -->
                            <div class="panel panel-transparent">
                                <div class="panel-heading">
                                    <div class="panel-title">Are You Sure? You Want to Delete This Menu</div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <form id="form-personal" role="form" autocomplete="off" method="post" action="delete.php">
                                        <input type="hidden" name="confirm_id" value="<?= $confirm_id?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default">
                                                    <label>Menu Title</label>
                                                    <input disabled="disabled" type="text" class="form-control" name="title" placeholder="Menu Title" value="<?php echo $title = (isset($menu_found['title'])) ? $title = $menu_found['title'] : ''?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Parent Menu</label>
                                                    <select disabled="disabled" class="form-control" name="parent" id="parent">
                                                        <?php
                                                            $sql_parent_menu = "SELECT * FROM menus WHERE id = :parent_id";
                                                            $stmt = $conn->prepare($sql_parent_menu);
                                                            $stmt->bindParam(":parent_id", $menu_found['parent']);
                                                            $stmt->execute();
                                                            $parent_found = $stmt->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <?php if($stmt->rowCount() > 0):?>
                                                            <option value="<?= $parent_found['id']?>"><?= $parent_found['title']?></option>
                                                        <?php else:?>
                                                            <option value="0">None</option>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default">
                                                    <label>Menu Link</label>
                                                    <input disabled="disabled" type="text" class="form-control" name="link" placeholder="Menu Link" value="<?php echo $link = (isset($menu_found['link'])) ? $link = $menu_found['link'] : ''?>">
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
                        <?php else:?>
                            <?php $user->redirect('dashboard.php')?>
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

<?php include_once("footer.php");?>
