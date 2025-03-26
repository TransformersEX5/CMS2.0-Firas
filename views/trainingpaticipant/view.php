<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingpaticipant $model */

$this->title = $model->ParticipantId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingpaticipants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbltrainingpaticipant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ParticipantId' => $model->ParticipantId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ParticipantId' => $model->ParticipantId], [
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
            'ParticipantId',
            'TrainingId',
            'UserId',
            'TransactionDate',
        ],
    ]) ?>

</div>
