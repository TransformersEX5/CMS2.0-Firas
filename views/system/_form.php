<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblsystem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tblsystem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SystemName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SystemDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IpCheck')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Public')->textInput() ?>

    <?= $form->field($model, 'StatusId')->textInput() ?>

    <?= $form->field($model, 'SystemMsg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
