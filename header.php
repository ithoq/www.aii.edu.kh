<?php
require_once("config/Database.php");
$database = new Database();
$conn = $database->getConnection();

$sql_select = "SELECT * FROM menus";
$stmt = $conn->prepare($sql_select);
$stmt->execute();

$menus = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $menus[$parent][$id] = [$title, $link];
}

//print_r($menus);

function listing_menus($main_menu) {
    global $menus;
    echo "<ul id=\"main-nav\" class=\"menu\">";
        foreach($main_menu as $menu_id => $title) {
            if($title[0] == "Computer Training Course (MJQCTC)") {
                echo "<li class='menu-item menu-item-has-children'><a href='{$title[1]}'>{$title[0]}</a>";
            } else {
                echo "<li class='menu-item menu-item-has-children'><a href='http://www.aii.edu.kh/{$title[1]}'>{$title[0]}</a>";
            }

                if(isset($menus[$menu_id])) {
                    listing_menus($menus[$menu_id]);
                }
            echo "</li>";
        }
    echo "</ul>";
}
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html lang="en" class="isie ie8 oldie no-js"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="isie ie9 no-js"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="American Intercon Institute">
    <meta name="keywords" content="American Intercon Institute">
    <!-- Title -->
    <title>American Intercon Institute</title>
    <!-- Favicon -->
    <!--	<link rel="shortcut icon" href="img/favicon.jpg" type="image/x-icon"/>-->
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,700,800' rel='stylesheet' type='text/css'>
    <!-- Stylesheets -->
    <link rel='stylesheet' id='twitter-bootstrap-css' href='css/bootstrap.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='fontello-css' href='css/fontello.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='prettyphoto-css-css' href='js/prettyphoto/css/prettyPhoto.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='animation-css' href='css/animation.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='flexSlider-css' href='css/flexslider.css' type='text/css' media='all'/>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel='stylesheet' id='perfectscrollbar-css' href='css/perfect-scrollbar-0.4.10.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='jquery-validity-css' href='css/jquery.validity.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='jquery-ui-css' href='css/jquery-ui.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='style-css' href='css/style.css' type='text/css' media='all'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel='stylesheet' id='mobilenav-css' href='css/mobilenav.css' type='text/css' media="screen and (max-width: 838px)"/>
    <link rel="stylesheet" type="text/css" href="css/style.revslider.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="js/rs-plugin/css/settings.css" media="screen"/>
    <!-- jQuery -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- Google Maps -->
    <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false&#038;ver=4.0'></script>
    <!--[if lt IE 9]>
    <script>
        document.createElement("header");
        document.createElement("nav");
        document.createElement("section");
        document.createElement("article");
        document.createElement("aside");
        document.createElement("footer");
        document.createElement("hgroup");
    </script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 7]>
    <script src="js/icomoon.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <link href="css/ie.css" rel="stylesheet">
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/script_ie.js"></script>
    <![endif]-->
    <style>
        div#main-nav ul{

        }
    </style>
</head>
<body class="w1170 headerstyle2 preheader-on">
<!-- Marine Content Wrapper -->
<div id="marine-content-wrapper">
    <header id="header" class="style3">
        <div id="upper-header" style="background: #0097ba;color:white;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="item left hidden-separator">
                            <ul id="menu-shop-header" class="menu" style="font-size: 15px;">
                                <li class="menu-item"><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="http://www.aii.edu.kh/news">News</a></li>
                                <li  class="menu-item"><i class="fa fa-star" aria-hidden="true"></i> <a href="http://www.aii.edu.kh/enrolment">Enrolment</a></li>
                                <li  class="menu-item"><i class="fa fa-calendar" aria-hidden="true"></i> <a href="http://www.aii.edu.kh/calendar">Calendar</a></li>
                                <li  class="menu-item"><i class="fa fa-book" aria-hidden="true"></i> <a href="http://www.aii.edu.kh/learning_resource">Learning Resources</a></li>
                                <li  class="menu-item"><i class="fa fa-users" aria-hidden="true"></i> <a href="http://www.aii.edu.kh/job">Jobs</a></li>
                            </ul>
                        </div>
                        <div class="item right hidden-separator">
                            <ul id="menu-shop-header" class="menu">
<li><a style="color: #ddd;" class="social__item" href="https://www.facebook.com/pages/AiiAmerican-Intercon-Institute/355513951161765?fref=ts"><i class="fa fa-facebook" style="font-size: 13px;"></i></a></li>
                                <li><a style="color: #ddd;" class="social__item" href="https://www.youtube.com/user/MJQGROUP"><i class="fa fa-youtube" style="font-size: 13px;"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Header -->
        <div id="main-header">
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-lg-4 col-md-4 col-sm-4 logo">
                        <a href="index.php" title="Marine" rel="home"><img class="logo" src="img/Logo-Aii-CA-for-web-021.png" alt="Marine"></a>
                        <div id="main-nav-button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /Main Header -->

        <!-- Lower Header -->
        <div id="lower-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        <!-- Main Navigation -->
                        <?php listing_menus($menus[0])?>
                        <!-- /Main Navigation -->
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <!-- Search Box -->
                        <div id="search-box" class="align-right">
                            <i class="icons icon-search"></i>
                            <form role="search" method="get" id="searchform" action="#">
                                <input type="text" name="s" placeholder="Search here..">
                                <div class="iconic-submit">
                                    <div class="icon">
                                        <i class="icons icon-search"></i>
                                    </div>
                                    <input type="submit" value="">
                                </div>
                            </form>
                        </div>
                        <!-- /Search Box -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Lower Header -->
    </header>
    <!-- /Header -->

