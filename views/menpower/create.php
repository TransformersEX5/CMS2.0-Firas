<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\Models\Tblmenpower $model */

$this->title = Yii::t('app', 'Create Tblmenpower');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblmenpowers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmenpower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
