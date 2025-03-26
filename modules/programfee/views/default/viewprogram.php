<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramfeecategory $model */

$this->title = Yii::t('app', 'Create Tblprogramfeecategory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblprogramfeecategories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblprogramfeecategory-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_viewprogramform', [
        'model' => $model,
    ]) ?>

</div>
