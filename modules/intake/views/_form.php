<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\intake\models\tblintake $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tblintake-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IntakeYrMo')->textInput() ?>

    <?= $form->field($model, 'IntakeStatus')->textInput() ?>

    <?= $form->field($model, 'IntakeTypeId')->textInput() ?>

    <?= $form->field($model, 'MajorIntakeId')->textInput() ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
