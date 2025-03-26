<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\hostel\models\tblhostel $model */

$this->title = Yii::t('app', 'Create Tblhostel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblhostels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblhostel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
