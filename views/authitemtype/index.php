<?php

use app\models\authitemtype;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Authitemtypes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitemtype-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Authitemtype'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'auth_item_typeid',
            'auth_item_desc',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, authitemtype $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'auth_item_typeid' => $model->auth_item_typeid]);
                 }
            ],
        ],
    ]); ?>


</div>
