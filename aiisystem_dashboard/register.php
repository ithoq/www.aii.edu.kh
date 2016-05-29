<?php
    session_start();
    require_once("../config/User.php");
    require_once("../config/Database.php");
    $user = new User();

    $database = new Database();
    $conn = $database->getConnection();

    if($user->is_logged_in() !='') {
        $user->redirect('dashboard.php');
    }

    if(isset($_POST['register'])) {
        $required_error_message = array();
        $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : '';
        $first = (isset($_POST['first']) && !empty($_POST['first'])) ? $_POST['first'] : '';
        $last = (isset($_POST['last']) && !empty($_POST['last'])) ? $_POST['last'] : '';
        $phone = (isset($_POST['phone']) && !empty($_POST['phone'])) ? $_POST['phone'] : '';
        $password = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : '';
        $code = md5(uniqid(rand()));
        if($email == "") {
            $required_error_message["email_required"] = "Email field is required!";
        }

        if($first == "") {
            $required_error_message["first_required"] = "First Name field is required!";
        }

        if($last == "") {
            $required_error_message["last_required"] = "Last Name field is required!";
        }

        if($phone == "") {
            $required_error_message["phone_required"] = "Phone Number filed is required!";
        }

        if($password == "") {
            $required_error_message["password_required"] = "Password field is required!";
        }


        if(empty($required_error_message)) {
            $exist_user_error = array();
            $sql_select_email = "SELECT * FROM users WHERE email = :email";
            $stmt1 = $conn->prepare($sql_select_email);
            $stmt1->bindParam(":email", $email);
            $stmt1->execute();

            if($stmt1->rowCount() > 0) {
                $exist_user_error["email_already"] = "This Email Already Used!";
            }

            $sql_select_first_last = "SELECT * FROM users WHERE first = :first AND last = :last";
            $stmt2 = $conn->prepare($sql_select_first_last);
            $stmt2->bindParam(":first", $first);
            $stmt2->bindParam(":last", $last);
            $stmt2->execute();

            if($stmt2->rowCount() > 0) {
                $exist_user_error["first_last_already"] = "First And Last Name Already Used!";
            }

            if(empty($exist_user_error)) {
                $send_email_message = array();
                if($user->register($email, $first, $last, $phone, $password, $code)) {
                    $id = $user->last_id();
                    $message = "
                          Hello {$first} {$last},
                          <br /><br />
                          Welcome to mjq computer training center!<br/>
                          To complete your registration  please , just click following link<br/>
                          <br /><br />
                          <a href='http://localhost:8080/www.aiisystem.edu.kh/aiisystem_dashboard/verify.php?id={$id}&code={$code}'>Click HERE to Activate :)</a>
                          <br /><br />
                          Thanks,";
                    $subject = "Confirm Registration";
                    $user->send_mail($email, $message, $subject);
                    $send_email_message["success"] = "
                        <strong>Success!</strong> We've sent an email to {$email}.
                        Please click on the confirmation link in the email to create your account.
                    ";
                }
            }
        }

    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Pages - Admin Dashboard UI Kit - Lock Screen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
    <link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
        window.onload = function()
        {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
        }
    </script>
