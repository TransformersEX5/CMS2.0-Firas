<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblapplication $model */

$this->title = Yii::t('app', 'Create Tblapplication');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblapplications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblapplication-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
