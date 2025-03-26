<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-interval="3000">
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="d-block img-fluid mx-auto" src="<?= URL::base().'/'.$model->ConvoImageName; ?>" alt="First slide">
        </div>
    </div>
</div>