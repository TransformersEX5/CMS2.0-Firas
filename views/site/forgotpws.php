<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Apr 2023 08:15:21 GMT -->

<head>

        <meta charset="utf-8" />
        <title>Recoverpw | Lexa - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico"> 
        
        <!-- Bootstrap Css -->
        <link href="/lexa-ajax/layouts/purpel/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/lexa-ajax/layouts/purpel/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/lexa-ajax/layouts/purpel/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <!-- <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div> -->
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="/lexa-ajax/layouts/purpel/assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <!-- <p class="mt-3 fs-15 fw-medium">Welcome to APEL Centre!</p> -->
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Forgot Password?</h5>
                                    <!-- <p class="text-muted">Reset password with velzon</p> -->

                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>

                                </div>

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email and instructions will be sent to you!
                                </div>
                                <div class="p-2">
                                    <form>
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
                                        </div>
                                    </form><!-- end form -->
                                    
                                </div>
                                <?= Html::a('Click here to login', Url::base() . '/site/login', ['class' => 'nav-link']) ?>
                            </div>
                            <!-- end card body -->
                        </div>
                        
                        <!-- end card -->

                        <!-- <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <a href="auth-signin-basic.html" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                        </div> -->

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer start-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> APEL | City University <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
<!-- JAVASCRIPT -->
<script src="/lexa-ajax/layouts/purpel/assets/libs/jquery/jquery.min.js"></script>
        <script src="/lexa-ajax/layouts/purpel/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/lexa-ajax/layouts/purpel/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/lexa-ajax/layouts/purpel/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/lexa-ajax/layouts/purpel/assets/libs/node-waves/waves.min.js"></script>
        <script src="/lexa-ajax/layouts/purpel/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
        <!-- App js -->
        <script src="/lexa-ajax/layouts/purpel/assets/js/app.js"></script>
    </body>


<!-- Mirrored from themesdesign.in/lexa-ajax/layouts/purpel/pages-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 May 2023 13:39:41 GMT -->
</html>


<!-- ============================================== -->