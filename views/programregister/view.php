<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramregister $model */

$this->title = $model->ProgramRegId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprogramregisters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblprogramregister-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ProgramRegId' => $model->ProgramRegId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ProgramRegId' => $model->ProgramRegId], [
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
            'ProgramRegId',
            'ApplicationId',
            'ProgramTypeId1',
            'ProgramId1',
            'ProgramId2',
            'ProgramId3',
            'ProgramTypeId2',
            'ProgramId4',
            'IntakeId',
            'SessionId',
            'FeeStructureId',
            'YearEntryId',
            'ProgDiscCategoryId',
            'MarketingId',
            'AgentId',
            'MStudentNo',
            'UserId',
            'TransactionDate',
            'TransactionUpdated',
        ],
    ]) ?>

</div>
