<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\tblprogram $model */

$this->title = Yii::t('app', 'Update TblRoom: {name}', [
    'name' => $model->RoomId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprograms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RoomId, 'url' => ['view', 'RoomId' => $model->RoomId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblprogram-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>