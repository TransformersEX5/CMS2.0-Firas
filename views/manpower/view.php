<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\Models\Tblmenpower $model */

$this->title = $model->ManPowerId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblmenpowers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblmenpower-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ManPowerId' => $model->ManPowerId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ManPowerId' => $model->ManPowerId], [
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
            'ManPowerId',
            'PositionId',
            'CampusId',
            'DepartmentId',
            'DateRequired',
            'TotRequired',
            'TypeRequestId',
            'DueToRequest',
            'Justification',
            'EmploymentStatusId',
            'DurationEmployment',
            'TotTeachHours',
            'SubjectName',
            'Qualification',
            'Experience',
            'SpecificsSkills',
            'Responsibilities',
            'Remarks',
            'CheckListCompletForm',
            'CheckListOrgChart',
            'CheckListJD',
            'TransDate',
            'UserId',
        ],
    ]) ?>

</div>
