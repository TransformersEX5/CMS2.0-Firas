<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramregister $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tblprogramregister-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ApplicationId')->textInput() ?>

    <?= $form->field($model, 'ProgramId1')->textInput() ?>

    <?= $form->field($model, 'ProgramId2')->textInput() ?>

    <?= $form->field($model, 'ProgramId3')->textInput() ?>

    <?= $form->field($model, 'ProgramId4')->textInput() ?>

    <?= $form->field($model, 'IntakeId')->textInput() ?>

    <?= $form->field($model, 'SessionId')->textInput() ?>

    <?= $form->field($model, 'FeeStructureId')->textInput() ?>

    <?= $form->field($model, 'YearEntryId')->textInput() ?>

    <?= $form->field($model, 'ProgDiscCategoryId')->textInput() ?>

    <?= $form->field($model, 'MarketingId')->textInput() ?>

    <?= $form->field($model, 'AgentId')->textInput() ?>

    <?= $form->field($model, 'MStudentNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <?= $form->field($model, 'TransactionUpdated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
