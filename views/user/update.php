<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\tbluser $model */

$this->title = Yii::t('app', 'Update Tbluser: {name}', [
    'name' => $model->UserId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserId, 'url' => ['view', 'UserId' => $model->UserId, 'MarketingTeamId' => $model->MarketingTeamId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbluser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
