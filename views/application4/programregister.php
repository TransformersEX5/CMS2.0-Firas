<?php

use app\models\Tblapplication;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');
?>

<?php

//    foreach($profile as $profile){

//     $StudName         = $profile['StudName'];
//     $StudEmailAddress = $profile['EmailAddress'];
//     $StudMobileNo     = $profile['MobileNo'];
//     $NationalityName  = $profile['NationalityId'];

//    }

//    echo $StudName;
// echo $message;
// echo print_r($profile);
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'class' => 'applicationForms',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<div class="row">
    <div class="col-md-12">
        <?= $form->field($programregister, 'ProgramTypeId1')->dropDownList(Yii::$app->common->getProgramType(), [
            'prompt' => '- ProgramTypeId -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId1')->dropDownList(Yii::$app->common->getProgramName(), [
            'prompt' => '- 1st Option -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId2')->dropDownList(Yii::$app->common->getProgramName(), [
            'prompt' => '- 2nd Option -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId3')->dropDownList(Yii::$app->common->getProgramName(), [
            'prompt' => '- 3th Option -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="alert alert-warning mt-2" role="alert">
        <strong>Keyin by officer / education counselor / Agent</strong>
    </div>
    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId4')->dropDownList(Yii::$app->common->getProgramCodePlusName(), [
            'prompt' => '- Final Option -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-4 mt-2">
        <?= $form->field($programregister, 'IntakeId')->dropDownList(Yii::$app->common->getIntake(), [
            'prompt' => '- Join Intake -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div> <!-- end col -->
    <div class="col-md-4 mt-2">
        <?= $form->field($programregister, 'FeeStructureId')->dropDownList(Yii::$app->common->getFeeStructure(), [
            'prompt' => '- Fee Structure -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div> <!-- end col -->


    <div class="col-md-4 mt-2">
        <?= $form->field($programregister, 'YearEntryId')->dropDownList(Yii::$app->common->getYearEntry(), [
            'prompt' => '- Year Entry -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'MarketingId')->dropDownList(Yii::$app->common->getStaffList(), [
            'prompt' => '- Select Agent -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-6 mt-2">
        <?= $form->field($programregister, 'AgentId')->dropDownList(Yii::$app->common->getAgentList(), [
            'prompt' => '- Select Agent -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-6 mt-2">
        <?= $form->field($programregister, 'MStudentNo')->textInput(['maxlength' => true, 'placeholder' => "Enter Student No"]); ?>
    </div>

    <div class="col-md-12 mt-2">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary w-md">Submit</button>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>