<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
//use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LexapurpleAsset;
use yii\helpers\Url;
use yii\bootstrap5\Modal;
use yii\widgets\ActiveForm;
use kartik\growl\Growl;
use yii\bootstrap5\Html;



LexapurpleAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/lexa-ajax/layouts/purpel/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 May 2023 13:37:37 GMT -->


<head>

    <style>
        #cmstable1 tr td {
            white-space: nowrap;
            line-height: 15px;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;

        }


        #cmstable2 tr td {
            white-space: nowrap;
            line-height: 15px;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        #cmstable3 tr td {
            white-space: nowrap;
            line-height: 15px;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        #cmstable4 tr td {
            white-space: nowrap;
            line-height: 15px;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        /*----------------------------------------------------------------------------------*/

        table.dataTable tr:hover td {
            background-color: lightgray !important;
        }

        .row_selected1 {
            background-color: #99c9ff !important;
            color: white;
            font-weight: bold;
            z-index: 9999
        }

        .row_selected2 {
            background-color: #99c9ff !important;
            color: white;
            font-weight: bold;
            z-index: 9999
        }

        .row_selected3 {
            background-color: #99c9ff !important;
            color: white;
            font-weight: bold;
            z-index: 9999
        }

        .row_selected4 {
            background-color: #99c9ff !important;
            color: white;
            font-weight: bold;
            z-index: 9999
        }




        /* Change bootstrap validation message color to red */
        .has-error .help-block {
            color: red;
        }
    </style>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags(); ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head(); ?>
</head>



<!-- <head>

    <meta charset="utf-8" />
    <title>Dashboard | Lexa - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" /> -->
<!-- App favicon -->
<!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

<!-- Bootstrap Css -->
<!-- <link href="lexa-ajax/layouts/purpelassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" -->
<!-- type="text/css" /> -->
<!-- Icons Css -->
<!-- <link href="lexa-ajax/layouts/purpelassets/css/icons.min.css" rel="stylesheet" type="text/css" /> -->
<!-- App Css-->
<!-- <link href="lexa-ajax/layouts/purpelassets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" /> -->

<!-- </head> -->





