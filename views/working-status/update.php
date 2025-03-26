<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblworkingstatus $model */

$this->title = Yii::t('app', 'Update Working Status: {name}', [
    'name' => $model->WorkingStatusId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblworkingstatuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->WorkingStatusId, 'url' => ['view', 'WorkingStatusId' => $model->WorkingStatusId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblworkingstatus-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
