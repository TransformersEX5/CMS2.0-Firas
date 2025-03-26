<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tbladdress $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbladdress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AddressId')->textInput() ?>

    <?= $form->field($model, 'CorrAddress1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CorrAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CorrCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CorrPostCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CorrStateId')->textInput() ?>

    <?= $form->field($model, 'CorrHomeNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CorrMobileNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardRelationshipId')->textInput() ?>

    <?= $form->field($model, 'StudGuardEmailAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGurdOccupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGurdHomeNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGurdMobileNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergRelationshipId')->textInput() ?>

    <?= $form->field($model, 'StudEmergHomeNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergMobileNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergOfficeNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <?= $form->field($model, 'TransactionUpdated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
