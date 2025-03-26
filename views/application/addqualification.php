<?php

use app\models\Tblapplication;
use app\models\Tbleducation;
use app\models\Tblstate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id', 0);
?>

<?php

$form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]); ?>

<div class="row">

    <div class="col-md-4 mt-2">
        <?= $form->field($model, 'ExamTypeId')->dropDownList(ArrayHelper::map(Tbleducation::find()->asArray()->all(), 'EducLevelId', 'EducCode'), ['prompt' => 'Please select an education level', 'class' => 'form-control']); ?>
    </div>

    <div class="col-md-6 mt-2">
        <?= $form->field($model, 'ExamName')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-2 mt-2">
        <?= $form->field($model, 'ExamYear')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($model, 'ExamSchool')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-5 mt-2">
        <?= $form->field($model, 'DateCert')->textInput(['maxlength' => true, 'type' => 'date']); ?>
    </div>

    <div class="col-md-5 mt-2">
        <?= $form->field($model, 'SchoolStateId')->dropDownList(ArrayHelper::map(Tblstate::find()->asArray()->all(), 'StateId', 'StateName'), ['prompt' => 'Please select a school state', 'class' => 'form-control']); ?>
    </div>

    <div class="col-md-2 mt-2">
        <?= $form->field($model, 'ExamResult')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($model, 'SchoolAddress')->textarea(['rows' => '2']) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($model, 'ExamRemarks')->textarea(['rows' => '2']) ?>
    </div>

</div>

<div class="row">
    <div class="col-md-12 mt-3">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary w-md">Save</button>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>