<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingattandance $model */

$this->title = $model->TrainingAttanId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingattandances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbltrainingattandance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'TrainingAttanId' => $model->TrainingAttanId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'TrainingAttanId' => $model->TrainingAttanId], [
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
            'TrainingAttanId',
            'TrainingDurationId',
            'UserId',
            'AttandId',
            'Remarks',
            'TransactionDate',
        ],
    ]) ?>

</div>
