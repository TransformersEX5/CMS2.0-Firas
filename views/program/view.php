<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\tblprogram $model */

$this->title = $model->ProgramId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprograms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblprogram-view">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>