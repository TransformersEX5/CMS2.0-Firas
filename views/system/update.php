<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblsystem $model */

$this->title = Yii::t('app', 'Update Tblsystem: {name}', [
    'name' => $model->SystemId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblsystems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SystemId, 'url' => ['view', 'SystemId' => $model->SystemId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblsystem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
