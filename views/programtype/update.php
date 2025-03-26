<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramtype $model */

$this->title = Yii::t('app', 'Update Tblprogramtype: {name}', [
    'name' => $model->ProgramTypeId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprogramtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ProgramTypeId, 'url' => ['view', 'ProgramTypeId' => $model->ProgramTypeId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblprogramtype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
