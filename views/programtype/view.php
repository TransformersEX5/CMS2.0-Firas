<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramtype $model */

$this->title = $model->ProgramTypeId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprogramtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblprogramtype-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ProgramTypeId' => $model->ProgramTypeId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ProgramTypeId' => $model->ProgramTypeId], [
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
            'ProgramTypeId',
            'ProgramTypeName',
            'ProgramTypeCode',
            'CodeLevel',
            'StatusId',
            'TransactionDate',
            'UserId',
            'KptConvo_ProgType',
            'Ifms_Code',
            'Ifms_Desc',
        ],
    ]) ?>

</div>
