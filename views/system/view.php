<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tblsystem $model */

$this->title = $model->SystemId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblsystems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblsystem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'SystemId' => $model->SystemId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'SystemId' => $model->SystemId], [
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
            'SystemId',
            'SystemName',
            'SystemDescription',
            'URL:url',
            'IpCheck',
            'Public',
            'StatusId',
            'SystemMsg',
            'UserId',
            'TransactionDate',
        ],
    ]) ?>

</div>
