<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbltraining $model */

// $this->title = Yii::t('app', 'Create Tbltraining');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbltrainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbltraining-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_param', [
        'model' => $model,
    ]) ?>

</div>
