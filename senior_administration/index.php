<?php include_once("../include_header.php");?>

<?php if(isset($_GET["id"]) && !empty($_GET["id"])):?>
    <?php
        $senior_id = $_GET["id"];
        $sql_select_one_senior = "SELECT * FROM senior_admin WHERE id = :senior_id";
        $stmt3 = $conn->prepare($sql_select_one_senior);
        $stmt3->bindParam(":senior_id", $senior_id);
        $stmt3->execute();
        $record_found = $stmt3->fetch(PDO::FETCH_ASSOC);
        extract($record_found);
    ?>
    <div class="smallest-padding">
        <div class="container">
            <?php if($stmt3->rowCount() > 0):?>
                <div class="row">
                    <div class="col-md-4">
                        <?php include_once("senior_sidebar.php")?>
                    </div>
                    <div class="col-md-8">
                        <?= $content;?>
                    </div>
                </div>
            <?php else:?>
                <div class="alert alert-info">
                    <p>Result Not Found!</p>
                </div>
            <?php endif;?>
        </div>
    </div>
<?php else:?>
    <?php
        $sql_select = "SELECT * FROM senior_admin";
        $stmt2 = $conn->prepare($sql_select);
        $stmt2->execute();
    ?>
    <div class="smallest-padding">
        <div class="container">
            <?php if($stmt2->rowCount() > 0):?>
			<?php $count = 0;?>
                <div class="row">
                    <?php while($row_found = $stmt2->fetch(PDO::FETCH_ASSOC)):?>
					 <?php $count++;?>
                        <div class="col-md-3">
                            <div class="post-thumbnail">
                                <img src="http://www.aii.edu.kh/aiisystem_dashboard/uploads/<?= $row_found["image"]?>" width="100%" style="height: 358px;" alt="">
                                <h4 style="margin-top: 10px; text-align: center"><a href="index.php?id=<?= $row_found["id"]?>"><?= $row_found["name"]?></a></h4>
                                <hr>
                                <p style="text-align: center"><?= $row_found["senior_position"]?></p>
                                <div class="post-hover">
                                    <a class="link-icon" href="index.php?id=<?= $row_found["id"]?>"></a><a class="search-icon prettyPhoto" href="http://www.aii.edu.kh/aiisystem_dashboard/uploads/<?= $row_found["image"]?>"></a>
                                </div>
                            </div>
                        </div>
						 <?php if($count == 4 || $count == 8 || $count == 12):?>
                            <p style="color: white;">Text</p>
                        <?php endif;?>
                    <?php endwhile;?>
                </div>
            <?php else:?>
                <div class="alert alert-info">
                    <p>Result Not Found!</p>
                </div>
            <?php endif;?>
        </div>
    </div>
<?php endif;?>
<?php include_once("../include_footer.php");?>
