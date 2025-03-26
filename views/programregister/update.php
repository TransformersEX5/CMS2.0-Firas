<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramregister $model */

$this->title = Yii::t('app', 'Update Tblprogramregister: {name}', [
    'name' => $model->ProgramRegId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprogramregisters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ProgramRegId, 'url' => ['view', 'ProgramRegId' => $model->ProgramRegId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblprogramregister-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
