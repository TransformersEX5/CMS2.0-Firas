<?php

use app\Models\Tblmanpower;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tblmanpowers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmanpower-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblmanpower'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ManPowerId',
            'PositionId',
            'CampusId',
            'DepartmentId',
            'DateRequired',
            //'TotRequired',
            //'TypeRequestId',
            //'DueToRequest',
            //'Justification',
            //'EmploymentStatusId',
            //'DurationEmployment',
            //'TotTeachHours',
            //'SubjectName',
            //'Qualification',
            //'Experience',
            //'SpecificsSkills',
            //'Responsibilities',
            //'Remarks',
            //'CheckListCompletForm',
            //'CheckListOrgChart',
            //'CheckListJD',
            //'TransDate',
            //'UserId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tblmanpower $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ManPowerId' => $model->ManPowerId]);
                 }
            ],
        ],
    ]); ?>


</div>
