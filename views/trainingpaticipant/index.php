<?php

use app\models\Tbltrainingpaticipant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tbltrainingpaticipants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltrainingpaticipant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tbltrainingpaticipant'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ParticipantId',
            'TrainingId',
            'UserId',
            'TransactionDate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tbltrainingpaticipant $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ParticipantId' => $model->ParticipantId]);
                 }
            ],
        ],
    ]); ?>


</div>
