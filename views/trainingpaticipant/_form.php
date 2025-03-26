<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingpaticipant $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbltrainingpaticipant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TrainingId')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
