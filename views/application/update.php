<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblapplication $model */

// $this->title = Yii::t('app', 'Update Tblapplication: {name}', [
//     'name' => $model->ApplicationId,
// ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblapplications'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->ApplicationId, 'url' => ['view', 'ApplicationId' => $model->ApplicationId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblapplication-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'address' => $address,'programregister' => $programregister,
    ]) ?>


</div>
