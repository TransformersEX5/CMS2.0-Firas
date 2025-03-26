<?php

use app\modules\intake\models\tblintake;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tblintakes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblintake-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblintake'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IntakeId',
            'IntakeYrMo',
            'IntakeStatus',
            'IntakeTypeId',
            'MajorIntakeId',
            //'TransactionDate',
            //'UserId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, tblintake $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'IntakeId' => $model->IntakeId]);
                 }
            ],
        ],
    ]); ?>


</div>
