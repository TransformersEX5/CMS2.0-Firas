<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\intake\models\tblintake $model */

$this->title = Yii::t('app', 'Update Tblintake: {name}', [
    'name' => $model->IntakeId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblintakes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IntakeId, 'url' => ['view', 'IntakeId' => $model->IntakeId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblintake-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
