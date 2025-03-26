<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbldepartment $model */

$this->title = Yii::t('app', 'Create Tbldepartment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbldepartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbldepartment-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>