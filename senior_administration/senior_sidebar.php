<?php
    $sql_select_senior_name = "SELECT * FROM senior_admin";
    $stmt4 = $conn->prepare($sql_select_senior_name);
    $stmt4->execute();
?>

<?php if($stmt4->rowCount() > 0):?>
    <ul class="list-group">
        <?php while($record = $stmt4->fetch(PDO::FETCH_ASSOC)):?>
            <li class="list-group-item"><a href="index.php?id=<?=$record["id"]?>"><?= $record["name"]?></a></li>
        <?php endwhile;?>
    </ul>
<?php endif;?>
