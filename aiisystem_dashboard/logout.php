<?php
session_start();
require_once("../config/User.php");
$user = new User();

if(!$user->is_logged_in()) {
    $user->redirect('index.php');
}

if($user->is_logged_in() != "") {
    $user->log_out();
    $user->redirect('index.php');
}