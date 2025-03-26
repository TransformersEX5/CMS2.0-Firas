<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramtype $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tblprogramtype-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ProgramTypeName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ProgramTypeCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodeLevel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StatusId')->textInput() ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'KptConvo_ProgType')->textInput() ?>

    <?= $form->field($model, 'Ifms_Code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ifms_Desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
