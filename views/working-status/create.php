<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblworkingstatus $model */

$this->title = Yii::t('app', 'Create Working Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblworkingstatuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblworkingstatus-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
