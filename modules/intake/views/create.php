<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\intake\models\tblintake $model */

$this->title = Yii::t('app', 'Create Tblintake');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblintakes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblintake-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
