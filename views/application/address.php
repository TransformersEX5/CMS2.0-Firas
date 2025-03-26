<?php

use app\models\Tbladdress;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<div class="alert alert-warning mt-2" role="alert">
    <strong>Section A : Home Address</strong>
</div>

<div class="col-md-12 mt-2">
    <?= $form->field($address, 'CorrAddress1')->textInput(['maxlength' => true]); ?>
</div>

<div class="col-md-12 mt-2">
    <?= $form->field($address, 'CorrAddress2')->textInput(['maxlength' => true]); ?>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <div class="mb-3">
            <?= $form->field($address, 'CorrCity')->textInput(['maxlength' => true]); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <?= $form->field($address, 'CorrStateId')->dropDownList(Yii::$app->common->getState(), [
                'prompt' => '- State -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div>
    <div class="col-md-4">
        <?= $form->field($address, 'CorrPostCode')->textInput(['maxlength' => true]); ?>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <div class="mb-3">
            <?= $form->field($address, 'CorrHomeNo')->textInput(['maxlength' => true]); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <?= $form->field($address, 'CorrMobileNo')->textInput(['maxlength' => true]); ?>
        </div>
    </div>
</div>

<div class="alert alert-warning mt-2" role="alert">
    <strong>Section B : Parent / Guardian </strong>
</div>
<div class="row mt-2">
    <div class="col-md-8 mt-2">
        <?= $form->field($address, 'StudGuardName')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-4 mt-2">
        <?= $form->field($address, 'StudGuardRelationshipId')->dropDownList(Yii::$app->common->getRelationship(), [
            'prompt' => '- Nationality -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-3 mt-2">
        <?= $form->field($address, 'StudGurdOccupation')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-3 mt-2">
        <?= $form->field($address, 'StudGuardEmailAddress')->textInput(['maxlength' => true]); ?>
    </div>
    <div class="col-md-3 mt-2">
        <?= $form->field($address, 'StudGurdHomeNo')->textInput(['maxlength' => true]); ?>
    </div>
    <div class="col-md-3 mt-2">
        <?= $form->field($address, 'StudGurdMobileNo')->textInput(['maxlength' => true]); ?>
    </div>
</div>

<div class="alert alert-warning mt-4" role="alert">
    <strong>Section C : Emergency Contact</strong>
</div>
<div class="row mt-2">

    <div class="col-md-6 mt-2">
        <?= $form->field($address, 'StudEmergName')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-6 mt-2">
        <?= $form->field($address, 'StudEmergRelationshipId')->dropDownList(Yii::$app->common->getRelationship(), [
            'prompt' => '- Nationality -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>

    <div class="col-md-4 mt-2">
        <?= $form->field($address, 'StudEmergHomeNo')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-4 mt-2">
        <?= $form->field($address, 'StudEmergMobileNo')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="col-md-4 mt-2">
        <?= $form->field($address, 'StudEmergOfficeNo')->textInput(['maxlength' => true]); ?>
    </div>

</div>
<div class="row">

    <?php if ($model->NationalityId == 28) { ?>
        <div class="alert alert-warning mt-4" role="alert">
            <strong>Data Required by KPT</strong>
        </div>


        <div class="col-md-4 mt-2">
            <?= $form->field($address, 'DunId')->dropDownList(Yii::$app->common->getDun(), [
                'prompt' => '- DUN -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>

        <div class="col-md-4 mt-2">
            <?= $form->field($address, 'ParlimenId')->dropDownList(Yii::$app->common->getParlimen(), [
                'prompt' => '- Parlimen -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>

        <div class="col-md-4 mt-2">
            <?= $form->field($address, 'FamilyIncomes')->textInput(['maxlength' => true]); ?>
        </div>



    <?php } ?>
    <div class="col-md-12 mt-3">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary w-md">Next</button>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>