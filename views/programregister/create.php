<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramregister $model */

$this->title = Yii::t('app', 'Create Tblprogramregister');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprogramregisters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblprogramregister-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
