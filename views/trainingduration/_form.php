<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingduration $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbltrainingduration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TrainingId')->textInput() ?>

    <?= $form->field($model, 'TrainingDate')->textInput() ?>

    <?= $form->field($model, 'TrainingTimeStart')->textInput() ?>

    <?= $form->field($model, 'TrainingTimeEnd')->textInput() ?>

    <?= $form->field($model, 'TraningTotHours')->textInput() ?>

    <?= $form->field($model, 'Remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
