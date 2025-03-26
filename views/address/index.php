<?php

use app\models\Tbladdress;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tbladdresses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbladdress-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tbladdress'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AddressId',
            'ApplicationId',
            'CorrAddress1',
            'CorrAddress2',
            'CorrCity',
            //'CorrPostCode',
            //'CorrStateId',
            //'CorrHomeNo',
            //'CorrMobileNo',
            //'StudGuardName',
            //'StudGuardRelationshipId',
            //'StudGuardEmailAddress:email',
            //'StudGurdOccupation',
            //'StudGurdHomeNo',
            //'StudGurdMobileNo',
            //'StudEmergName',
            //'StudEmergRelationshipId',
            //'StudEmergHomeNo',
            //'StudEmergMobileNo',
            //'StudEmergOfficeNo',
            //'TransactionDate',
            //'TransactionUpdated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tbladdress $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ApplicationId' => $model->ApplicationId]);
                 }
            ],
        ],
    ]); ?>


</div>
