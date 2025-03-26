<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\authitemtype $model */

$this->title = Yii::t('app', 'Create Authitemtype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authitemtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitemtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
