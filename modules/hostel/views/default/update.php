<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\hostel\models\tblhostel $model */

$this->title = Yii::t('app', 'Update Tblhostel: {name}', [
    'name' => $model->HostelId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblhostels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->HostelId, 'url' => ['view', 'HostelId' => $model->HostelId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblhostel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
