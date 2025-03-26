<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tbldepartment $model */

$this->title = $model->DepartmentId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbldepartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbldepartment-view">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>