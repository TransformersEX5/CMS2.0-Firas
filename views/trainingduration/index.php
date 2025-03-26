<?php

use app\models\Tbltrainingduration;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tbltrainingdurations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltrainingduration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tbltrainingduration'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TrainingDurationId',
            'TrainingId',
            'TrainingDate',
            'TrainingTimeStart',
            'TrainingTimeEnd',
            //'TraningTotHours',
            //'Remarks',
            //'TransactionDate',
            //'UserId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tbltrainingduration $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'TrainingDurationId' => $model->TrainingDurationId]);
                 }
            ],
        ],
    ]); ?>


</div>
