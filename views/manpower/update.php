<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\Models\Tblmenpower $model */

$this->title = Yii::t('app', 'Update Tblmenpower: {name}', [
    'name' => $model->ManPowerId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblmenpowers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ManPowerId, 'url' => ['view', 'ManPowerId' => $model->ManPowerId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblmenpower-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
