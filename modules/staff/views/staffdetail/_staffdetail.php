<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');
?>


<div class="col-12">

    <?php $form = ActiveForm::begin([
        'id' => 'followup',
        // 'enableAjaxValidation' => true,
    ]); ?>

    <div class="row">


        <div class="row">
            <div class="col col-lg-12 mt-2">
                <?= $form->field($model, 'FullName')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">

            <div class="col-4 mt-2">
                <?= $form->field($model, 'NationalityId')->dropDownList(Yii::$app->common->getNationality(), [
                    'prompt' => '-  Nationality   -',
                    'class' => 'form-select mb-2',
                    'id' => 'NationalityId'
                ]) ?>
            </div>

            <div class="col-4 mt-2">
                <?= $form->field($model, 'ICPassportNo')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-4 mt-2">

                <div class="input-group" id="datepicker2">
                    <?= $form->field($model, 'UserDOB')->textInput(['maxlength' => true, 'placeholder' => "dd-mm-yyyy", 'data-date-format' => "dd-mm-yyyy", 'data-provide' => "datepicker", 'data-date-autoclose' => "true", 'data-date-container' => "#datepicker2"]); ?>
                    <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-4 mt-2">
                <?= $form->field($model, 'Gender')->dropDownList(Yii::$app->common->getGender(), [
                    'prompt' => '-  Gender   -',
                    'class' => 'form-select mb-2',
                    'id' => 'GenderId'
                ]) ?>
            </div>

            <div class="col-4 mt-2">

                <?= $form->field($model, 'ReligionId')->dropDownList(Yii::$app->common->getReligion(), [
                    'prompt' => '-  Religion   -',
                    'class' => 'form-select mb-2',
                    'id' => 'ReligionId'
                ]) ?>
            </div>

        </div>


        <div class="row">



            <div class="col-4 mt-2">

                <?= $form->field($model, 'MaritalStatusId')->dropDownList(Yii::$app->common->getMarital(), [
                    'prompt' => '-  Marital Status   -',
                    'class' => 'form-select mb-2',
                    'id' => 'MaritalStatusId'
                ]) ?>
            </div>


            <div class="row">
                <div class="col-6 mt-2">
                    <?= $form->field($model, 'EmailAddress')->textInput(['maxlength' => true]) ?>
                </div>
            </div>


            <div class="row">
                <div class="col-6 mt-2">
                    <?= $form->field($model, 'PersonalEmail')->textInput(['maxlength' => true]) ?>
                </div>
            </div>


            <div class="col-6 mt-2">

                <?= $form->field($model, 'BranchId')->dropDownList(Yii::$app->common->getBranchName(), [
                    'prompt' => '-  Location    -',
                    'class' => 'form-select mb-2',
                    'id' => 'BranchId'
                ]) ?>
            </div>




        </div>
    </div>
</div>

<div class="form-group mt-3">

    <?php
    if ($pageUrl == 'followupview') {
        echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
    } else {
        echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning me-2', 'data-bs-dismiss' => 'modal']);
        echo Html::Button('Submit', ['class' => 'btn btn-success', 'id' => 'btnApply']);
    }
    ?>

</div>

<?php ActiveForm::end(); ?>





<?php


$js = <<< JS


 $(document).ready(function () {


$('#btnApply').click(function()  {

        var form = $('#followup');
        var formData = new FormData(form[0]);
    
        // $('#btnApply').button('loading');       

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) 
            {
                if(response.success)
                {
                    toastr.success('Your group has been successfully created');

                //close modal after success
                   $('#closeButton').click();
                }

                else
                {
                    $('.help-block').text('');
                    $('.has-error').removeClass('has-error');
                    
                    $.each(response, function (field, errors) {
                     //   alert(field+errors);

                        var hasErrorSpan = $('.field-tbldebtoraction-' + field.toLowerCase());
                        var errorSpan = $(':input[name="Tbldebtoraction[' + field + ']"]').closest('.form-group').find('.help-block');
                        errorSpan.text(errors.join(' '));
                        hasErrorSpan.addClass('has-error');
                    });
                }
            },
            error: function () 
            {
                //alert('hehe');
               /// window.location.reload();
            }
        });

    });
});

JS;
$this->registerJs($js);
?>