<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\intake\models\tblintake $model */

$this->title = $model->IntakeId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblintakes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblintake-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'IntakeId' => $model->IntakeId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'IntakeId' => $model->IntakeId], [
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
            'IntakeId',
            'IntakeYrMo',
            'IntakeStatus',
            'IntakeTypeId',
            'MajorIntakeId',
            'TransactionDate',
            'UserId',
        ],
    ]) ?>

</div>
