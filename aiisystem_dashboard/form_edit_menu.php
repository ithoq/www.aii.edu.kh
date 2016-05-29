<?php
session_start();
require_once('../config/User.php');
require_once('../config/Database.php');
$user = new User();

$database = new Database();
$conn = $database->getConnection();

if(!$user->is_logged_in()) {
    $user->redirect("index.php");
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM menus WHERE id = :id";
    $stmt1 = $conn->prepare($sql_select);
    $stmt1->bindParam(":id", $id);
    $stmt1->execute();
    $record_found = $stmt1->fetch(PDO::FETCH_ASSOC);
}


?>
<?php include_once('header.php')?>

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
                        <?php if($stmt1->rowCount() > 0):?>
                            <!-- START PANEL -->
                            <div class="panel panel-transparent">
                                <div class="panel-heading">
                                    <div class="panel-title">Form Create Menu</div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <form id="form-personal" role="form" autocomplete="off" method="post" action="update_menu.php">
                                        <input type="hidden" name="update_id" value="<?= $id?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default <?php echo $title_error = (isset($required_error_message['title_required'])) ? $title_error = 'has-error' : ''?>">
                                                    <label>Menu Title</label>
                                                    <input type="text" class="form-control" name="title" placeholder="Menu Title" value="<?php echo $title = (isset($record_found['title'])) ? $title = $record_found['title'] : ''?>">
                                                    <?php if(isset($required_error_message['title_required'])):?>
                                                        <span class="help-block"><?= $required_error_message['title_required']?></span>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Parent Menu</label>
                                                    <select class="form-control" name="parent" id="parent">
                                                        <?php
                                                            $sql_select_parent_menu = "SELECT * FROM menus WHERE id = :parent_id";
                                                            $stmt2 = $conn->prepare($sql_select_parent_menu);
                                                            $stmt2->bindParam(":parent_id", $record_found['parent']);
                                                            $stmt2->execute();
                                                            $record_found1 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <?php if($stmt2->rowCount() > 0):?>
                                                            <option value="<?= $record_found1['id']?>"><?= $record_found1['title']?></option>
                                                            <?php
                                                                $sql_select_all_menus = "SELECT * FROM menus";
                                                                $stmt3 = $conn->prepare($sql_select_all_menus);
                                                                $stmt3->execute();
                                                            ?>
                                                            <?php while($row2 = $stmt3->fetch(PDO::FETCH_ASSOC)):?>
                                                                <?php if(($record_found['id'] == $row2['id'])):?>
                                                                    <?php continue;?>
                                                                <?php endif;?>

                                                                <?php if($record_found1['id'] == $row2['id']):?>
                                                                    <?php continue;?>
                                                                <?php endif;?>

                                                                <option value="<?= $row2['id']?>"><?= $row2['title']?></option>
                                                            <?php endwhile;?>
                                                            <option value="0">None</option>
                                                        <?php else:?>
                                                            <option value="0">None</option>
                                                            <?php
                                                            $sql_select_all_menus = "SELECT * FROM menus";
                                                            $stmt3 = $conn->prepare($sql_select_all_menus);
                                                            $stmt3->execute();
                                                            ?>
                                                            <?php while($row2 = $stmt3->fetch(PDO::FETCH_ASSOC)):?>
                                                                <?php if(($record_found['id'] == $row2['id'])):?>
                                                                    <?php continue;?>
                                                                <?php endif;?>

                                                                <?php if($record_found1['id'] == $row2['id']):?>
                                                                    <?php continue;?>
                                                                <?php endif;?>

                                                                <option value="<?= $row2['id']?>"><?= $row2['title']?></option>
                                                            <?php endwhile;?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default <?php echo $link_error = (isset($required_error_message['link_required'])) ? $link_error = 'has-error' : ''?>">
                                                    <label>Menu Link</label>
                                                    <input type="text" class="form-control" name="link" placeholder="Menu Link" value="<?php echo $link = (isset($record_found['link'])) ? $link = $record_found['link'] : ''?>">
                                                    <?php if(isset($required_error_message['link_required'])):?>
                                                        <span class="help-block"><?= $required_error_message['link_required']?></span>
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

<?php include_once('footer.php')?>