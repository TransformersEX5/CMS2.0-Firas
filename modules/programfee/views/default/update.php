<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramfeecategory $model */

$this->title = Yii::t('app', 'Update Tblprogramfeecategory: {name}', [
    'name' => $model->ProgFeeCatId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprogramfeecategories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ProgFeeCatId, 'url' => ['view', 'ProgFeeCatId' => $model->ProgFeeCatId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblprogramfeecategory-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
