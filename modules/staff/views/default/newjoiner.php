<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\staff\models\tbluser $model */

$this->title = Yii::t('app', 'Create Tbluser');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbluser-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formNewJoiner', [
        'model' => $model,
    ]) ?>

</div>
