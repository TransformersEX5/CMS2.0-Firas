<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbladdress $model */

$this->title = Yii::t('app', 'Update Tbladdress: {name}', [
    'name' => $model->ApplicationId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbladdresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ApplicationId, 'url' => ['view', 'ApplicationId' => $model->ApplicationId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbladdress-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
