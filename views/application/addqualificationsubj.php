<?php

use app\models\Tblapplication;
use app\models\Tbleducation;
use app\models\Tbleducationsubject;
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
    // 'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]); ?>

<div class="row">

    <div class="col-md-8 mt-2">
        <?= $form->field($model, 'EduSubjId')->dropDownList(ArrayHelper::map(Tbleducationsubject::find()->asArray()->all(), 'EduSubjId', 'EduSubject'), ['prompt' => 'Please select a subject', 'class' => 'form-control']); ?>
    </div>

    <div class="col-md-4 mt-2">
        <?= $form->field($model, 'Result')->textInput(['maxlength' => true]); ?>
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