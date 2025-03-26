<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\convocation\models\Tblconvocationdetails;
use app\modules\convocation\models\Tblstatusai;

?>

<?php

$ConvoId = Yii::$app->request->get('convoId');

$module = '/'.Yii::$app->controller->module->id;

$urlConvocationdetails = Url::base() . $module.'/default/convocationdetails';
$urlRedirect = Url::base() . $module.'/default';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function() 
{
    var ConvoId = '$ConvoId';

    $("#ConvoDetailsId").submit(function(event) 
    {
        event.preventDefault();

        if(ConvoId == 0)
        {
            desc = 'Are you sure to register?';
            desc2 = 'You have successfully register the details!'
        }
        else
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully update the details!'
        }

        var formData = $('#ConvoDetailsId').serializeArray();
        
        Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#ffcc00,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc+'</h4></div></div>', showCancelButton: !0, showConfirmButton: !0, cancelButtonClass: "btn btn-danger w-xs mb-1", confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", cancelButtonText: "Cancel", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0
            }).then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlConvocationdetails',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            convoId : '$convoId',
                            _csrf : '$_csrf',
                            formData : JSON.stringify(formData)
                        },
                        success: function(response) 
                        {
                            Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc2+'</h4></div></div>', allowOutsideClick: !1, showConfirmButton: !0, confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1 })
                            .then(function(t) 
                            { 
                                if (t.value)
                                {
                                    window.location.href = '$urlRedirect'; 
                                }
                            });
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please make sure there is only one active status!');
                        }
                    });
                } 
            });
    });
});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'ConvoDetailsId']); ?>
    <div class="card-body">
        <div class="row">

            <h4 class="mb-3">CONVOCATION DETAILS</h4>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoYear')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoTelNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoEmail')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoDate')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoVenue')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoTimeStart')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'time', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoTimeEnd')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'time', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoFee')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'RobeDeposit')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'RobeNonReturnFee')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'MaxGuests')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoPortalOpen')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-4">
                <?= $form->field($model, 'ConvoStatus')->dropDownList(ArrayHelper::map(Tblstatusai::find()->asArray()->all(), 'StatusId', 'Status'), ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark']); ?>
            </div>

            <hr>

            <h4 class="mb-3">BRIEFING DETAILS</h4>

            <div class="col-md-6 mb-2">
                <?= $form->field($model, 'BriefDate')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date', 'required' => 'required']) ?>
            </div>

            <div class="col-md-6 mb-2">
                <?= $form->field($model, 'BriefVenue')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?>
            </div>

            <div class="col-md-6 mb-2">
                <?= $form->field($model, 'BriefTimeStart')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'time', 'required' => 'required']) ?>
            </div>

            <div class="col-md-6 mb-4">
                <?= $form->field($model, 'BriefTimeEnd')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'time', 'required' => 'required']) ?>
            </div>

            <hr>

            <h4 class="mb-3">REHEARSAL DETAILS</h4>

            <div class="col-md-6 mb-2">
                <?= $form->field($model, 'RehearsalTime')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'time', 'required' => 'required']) ?>
            </div>

            <div class="col-md-6 mb-2">
                <?= $form->field($model, 'RehearsalVenue')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <!-- <?= $form->field($model, 'RobeDeposit')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?> -->
            </div>

            <div class="col-md-4 mb-4">
                <!-- <?= $form->field($model, 'RobeDeposit')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?> -->
            </div>

            <hr>

            <h4 class="mb-3">TRACER STUDY DETAILS</h4>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoTracerDateStart')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-2">
                <?= $form->field($model, 'ConvoTracerDateEnd')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date', 'required' => 'required']) ?>
            </div>

            <div class="col-md-4 mb-4">
                <?= $form->field($model, 'ConvoMOHE')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><?php if ($convoId == 0) { ?>Insert<?php } else { ?>Update<?php } ?></button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>