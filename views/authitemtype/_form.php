<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\authitemtype $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="authitemtype-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'auth_item_typeid')->textInput() ?>

    <?= $form->field($model, 'auth_item_desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
