<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingduration $model */

$this->title = $model->TrainingDurationId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingdurations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbltrainingduration-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'TrainingDurationId' => $model->TrainingDurationId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'TrainingDurationId' => $model->TrainingDurationId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TrainingDurationId',
            'TrainingId',
            'TrainingDate',
            'TrainingTimeStart',
            'TrainingTimeEnd',
            'TraningTotHours',
            'Remarks',
            'TransactionDate',
            'UserId',
        ],
    ]) ?>

</div>
