<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbladdress $model */

$this->title = Yii::t('app', 'Create Tbladdress');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbladdresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbladdress-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