</head>
<body class="fixed-header ">
<div class="register-container full-height sm-p-t-30">
    <div class="container-sm-height full-height">
        <div class="row row-sm-height">
            <div class="col-sm-12 col-sm-height col-middle">
                <?php if(isset($send_email_message)):?>
                    <div class="alert alert-info">
                        <p><?= $send_email_message['success'] ?></p>
                    </div>
                <?php else:?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Create New Account</h3>
                        </div>

                        <div class="panel-body">
                            <form id="form-register" class="p-t-15" role="form" action="<?= $_SERVER['PHP_SELF']?>" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default <?php echo $first_name_error = (isset($required_error_message['first_required'])) ? $first_name_error = 'has-error' : ''?>">
                                            <label>First Name</label>
                                            <input type="text" name="first" placeholder="First Name" class="form-control" required>
                                            <?php if(isset($required_error_message['first_required'])):?>
                                                <span class="help-block"><?= $required_error_message['first_required']?></span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default <?php echo $last_name_error = (isset($required_error_message['last_required'])) ? $last_name_error = 'has-error' : ''?>">
                                            <label>Last Names</label>
                                            <input type="text" name="last" placeholder="Last Name" class="form-control" required>
                                            <?php if(isset($required_error_message['last_required'])):?>
                                                <span class="help-block"><?= $required_error_message['last_required']?></span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default <?php echo $phone_error = (isset($required_error_message['phone_required'])) ? $phone_error = 'has-error' : ''?>">
                                            <label>Phone</label>
                                            <input type="text" name="phone" placeholder="Phone Number" class="form-control" required>
                                            <?php if(isset($required_error_message['phone_required'])):?>
                                                <span class="help-block"><?= $required_error_message['phone_required']?></span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default <?php echo $email_error = (isset($required_error_message['email_required'])) ? $email_error = 'has-error' : ''?>">
                                            <label>Email</label>
                                            <input type="email" name="email" placeholder="Email" class="form-control" required>
                                            <?php if(isset($required_error_message['email_required'])):?>
                                                <span class="help-block"><?= $required_error_message['email_required']?></span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default <?php echo $password_error = (isset($required_error_message['password_required'])) ? $password_error = 'has-error' : ''?>">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                                            <?php if(isset($required_error_message['password_required'])):?>
                                                <span class="help-block"><?= $required_error_message['password_required']?></span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-cons m-t-10" type="submit" name="register">Create a new account</button>
                            </form>
                        </div>
                    </div>

                    <?php if(isset($exist_user_error)):?>
                        <div class="alert alert-warning">
                            <?php foreach($exist_user_error as $user_error):?>
                                <p><?= $user_error ?></p>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<!-- START OVERLAY -->
<div class="overlay hide" data-pages="search">
    <!-- BEGIN Overlay Content !-->
    <div class="overlay-content has-results m-t-20">
        <!-- BEGIN Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Logo !-->
            <img class="overlay-brand" src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" width="78" height="22">
            <!-- END Overlay Logo !-->
            <!-- BEGIN Overlay Close !-->
            <a href="#" class="close-icon-light overlay-close text-black fs-16">
                <i class="pg-close"></i>
            </a>
            <!-- END Overlay Close !-->
        </div>
        <!-- END Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Controls !-->
            <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="Search..." autocomplete="off" spellcheck="false">
            <br>
            <div class="inline-block">
                <div class="checkbox right">
                    <input id="checkboxn" type="checkbox" value="1" checked="checked">
                    <label for="checkboxn"><i class="fa fa-search"></i> Search within page</label>
                </div>
            </div>
            <div class="inline-block m-l-10">
                <p class="fs-13">Press enter to search</p>
            </div>
            <!-- END Overlay Controls !-->
        </div>
        <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
        <div class="container-fluid">
          <span>
                <strong>suggestions :</strong>
            </span>
            <span id="overlay-suggestions"></span>
            <br>
            <div class="search-results m-t-40">
                <p class="bold">Pages Search Results</p>
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>
                                    <img width="50" height="50" src="assets/img/profiles/avatar.jpg" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on pages</h5>
                                <p class="hint-text">via john smith</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>T</div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> related topics</h5>
                                <p class="hint-text">via pages</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div><i class="fa fa-headphones large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> music</h5>
                                <p class="hint-text">via pagesmix</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-info text-white inline m-t-10">
                                <div><i class="fa fa-facebook large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on facebook</h5>
                                <p class="hint-text">via facebook</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-complete text-white inline m-t-10">
                                <div><i class="fa fa-twitter large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5">Tweats on<span class="semi-bold result-name"> ice cream</span></h5>
                                <p class="hint-text">via twitter</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular text-white bg-danger inline m-t-10">
                                <div><i class="fa fa-google-plus large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5">Circles on<span class="semi-bold result-name"> ice cream</span></h5>
                                <p class="hint-text">via google plus</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Overlay Search Results !-->
    </div>
    <!-- END Overlay Content !-->
</div>
<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-bez/jquery.bez.min.js"></script>
<script src="assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-select2/select2.min.js"></script>
<script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
<script src="assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END VENDOR JS -->
<script src="pages/js/pages.min.js"></script>
<script>
    $(function()
    {
        $('#form-register').validate()
    })
</script>
</body>
</html>