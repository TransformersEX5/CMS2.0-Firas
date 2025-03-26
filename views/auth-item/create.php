<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\Models\AuthItem $model */

$this->title = Yii::t('app', 'Create Role / Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
