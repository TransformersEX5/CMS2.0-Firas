<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblapplication $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tblapplication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AppNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BranchId')->textInput() ?>

    <?= $form->field($model, 'StudNRICPassportNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGenderId')->textInput() ?>

    <?= $form->field($model, 'StudNationalityId')->textInput() ?>

    <?= $form->field($model, 'ResidencyId')->textInput() ?>

    <?= $form->field($model, 'StudRaceId')->textInput() ?>

    <?= $form->field($model, 'MaritalStatusId')->textInput() ?>

    <?= $form->field($model, 'StudReligionId')->textInput() ?>

    <?= $form->field($model, 'StudDateOfBirth')->textInput() ?>

    <?= $form->field($model, 'StudCorrAddress1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudCorrAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudCorrCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudCorrPostCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudCorrStateId')->textInput() ?>

    <?= $form->field($model, 'StudCorrPhoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudMobileNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudResidenceNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmailAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ParentEmail1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ParentEmail2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardNationalityId')->textInput() ?>

    <?= $form->field($model, 'StudGuardNRICPassportNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardRelationshipId')->textInput() ?>

    <?= $form->field($model, 'StudGuardHomeAddress1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardHomeAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardHomeCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardHomeStateId')->textInput() ?>

    <?= $form->field($model, 'StudGuardHomePostCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardHomePhoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardHandPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudGuardAnnualIncome')->textInput() ?>

    <?= $form->field($model, 'StudGuardOccupationId')->textInput() ?>

    <?= $form->field($model, 'StudPermHomeAddress1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudPermHomeAddress2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudPermHomeCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudPermHomeStateId')->textInput() ?>

    <?= $form->field($model, 'StudPermHomePostCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudPermHomePhoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergRelationshipId')->textInput() ?>

    <?= $form->field($model, 'StudEmergHomePhoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergHandPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudEmergOfficePhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudAccomodation')->textInput() ?>

    <?= $form->field($model, 'AccomodationRemarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudBloodType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudAlergy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudDisease')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudDisability')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudRemarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'DateRegister')->textInput() ?>

    <?= $form->field($model, 'TransactionUpdated')->textInput() ?>

    <?= $form->field($model, 'MarketingId')->textInput() ?>

    <?= $form->field($model, 'AgentId')->textInput() ?>

    <?= $form->field($model, 'ProgramId1')->textInput() ?>

    <?= $form->field($model, 'ProgramId2')->textInput() ?>

    <?= $form->field($model, 'ProgramId3')->textInput() ?>

    <?= $form->field($model, 'ProgramId4')->textInput() ?>

    <?= $form->field($model, 'StudyCenterId')->textInput() ?>

    <?= $form->field($model, 'PromoId')->textInput() ?>

    <?= $form->field($model, 'LeedsSourceId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
