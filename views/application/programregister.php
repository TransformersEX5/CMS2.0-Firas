<?php

use app\models\Tblapplication;
use app\models\Tblbranch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$backindex = '/application';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');
?>

<div class="col-md-12">
    <h5><?= $model->StudName ?>
        <div class="text-end">
            <?= $model->AppNo ?? '' ?><br><?= $model->ApplicationId ?? '' ?>
        </div>
    </h5>
</div>

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
            'class' => 'form-control mb-2',
            'disabled' => true,
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId1')->dropDownList(Yii::$app->common->getProgramName(), [
            'prompt' => '- 1st Option -',
            'class' => 'form-control mb-2',
            'disabled' => true,
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId2')->dropDownList(Yii::$app->common->getProgramName(), [
            'prompt' => '- 2nd Option -',
            'class' => 'form-control mb-2',
            'disabled' => true,
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId3')->dropDownList(Yii::$app->common->getProgramName(), [
            'prompt' => '- 3th Option -',
            'class' => 'form-control mb-2',
            'disabled' => true,
        ]) ?>
    </div>

    <div class="alert alert-warning mt-2" role="alert">
        <strong>Keyin by Officer / Education counselor / Agent</strong>
    </div>
    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'ProgramId4')->dropDownList(Yii::$app->common->getProgramCodePlusName(), [
            'prompt' => '- Final Option -',
            'class' => 'form-control mb-2'
        ]) ?>
    </div>

    <div class="col-md-3 mt-2">
        <?= $form->field($programregister, 'IntakeId')->dropDownList(Yii::$app->common->getIntake(), [
            'prompt' => '- Join Intake -',
            'class' => 'form-control mb-2'
        ]) ?>
    </div> <!-- end col -->
    <div class="col-md-3 mt-2">
        <?= $form->field($programregister, 'FeeStructureId')->dropDownList(Yii::$app->common->getFeeStructure(), [
            'prompt' => '- Fee Structure -',
            'class' => 'form-control mb-2'
        ]) ?>
    </div> <!-- end col -->

    <div class="col-md-3 mt-2">
        <?= $form->field($programregister, 'BranchId')->dropDownList(ArrayHelper::map(Tblbranch::find()->where(['StatusId' => 1])->asArray()->all(), 'BranchId', 'BranchName'), [
            'prompt' => 'Please select a center', 
            'class' => 'form-control mb-2'
            ])?>
    </div>

    <div class="col-md-3 mt-2">
        <?= $form->field($programregister, 'YearEntryId')->dropDownList(Yii::$app->common->getYearEntry(), [
            'prompt' => '- Year Entry -',
            'class' => 'form-control mb-2'
        ]) ?>
    </div>

    <div class="col-md-12 mt-2">
        <?= $form->field($programregister, 'MarketingId')->dropDownList(Yii::$app->common->getStaffList(), [
            'prompt' => '- Select Agent -',
            'class' => 'form-control mb-2'
        ]) ?>
    </div>

    <div class="col-md-6 mt-2">
        <?= $form->field($programregister, 'AgentId')->dropDownList(Yii::$app->common->getAgentList(), [
            'prompt' => '- Select Agent -',
            'class' => 'form-control mb-2'
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