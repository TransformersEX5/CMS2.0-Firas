<?php

use app\models\Tblapplication;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id', 0);
?>

<?php

$form = ActiveForm::begin([
    // 'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]); ?>

<div class="col-md-4">
    <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
        'prompt' => '- Nationality -',
        'class' => 'form-select mb-2',
        'disabled' => $id !== 0,
    ]) ?>
</div>

<div class="row mt-2">
    <div class="col-md-8">
        <div class="mt-2">

            <?= $form->field($model, 'StudName')->textInput(['maxlength' => true]); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mt-2">
            <?= $form->field($model, 'NRICPassportNo')->textInput(['maxlength' => true, 'readonly' => $id !== 0]); ?>
        </div>
    </div> <!-- end col -->
    <div class="col-md-3">
        <div class="mt-2">
            <?= $form->field($model, 'DateOfBirth')->textInput(['maxlength' => true, 'type' => 'date']); ?>
        </div>
    </div> <!-- end col -->
    <div class="col-md-3">
        <div class="mt-2">
            <?= $form->field($model, 'GenderId')->dropDownList(Yii::$app->common->getGender(), [
                'prompt' => '- Gender -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->
    <div class="col-md-3">
        <div class="mt-2">
            <?= $form->field($model, 'RaceId')->dropDownList(Yii::$app->common->getRace(), [
                'prompt' => '- Race -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->
    <div class="col-md-3">
        <div class="mt-2">
            <?= $form->field($model, 'ReligionId')->dropDownList(Yii::$app->common->getReligion(), [
                'prompt' => '- Religion -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">

    <div class="col-md-8 mt-2">
        <?= $form->field($model, 'EmailAddress')->textInput(['maxlength' => true, 'readonly' => $id !== 0]); ?>
    </div>

    <div class="col-md-4 mt-2">
        <?= $form->field($model, 'MobileNo')->textInput(['maxlength' => true]); ?>
    </div>
</div> <!-- end row -->
<div class="row">

    <div class="col-md-12">
        <div class="mt-2">
            <?= $form->field($model, 'LeedsSourceId')->dropDownList(Yii::$app->common->getLeedsSource(), [
                'prompt' => '- Leeds Source -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->

    <div class="col-md-12 mt-2">
        <?= $form->field($model, 'Remarks')->textarea(['rows' => '2']) ?>
    </div>
    <!-- <div class="col-md-12 mt-2">

        <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-8">{input}</div></div>',
        ]) ?>
    </div> -->

    <div class="col-md-12 mt-2">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary w-md">Submit & Next</button>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>