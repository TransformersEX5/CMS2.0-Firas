<?php

use app\modules\hostel\models\tblhostel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tblhostels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblhostel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblhostel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'HostelId',
            'HostelCode',
            'HostelName',
            'HostelTypeId',
            'HostelAddress1',
            //'HostelAddress2',
            //'HostelPostCode',
            //'HostelCityName',
            //'HostelStateId',
            //'HostelStatus',
            //'UserId',
            //'TransactionDate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, tblhostel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'HostelId' => $model->HostelId]);
                 }
            ],
        ],
    ]); ?>


</div>
