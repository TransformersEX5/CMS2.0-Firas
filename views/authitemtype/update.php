<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\authitemtype $model */

$this->title = Yii::t('app', 'Update Authitemtype: {name}', [
    'name' => $model->auth_item_typeid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authitemtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auth_item_typeid, 'url' => ['view', 'auth_item_typeid' => $model->auth_item_typeid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="authitemtype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
