<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingattandance $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbltrainingattandance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TrainingDurationId')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'AttandId')->textInput() ?>

    <?= $form->field($model, 'Remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
