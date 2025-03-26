<?php

use app\models\Tblprogramtype;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tblprogramtypes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblprogramtype-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblprogramtype'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ProgramTypeId',
            'ProgramTypeName',
            'ProgramTypeCode',
            'CodeLevel',
            'StatusId',
            //'TransactionDate',
            //'UserId',
            //'KptConvo_ProgType',
            //'Ifms_Code',
            //'Ifms_Desc',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tblprogramtype $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ProgramTypeId' => $model->ProgramTypeId]);
                 }
            ],
        ],
    ]); ?>


</div>
