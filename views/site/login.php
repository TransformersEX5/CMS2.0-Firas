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

<!-- =============================================================== -->


<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/lexa-ajax/layouts/purpel/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 May 2023 13:39:41 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Login | CMS</title>
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
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">

                            <h3 class="text-center mt-1 mb-4">
                                <a href="#" class="d-block auth-logo">
                                    <!-- <img src="/lexa-ajax/layouts/purpel/assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark"> -->
                                    <!-- <img src="/lexa-ajax/layouts/purpel/assets/images/logo-light.png" alt="" height="30" class="auth-logo-light"> -->
                                    <!-- <img src="@web/image/CityU_logo.jpg" class=" img-fluid" alt="#" height="180"> -->
                                    <?php echo Html::img('@web/image/CityU_logo.png', [ 'alt' => 'Your Image','width' => 400,'height' => 120,'class' => 'img-fluid',]);?>
                                </a>
                            </h3>

                            <div class="p-3">
                                <h4 class="text-muted font-size-18 mb-1 text-center">Welcome Back !</h4>
                                <p class="text-muted text-center">Sign in to continue to CMS.</p>
                                <?php $form = ActiveForm::begin(['id' => 'userReg'], ['options' => ['enctype' => 'multipart/form-data']]); ?>

                                <div class="mb-3">
                                    <!-- <label for="username" class="form-label">Username</label> -->
                                    <?= $form->field($model, 'EmailAddress')->textInput(['class' => 'form-control', 'required' => 'required', 'placeholder' => 'CityU Email'])->label(false) ?>

                                    <!-- <input type="text" class="form-control" id="username" placeholder="Enter username"> -->
                                </div>

                                <div class="mb-3">

                                    <!-- <label class="form-label" for="password-input">Password</label> -->
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <!-- <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input"> -->
                                        <?= $form->field($model, 'UserPassword')->passwordInput(['class' => 'form-control pe-5', 'required' => 'required', 'placeholder' => 'Enter your password'])->label(false) ?>

                                        <!-- <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button> -->
                                    </div>
                                    <!-- <a href="forgotpws.php" class="text-muted">Forgot password?</a> -->
                                    <div class="row">

                                     <div class="col-md-6">
                                            <?= Html::a('Forgot password?', Url::base() . '/site/forgotpws', ['class' => 'nav-link']) ?>

                                        </div>
                                        <div class="col-md-6 text-end">

                                        <?= Html::a('First time login ?', Url::base() . '/site/getaccess', ['class' => 'nav-link']) ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-check">
                                            <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                        </div> -->

                                <div class="mt-4">
                                    <!-- <button class="btn btn-success w-100" type="submit">Sign In</button> -->
                                    <button class="btn btn-success w-100" type="submit">Log In</button>

                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>

       

                    <div class="mt-5 text-center">
                            
                        <!-- <p>Don't have an account ? <a href="#" class="text-primary"> Signup Now </a></p>                             -->
                                               
                        © <script>document.write(new Date().getFullYear())</script> <span class="d-none d-sm-inline-block"> - <i class="mdi mdi-heart text-danger"></i> by CMS Team.</span>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="/lexa-ajax/layouts/purpel/assets/libs/jquery/jquery.min.js"></script>
    <script src="/lexa-ajax/layouts/purpel/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/lexa-ajax/layouts/purpel/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="vassets/libs/simplebar/simplebar.min.js"></script>
    <script src="/lexa-ajax/layouts/purpel/assets/libs/node-waves/waves.min.js"></script>
    <script src="/lexa-ajax/layouts/purpel/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- App js -->
    <script src="/lexa-ajax/layouts/purpel/assets/js/app.js"></script>
</body>


<!-- Mirrored from themesdesign.in/lexa-ajax/layouts/purpel/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 May 2023 13:39:41 GMT -->

</html>