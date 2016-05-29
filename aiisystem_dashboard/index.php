<?php
session_start();
require_once("../config/User.php");

$user_home = new User();

//if user already login then redirect the user to dashboard
if($user_home->is_logged_in() != '') {
    $user_home->redirect('dashboard.php');
}

$info_message = array();
if(isset($_GET['inactive'])) {
    $info_message["inactive"]= "Your account is not activated yet, please check your email to confirm activate of your user account!";
}

if(isset($_GET['error'])) {
    $info_message["not_found"] = "User Account not found!";
}

if(isset($_POST['login'])) {
    $required_error_message = array();
    $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : '';
    $password = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : '';

    if($email == "") {
        $required_error_message['email_required'] = "Email field is required!";
    }

    if($password == "") {
        $required_error_message['password_required'] = "Password field is required!";
    }

    if(empty($required_error_message)) {
        $user_home->login($email, $password);
    }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Aii system</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <?php if(!empty($info_message)):?>
                    <div class="alert alert-info">
                        <?php foreach($info_message as $info):?>
                            <p><?= $info ?></p>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span>Login Form</span>
                        </div>
                        <div class="panel-body">
                            <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
                                <div class="form-group <?php echo $email_error = (isset($required_error_message['email_required'])) ? $email_error = 'has-error' : ''?>">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email">
                                    <?php if(isset($required_error_message['email_required'])):?>
                                        <span class="help-block"><?= $required_error_message['email_required']?></span>
                                    <?php endif;?>
                                </div>

                                <div class="form-group <?php echo $password_error = (isset($required_error_message['password_required'])) ? $password_error = 'has-error' : ''?>">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                                    <?php if(isset($required_error_message['password_required'])):?>
                                        <span class="help-block"><?= $required_error_message['password_required']?></span>
                                    <?php endif;?>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="login" value="Login" class="form-control btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
    </body>
</html>
