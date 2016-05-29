<?php include_once('../include_header.php');?>
<?php
require_once("../config/Database.php");
$database = new Database();
$conn = $database->getConnection();
$page_type = "aboutus";
$sql_select = "SELECT * FROM contents WHERE page_type = :page_type";
$stmt = $conn->prepare($sql_select);
$stmt->bindParam(":page_type", $page_type);
$stmt->execute();
?>
    <div class="smallest-padding">
        <div class="container">
			<div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <h3 class="upcoming_events">About American Intercon Institute</h3>
                </div>
            </div>
			
            <div class="row">
                <div class="col-md-9" style="text-align: justify">
                    <?php if($stmt->rowCount() > 0):?>
                        <?php $record_found = $stmt->fetch(PDO::FETCH_ASSOC)?>
                        <?= $record_found["content"]?>
                    <?php endif;?>
                </div>

				<?php include_once("../include_upcoming_events.php");?>
            </div>
        </div>
    </div>
<?php include_once('../include_footer.php');?>
