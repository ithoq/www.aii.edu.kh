<?php
require_once("../config/User.php");
require_once("../config/Database.php");

$user = new User();
$database = new Database();
$conn = $database->getConnection();

if(empty($_GET['id']) && empty($_GET['code'])) {
    $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code'])) {
    $id = $_GET['id'];
    $code = $_GET['code'];
    $status = "Y";
    $messages = array();

    $sql_select = "SELECT * FROM users WHERE id = :id AND tokenCode = :code";
    $stmt = $conn->prepare($sql_select);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":code", $code);
    $stmt->execute();
    $user_record = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() > 0) {
        if($user_record['userStatus'] == 'N') {
            $sql_update = "UPDATE users SET userStatus = :status WHERE id = :id AND tokenCode = :code";
            $stmt1 = $conn->prepare($sql_update);
            $stmt1->bindParam(":status", $status);
            $stmt1->bindParam(":id", $id);
            $stmt1->bindParam(":code", $code);
            $stmt1->execute();

            if($stmt1->rowCount() > 0) {
                $messages["success"] = "Your Account is Now Activated : <a href='index.php'>Login here</a>";
            }
        } else {
            $messages["activated"] = "Your Account is already Activated : <a href='index.php'>Login here</a>";
        }
    } else {
        $messages["error"] = "No Account Found : <a href='register.php'>Register here</a>";
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Activate Account</title>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php if(isset($messages)):?>
                    <div class="alert alert-info">
                        <?php foreach($messages as $message):?>
                            <p><?= $message?></p>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    </body>
</html>
