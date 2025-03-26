<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingpaticipant $model */

$this->title = Yii::t('app', 'Create Tbltrainingpaticipant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainingpaticipants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltrainingpaticipant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
