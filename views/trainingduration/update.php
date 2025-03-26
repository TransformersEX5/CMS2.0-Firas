<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingduration $model */

$this->title = Yii::t('app', 'Update Tbltrainingduration: {name}', [
    'name' => $model->TrainingDurationId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingdurations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TrainingDurationId, 'url' => ['view', 'TrainingDurationId' => $model->TrainingDurationId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbltrainingduration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
