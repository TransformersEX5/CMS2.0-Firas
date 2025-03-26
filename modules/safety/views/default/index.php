<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

?>

<div class="col-12">
    <div class="card"><?php ActiveForm::begin(['id' => 'SafetyId', 'options' => ['onsubmit' => 'return false;']]); ?>
        <div class="card-body">
            <div class="col-12 d-flex justify-content-center">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <!-- <div class="carousel-item active">
                            <img class="d-block img-fluid" src="E:/DocumentSafety/image/Osh1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="E:/DocumentSafety/image/Osh2.jpg" alt="Second slide">
                        </div> -->
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="<?= Url::base() . '/image/image/Osh1.jpg' ?>" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="<?= Url::base() . '/image/image/Osh2.jpg' ?>" alt="Second slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= Url::base() . '/image/image/Osh3.jpg' ?>" class="img-fluid">
                    </div>
                </div>

                <div class="col-6">
                    <div>
                        <img src="<?= Url::base() . '/image/image/Osh4.jpg' ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div><?php ActiveForm::end(); ?>
    </div>
</div>