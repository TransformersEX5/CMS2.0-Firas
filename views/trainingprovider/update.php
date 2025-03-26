<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingprovider $model */

$this->title = Yii::t('app', 'Update Training Provider: {name}', [
    'name' => $model->TrainingProviderId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingproviders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TrainingProviderId, 'url' => ['view', 'TrainingProviderId' => $model->TrainingProviderId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbltrainingprovider-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
