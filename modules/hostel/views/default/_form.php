<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\hostel\models\tblhostel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tblhostel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HostelCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HostelName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HostelTypeId')->textInput() ?>

    <?= $form->field($model, 'HostelAddress1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HostelAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HostelPostCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HostelCityName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HostelStateId')->textInput() ?>

    <?= $form->field($model, 'HostelStatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
