<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\hostel\models\tblhostel $model */

$this->title = $model->HostelId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblhostels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblhostel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'HostelId' => $model->HostelId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'HostelId' => $model->HostelId], [
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
            'HostelId',
            'HostelCode',
            'HostelName',
            'HostelTypeId',
            'HostelAddress1',
            'HostelAddress2',
            'HostelPostCode',
            'HostelCityName',
            'HostelStateId',
            'HostelStatus',
            'UserId',
            'TransactionDate',
        ],
    ]) ?>

</div>
