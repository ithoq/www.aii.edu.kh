<?php
session_start();
require_once("../config/User.php");
require_once('../config/Database.php');

$user = new User();
$database = new Database();
$conn = $database->getConnection();

$sql_select_menus = "SELECT * FROM menus";
$stmt = $conn->prepare($sql_select_menus);
$stmt->execute();

if(!$user->is_logged_in()) {
    $user->redirect('index.php');
}

if(isset($_POST['create'])) {
    $required_error_message = array();
    $exist_error_message = array();
    $title = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';
    $link = (isset($_POST['link']) && !empty($_POST['link'])) ? $_POST['link'] : '';
    $parent = (int) $_POST['parent'];

    if($title == "") {
        $required_error_message["title_required"] = "Title field is required!";
    }

    if($link == "") {
        $required_error_message["link_required"] = "Link Field is required!";
    }

    if(empty($required_error_message)) {
        $sql_select = "SELECT * FROM menus WHERE title = :title";
        $stmt1 = $conn->prepare($sql_select);
        $stmt1->bindParam(":title", $title);
        $stmt1->execute();

        if($stmt1->rowCount() > 0) {
            $exist_error_message["already"] = "This Menu already exist!";
        } else {
            $sql_insert = "INSERT INTO menus(title, parent, link) VALUES(:title, :parent, :link)";
            $stmt2 = $conn->prepare($sql_insert);
            $stmt2->bindParam(":title", $title);
            $stmt2->bindParam(":parent", $parent);
            $stmt2->bindParam(":link", $link);
            $stmt2->execute();

            if($stmt2->rowCount() > 0) {
                $user->redirect('dashboard.php');
            }
        }
    }

}

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
                                <form id="form-personal" role="form" autocomplete="off" method="post" action="<?= $_SERVER['PHP_SELF']?>">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default <?php echo $title_error = (isset($required_error_message['title_required'])) ? $title_error = 'has-error' : ''?>">
                                                <label>Menu Title</label>
                                                <input type="text" class="form-control" name="title" placeholder="Menu Title">
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
                                                    <option value="0">None</option>
                                                    <?php if($stmt->rowCount() > 0):?>
                                                        <?php foreach($stmt->fetchAll() as $row):?>
                                                            <option value="<?= $row['id']?>"><?= $row['title']?></option>
                                                        <?php endforeach?>
                                                    <?php else:?>
                                                        <option value="0">None</option>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default <?php echo $link_error = (isset($required_error_message['link_required'])) ? $link_error = 'has-error' : ''?>">
                                                <label>Menu Link</label>
                                                <input type="text" class="form-control" name="link" placeholder="Menu Link">
                                                <?php if(isset($required_error_message['link_required'])):?>
                                                    <span class="help-block"><?= $required_error_message['link_required']?></span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" name="create" type="submit">Create a new menu</button>
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
    
<?php include_once('footer.php');?>
