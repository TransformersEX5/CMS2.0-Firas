<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingattandance $model */

$this->title = Yii::t('app', 'Update Tbltrainingattandance: {name}', [
    'name' => $model->TrainingAttanId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingattandances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TrainingAttanId, 'url' => ['view', 'TrainingAttanId' => $model->TrainingAttanId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbltrainingattandance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
