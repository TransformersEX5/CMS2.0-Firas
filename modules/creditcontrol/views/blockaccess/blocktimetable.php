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

    <h6>

        <div id="select_data"><?php echo 'Student Name : ' . yii::$app->request->get('name') ?></div>

        <div id="select_StatusName"><?php echo 'Status : ' . yii::$app->request->get('selectStatusName') ?></div>

        <div id="select_outs"><?php echo 'Amount Outs : ' . yii::$app->request->get('studouts') ?></div>

        <div id="select_aging"><?php echo 'Aging : ' . yii::$app->request->get('selectacademicaging') . ' days ' ?></div>
    </h6>


    <div class="row">
        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'DebtActionCatId')->dropDownList(Yii::$app->creditcontrol->getDebtActionCategory(), [
                'prompt' => '- Action/Follow-Up -',
                'class' => 'form-select mb-2'
            ]) ?>

        </div>

        <div class="row">
            <div class="col-md-6 mt-2">
                <?= $form->field($model, 'ActionRemarks')->textarea(['rows' => '3']) ?>
            </div>

            <div class="col-md-6 mt-2">
                <?= $form->field($model, 'FeedbackRemarks')->textarea(['rows' => '3']) ?>
            </div>
        </div>


        <div>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-6 mt-2">
                <?= $form->field($model, 'RemainderRemarks')->textarea(['rows' => '3']) ?>
            </div>

            <div class="col-md-6 mt-2">
                <?= $form->field($model, 'RemainderDate')->textInput(['type' => 'date']) ?>

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