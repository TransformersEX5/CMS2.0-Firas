<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\Models\AuthItem $model */
/** @var yii\widgets\ActiveForm $form */
$backindex = '/auth-item';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?> -->

    <div class="col-md-6 mt-2">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "Department-create"]); ?>
    </div>


    <div class="col-md-6 mt-2">
        <div class="mt-2">
            <?= $form->field($model, 'type')->dropDownList(Yii::$app->common->getAuthTypeList(), [
                'prompt' => '- Type -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->


    <div class="col-md-6 mt-2">
        <div class="mt-2">
            <?= $form->field($model, 'SystemId')->dropDownList(Yii::$app->common->getSystemName(), [
                'prompt' => '- Type -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->



    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>



    <!-- <?= $form->field($model, 'rule_name')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'created_at')->textInput() ?> -->

    <!-- <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <div class="form-group mt-3">

        <?php
        if ($pageUrl == 'view') {
            //echo Html::a(' Close ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
        } else {
            // echo Html::a(' Cancel ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
            echo '&nbsp';
            echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
        }

        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>