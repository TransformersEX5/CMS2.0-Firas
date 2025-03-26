<?php
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Welcome Page';
?>
<div class="site-index">


    <!-- <h1 class="page-title">DataTablesx</h1> -->
    <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li> -->
        <!-- <li class="breadcrumb-item">DataTables</li> -->
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <!-- <div class="ibox-title">Welcome </div> -->
        </div>
        <div class="ibox-body">

           <!--====================start page===================================== -->

            <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4">Welcome to </h1>
                <?php
                     echo Html::img('@web/image/CityU_logo.png', ['alt' => '#',  'class' => 'img-fluid mt-1 mt-sm-0 align-middle','width' => 650,'height' => 150]);
                 ?>  
                 
                
                <!-- <p class="lead">You have successfully created your Yii-powered application.</p> -->

                <!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
            </div>

                    <!-- <div class="body-content">

                <div class="row">
                    <div class="col-lg-4">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                    </div>
                </div>

            </div> -->
        </div>


        <!---------------------end page--------------------------->




    </div>
</div>

</div>