<body data-sidebar="dark">
    <?php $this->beginBody(); ?>


    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/logo-dark.png" alt="" height="17">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/logo-light.png" alt="" height="18">
                            </span>
                        </a>
                    </div>

                    <button type="button"
                        class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <div class="d-none d-sm-block">
                        <div class="dropdown dropdown-topbar pt-3 mt-1 d-inline-block">
                            <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Create <i class="mdi mdi-chevron-down"></i>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex">

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="fa fa-search"></span>
                        </div>
                    </form>

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="dropdown d-none d-md-block ms-2">
                        <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="me-2" src="/lexa-ajax/layouts/purpel/assets/images/flags/us_flag.jpg"
                                alt="Header Language" height="16">
                            English <span class="mdi mdi-chevron-down"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/flags/germany_flag.jpg"
                                    alt="user-image" class="me-1" height="12"> <span class="align-middle"> German
                                </span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/flags/italy_flag.jpg" alt="user-image"
                                    class="me-1" height="12">
                                <span class="align-middle"> Italian </span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/flags/french_flag.jpg"
                                    alt="user-image" class="me-1" height="12"> <span class="align-middle"> French
                                </span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/flags/spain_flag.jpg" alt="user-image"
                                    class="me-1" height="12">
                                <span class="align-middle"> Spanish </span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="/lexa-ajax/layouts/purpel/assets/images/flags/russia_flag.jpg"
                                    alt="user-image" class="me-1" height="12"> <span class="align-middle"> Russian
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen font-size-24"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti-bell"></i>
                            <span class="badge bg-danger rounded-pill">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="m-0"> Notifications (258) </h5>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="javascript:void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title border-success rounded-circle ">
                                                    <i class="mdi mdi-cart-outline"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Your order is placed</h6>
                                            <div class="text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="javascript:void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title border-warning rounded-circle ">
                                                    <i class="mdi mdi-message"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">New Message received</h6>
                                            <div class="text-muted">
                                                <p class="mb-1">You have 87 unread messages</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="javascript:void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title border-info rounded-circle ">
                                                    <i class="mdi mdi-glass-cocktail"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Your item is shipped</h6>
                                            <div class="text-muted">
                                                <p class="mb-1">It is a long established fact that a reader will</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="javascript:void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title border-primary rounded-circle ">
                                                    <i class="mdi mdi-cart-outline"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Your order is placed</h6>
                                            <div class="text-muted">
                                                <p class="mb-1">Dummy text of the printing and typesetting industry.</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="javascript:void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title border-warning rounded-circle ">
                                                    <i class="mdi mdi-message"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">New Message received</h6>
                                            <div class="text-muted">
                                                <p class="mb-1">You have 87 unread messages</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 border-top">
                                <a class="btn btn-sm btn-link font-size-14 w-100 text-center" href="javascript:void(0)">
                                    View all
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="/lexa-ajax/layouts/purpel/assets/images/users/user-4.jpg" alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i>
                                Profile</a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-wallet font-size-17 text-muted align-middle me-1"></i> My Wallet</a>
                            <a class="dropdown-item d-flex align-items-center" href="#"><i
                                    class="mdi mdi-cog font-size-17 text-muted align-middle me-1"></i> Settings<span
                                    class="badge bg-success ms-auto">11</span></a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-lock-open-outline font-size-17 text-muted align-middle me-1"></i>
                                Lock screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"><i
                                    class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i>
                                Logout</a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-spin mdi-cog"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Main</li>

                        <li>
                            <a href="index.html" class="waves-effect">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span class="badge rounded-pill bg-primary float-end">2</span>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="calendar.html" class=" waves-effect">
                                <i class="mdi mdi-calendar-check"></i>
                                <span>Calendar</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-email-outline"></i>
                                <span>Email</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href='<?php echo Yii::$app->request->baseUrl . '/program/index' ?>'>xProgram</a>
                                </li>
                                <li><a href='<?php echo Yii::$app->request->baseUrl . '/department/index' ?>'>Department</a>
                                </li>

                                <li><a href='<?php echo Yii::$app->request->baseUrl . '/department/test' ?>'>test</a>
                                </li>

                                <li><a href="/lexa-ajax/layouts/purpel/email-inbox.html">Inbox</a></li>
                                <li><a href="/lexa-ajax/layouts/purpel/email-read.html">Email Read</a></li>
                                <li><a href="/lexa-ajax/layouts/purpel/email-compose.html">Email Compose</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Components</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-buffer"></i>
                                <span>UI Elements</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="lexa-ajax/layouts/purpel/ui-alerts.html">Alerts</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-buttons.html">Buttons</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-badge.html">Badge</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-cards.html">Cards</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-carousel.html">Carousel</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-dropdowns.html">Dropdowns</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-grid.html">Grid</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-images.html">Images</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-lightbox.html">Lightbox</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-modals.html">Modals</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-offcanvas.html">Offcanvas</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-pagination.html">Pagination</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-popover-tooltips.html">Popover &amp;
                                        Tooltips</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-rangeslider.html">Range Slider</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-session-timeout.html">Session Timeout</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-progressbars.html">Progress Bars</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-sweet-alert.html">Sweet-Alert</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-tabs-accordions.html">Tabs &amp; Accordions</a>
                                </li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-typography.html">Typography</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/ui-video.html">Video</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="mdi mdi-clipboard-outline"></i>
                                <span class="badge rounded-pill bg-success float-end">6</span>
                                <span>Forms</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/lexa-ajax/layouts/purpel/form-elements.html">Form Elements</a></li>
                                <li><a href="/lexa-ajax/layouts/purpel/form-validation.html">Form Validation</a></li>
                                <li><a href="/lexa-ajax/layouts/purpel/form-advanced.html">Form Advanced</a></li>
                                <li><a href="/lexa-ajax/layouts/purpel/form-editors.html">Form Editors</a></li>
                                <li><a href="/lexa-ajax/layouts/purpel/form-uploads.html">Form File Upload</a></li>
                                <li><a href="/lexa-ajax/layouts/purpel/form-xeditable.html">Form Xeditable</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-chart-line"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="lexa-ajax/layouts/purpel/charts-morris.html">Morris Chart</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/charts-chartist.html">Chartist Chart</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/charts-chartjs.html">Chartjs Chart</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/charts-flot.html">Flot Chart</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/charts-c3.html">C3 Chart</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/charts-other.html">Jquery Knob Chart</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-format-list-bulleted-type"></i>
                                <span>Tables</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="lexa-ajax/layouts/purpel/tables-basic.html">Basic Tables</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/tables-datatable.html">Data Table</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/tables-responsive.html">Responsive Table</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/tables-editable.html">Editable Table</a></li>
                            </ul>
                        </li>



                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-album"></i>
                                <span>Icons</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="lexa-ajax/layouts/purpel/icons-material.html">Material Design</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/icons-ion.html">Ion Icons</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/icons-fontawesome.html">Font Awesome</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/icons-themify.html">Themify Icons</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/icons-dripicons.html">Dripicons</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/icons-typicons.html">Typicons Icons</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <span class="badge rounded-pill bg-danger float-end">2</span>
                                <i class="mdi mdi-google-maps"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="lexa-ajax/layouts/purpel/maps-google.html"> Google Map</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/maps-vector.html"> Vector Map</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Extras</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-responsive"></i>
                                <span> Layouts </span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-light-sidebar.html">Light
                                                Sidebar</a></li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-compact-sidebar.html">Compact
                                                Sidebar</a></li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-icon-sidebar.html">Icon
                                                Sidebar</a></li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-boxed.html">Boxed Layout</a></li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-preloader.html">Preloader</a></li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-colored-sidebar.html">Colored
                                                Sidebar</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-horizontal.html">Horizontal</a>
                                        </li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-hori-topbar-dark.html">Topbar
                                                Dark</a></li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-hori-preloader.html">Preloader</a>
                                        </li>
                                        <li><a href="lexa-ajax/layouts/purpel/layouts-hori-boxed-width.html">Boxed
                                                Layout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-account-box"></i>
                                <span> Authentication </span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="lexa-ajax/layouts/purpel/pages-login.html">Login</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-register.html">Register</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-recoverpw.html">Recover Password</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-lock-screen.html">Lock Screen</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-text-box-multiple-outline"></i>
                                <span> Extra Pages </span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="lexa-ajax/layouts/purpel/pages-timeline.html">Timeline</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-invoice.html">Invoice</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-directory.html">Directory</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-blank.html">Blank Page</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-404.html">Error 404</a></li>
                                <li><a href="lexa-ajax/layouts/purpel/pages-500.html">Error 500</a></li>
                            </ul>
                        </li>



                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-share-variant"></i>
                                <span>Multi Level</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 1.1</a></li>
                                <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="javascript: void(0);">Level 2.1</a></li>
                                        <li><a href="javascript: void(0);">Level 2.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <?= Alert::widget() ?>
                    <?= $content ?>
                                            
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>


<?php

/*=================================================================================== */

Modal::begin([

    'headerOptions' => ['id' => 'modalHeader-xs', 'style' => 'color:red;'],
    'id' => 'modal-xs',
    'size' => 'modal-xs',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent-xs'></div>";
Modal::end();

/*=================================================================================== */

Modal::begin([

    'headerOptions' => ['id' => 'modalHeader-md', 'style' => 'color:red;'],
    'id' => 'modal-md',
    'size' => 'modal-md',

    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent-md'></div>";
Modal::end();

/*=================================================================================== */

Modal::begin([

    'headerOptions' => ['id' => 'modalHeader-xl', 'style' => 'color:red;'],
    'id' => 'modal-xl',
    'size' => 'modal-xl',

    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent-xl'></div>";
Modal::end();

/*=================================================================================== */
Modal::begin([

    'headerOptions' => ['id' => 'modalHeader-lg'],
    'id' => 'modal-lg',
    'size' => 'modal-lg',

    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent-lg'></div>";
Modal::end();
?>