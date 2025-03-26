<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\tbluser $model */
/** @var yii\widgets\ActiveForm $form */
$backindex = '/user';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>

<div class="tbluser-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'UserNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserNo2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FullName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ICPassportNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmailAddress')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'UserDOB')->textInput([
        'language' => 'en',
        'size' => 'ms',
        'template' => '{input}{button}',
        'pickButtonIcon' => 'glyphicon glyphicon-calendar',
        'inline' => false,
        'clientOptions' => [
            'viewSelect' => 'decade',
            'minView' => 0,
            'maxView' => 4,
            'autoclose' => true,
            'format' => "yyyy-mm-dd",
            'startDate' => "2013-02-14 10:00",
            'minuteStep' => 10,
            'todayBtn' => false,
            'showMeridian' => true,
            'todayHighlight' => true,
            'keyboardNavigation' => true,
            'changeYear' => true,

        ]
    ]); ?> -->





    <?= $form->field($model, 'NationalityId')->textInput() ?>

    <div class="mb-6">
        <div>
            <div class="input-group" id="datepicker2">
                <?= $form->field($model, 'UserDOB')->textInput(['maxlength' => true, 'placeholder' => "dd-mm-yyyy", 'data-date-format' => "dd-mm-yyyy", 'data-provide' => "datepicker", 'data-date-autoclose' => "true", 'data-date-container' => "#datepicker2"]); ?>
                <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->

            </div>
            <!-- input-group -->
        </div>
    </div>

    <?= $form->field($model, 'DOBAlert')->textInput() ?>

    <?= $form->field($model, 'HandSetNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FaxNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OffLettPosition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PositionId')->textInput() ?>

    <?= $form->field($model, 'BranchId')->textInput() ?>

    <?= $form->field($model, 'StatusId')->textInput() ?>

    <?= $form->field($model, 'WorkingStatusId')->textInput() ?>

    <?= $form->field($model, 'DateJoin')->textInput() ?>

    <?= $form->field($model, 'DateConfirm')->textInput() ?>

    <?= $form->field($model, 'DateLast')->textInput() ?>

    <?= $form->field($model, 'ContractStart')->textInput() ?>

    <?= $form->field($model, 'ContractEnd')->textInput() ?>

    <?= $form->field($model, 'RaceId')->textInput() ?>

    <?= $form->field($model, 'ReligionId')->textInput() ?>

    <?= $form->field($model, 'Gender')->textInput() ?>

    <?= $form->field($model, 'MaritalStatusId')->textInput() ?>

    <?= $form->field($model, 'DepartmentId')->textInput() ?>

    <?= $form->field($model, 'Remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserPassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserPasswordCrypt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_password_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ActivateCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserImage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TypeUser')->textInput() ?>

    <?= $form->field($model, 'Hod1')->textInput() ?>

    <?= $form->field($model, 'Hod2')->textInput() ?>

    <?= $form->field($model, 'StaffLevelId')->textInput() ?>

    <?= $form->field($model, 'CmsAccess')->textInput() ?>

    <?= $form->field($model, 'DCollegeCode')->textInput() ?>

    <?= $form->field($model, 'ChangePassword')->textInput() ?>

    <?= $form->field($model, 'TransactionDate')->textInput() ?>

    <?= $form->field($model, 'TransactionUpdated')->textInput() ?>

    <?= $form->field($model, 'ExtensionNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MarketingTeamId')->textInput() ?>

    <?= $form->field($model, 'MarketingSubTeamId')->textInput() ?>

    <?= $form->field($model, 'ThumbPrint')->textInput() ?>

    <?= $form->field($model, 'hrcms')->textInput() ?>

    <?= $form->field($model, 'keyinId')->textInput() ?>

    <?= $form->field($model, 'TargetNo')->textInput() ?>

    <?= $form->field($model, 'ProfileConform')->textInput() ?>

    <?= $form->field($model, 'ProfileConformDate')->textInput() ?>

    <?= $form->field($model, 'ExtProbationStart')->textInput() ?>

    <?= $form->field($model, 'ExtProbationEnd')->textInput() ?>

    <?= $form->field($model, 'DueDay')->textInput() ?>

    <?= $form->field($model, 'MonthWork')->textInput() ?>

    <?= $form->field($model, 'Evaluation')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
</script>