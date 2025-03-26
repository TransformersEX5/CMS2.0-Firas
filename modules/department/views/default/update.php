<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbldepartment $model */

$this->title = Yii::t('app', 'Update Tbldepartment: {name}', [
    'name' => $model->DepartmentId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbldepartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DepartmentId, 'url' => ['view', 'DepartmentId' => $model->DepartmentId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbldepartment-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
