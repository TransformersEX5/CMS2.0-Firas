<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingpaticipant $model */

$this->title = Yii::t('app', 'Update Tbltrainingpaticipant: {name}', [
    'name' => $model->ParticipantId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingpaticipants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ParticipantId, 'url' => ['view', 'ParticipantId' => $model->ParticipantId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbltrainingpaticipant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
