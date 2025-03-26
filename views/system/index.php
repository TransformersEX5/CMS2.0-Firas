<?php

use app\models\Tblsystem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tblsystems');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblsystem-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblsystem'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SystemId',
            'SystemName',
            'SystemDescription',
            'URL:url',
            'IpCheck',
            //'Public',
            //'StatusId',
            //'SystemMsg',
            //'UserId',
            //'TransactionDate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tblsystem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'SystemId' => $model->SystemId]);
                 }
            ],
        ],
    ]); ?>


</div>
