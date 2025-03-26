<?php

use app\models\Tblprogramregister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tblprogramregisters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblprogramregister-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblprogramregister'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ProgramRegId',
            'ApplicationId',
            'ProgramTypeId1',
            'ProgramId1',
            'ProgramId2',
            //'ProgramId3',
            //'ProgramTypeId2',
            //'ProgramId4',
            //'IntakeId',
            //'SessionId',
            //'FeeStructureId',
            //'YearEntryId',
            //'ProgDiscCategoryId',
            //'MarketingId',
            //'AgentId',
            //'MStudentNo',
            //'UserId',
            //'TransactionDate',
            //'TransactionUpdated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tblprogramregister $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ProgramRegId' => $model->ProgramRegId]);
                 }
            ],
        ],
    ]); ?>


</div>
