<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\Models\Tblmenpower $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tblmenpower-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row mt-2">
        <div class="col-md-4">
            <div class="mt-2">
            <?= $form->field($model, 'PositionId')->dropDownList(Yii::$app->common->getPosition(), [
            'prompt' => '- Position -',
            'class' => 'form-select mb-2'
        ]) ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="mt-2">
            <?= $form->field($model, 'BranchId')->dropDownList(Yii::$app->common->getBranchName(), [
            'prompt' => '- Center Study  -',
            'class' => 'form-select mb-2'
        ]) ?>
            </div>
        </div> <!-- end col -->
    </div>

    
<!-- ==================================================================================================================================== -->

<div class="row mt-2">
        <div class="col-md-4">
            <div class="mt-2">
                <?= $form->field($model, 'DepartmentId')->dropDownList(Yii::$app->common->getDepartment(), [
                'prompt' => '- Department/Faculty -',
                'class' => 'form-select mb-2'
            ]) ?>
            </div>
        </div>


        <div class="col-md-2">
            <div class="mt-2">
            <?= $form->field($model, 'DateRequired')->textInput(['maxlength' => true, 'type' => 'date','placeholder' => 'dd-mm-yyyy', 'data-date-format' => 'dd-mm-yyyy']); ?>
            </div>
        </div>



        <div class="col-md-2">
            <div class="mt-2">            
            <?= $form->field($model, 'TotRequired')->textInput() ?>
        </div>

        
        </div> <!-- end col -->
    </div>

    
<!-- ==================================================================================================================================== -->


        
    <div class="row mt-2">
        <div class="col-md-4">
            <div class="mt-2">
            <?= $form->field($model, 'TypeRequestId')->dropDownList(Yii::$app->common->getMenPowerTypeRequest(), [
            'prompt' => '- Type Request -',
            'class' => 'form-select mb-2'
        ]) ?>

            </div>
        </div>

        <div class="col-md-4">
            <div class="mt-2">
                <?= $form->field($model, 'DueToRequest')->dropDownList(Yii::$app->common->getMenPowerTypeRequestDue(), [
            'prompt' => '- Type Request -',
            'class' => 'form-select mb-2'
        ]) ?>
            </div>
        </div> <!-- end col -->
    </div>


<!-- ==================================================================================================================================== -->
    

    <?= $form->field($model, 'Justification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmploymentStatusId')->textInput() ?>

    <?= $form->field($model, 'DurationEmployment')->textInput() ?>

    <?= $form->field($model, 'TotTeachHours')->textInput() ?>

    <?= $form->field($model, 'SubjectName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Qualification')->textInput() ?>

    <?= $form->field($model, 'Experience')->textInput() ?>

    <?= $form->field($model, 'SpecificsSkills')->textInput() ?>

    <?= $form->field($model, 'Responsibilities')->textInput() ?>

    <?= $form->field($model, 'Remarks')->textInput() ?>

    <?= $form->field($model, 'CheckListCompletForm')->textInput() ?>

    <?= $form->field($model, 'CheckListOrgChart')->textInput() ?>

    <?= $form->field($model, 'CheckListJD')->textInput() ?>

    <?= $form->field($model, 'TransDate')->textInput() ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
