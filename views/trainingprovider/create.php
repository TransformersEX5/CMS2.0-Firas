<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingprovider $model */

// $this->title = Yii::t('app', 'New Training Provider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingproviders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltrainingprovider-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
