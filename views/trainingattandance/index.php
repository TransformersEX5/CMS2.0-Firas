<?php

use app\models\Tbltrainingattandance;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tbltrainingattandances');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltrainingattandance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tbltrainingattandance'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TrainingAttanId',
            'TrainingDurationId',
            'UserId',
            'AttandId',
            'Remarks',
            //'TransactionDate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tbltrainingattandance $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'TrainingAttanId' => $model->TrainingAttanId]);
                 }
            ],
        ],
    ]); ?>


</div>
