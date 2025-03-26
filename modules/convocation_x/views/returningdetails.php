<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Tblconvocationdetails;
use app\models\Tblstatusai;

?>

<?php

$urlReturningstuddetails = Url::base() . '/admin/returningstuddetails';
$urlReturningdetails = Url::base() . '/admin/returningdetails';
$urlRedirect = Url::base() . '/admin/returning';
$_csrf = Yii::$app->request->getCsrfToken();

$branch = Yii::$app->request->get('branch');
$programregId = Yii::$app->request->get('programregId');
$convoregId = Yii::$app->request->get('convoregId');

$aa = $model->ConvoRegId ?? 0;


$script = <<< JS

$(document).ready(function() 
{
    $("#ProgramRegId").submit(function(event) 
    {
        event.preventDefault();

        var formData = $('#ProgramRegId').serializeArray();
        var convoregId = '$aa';
        var desc;
        var desc2;

        if(convoregId == 0)
        {
            desc = 'Are you sure to register?';
            desc2 = 'You have successfully register the student!'
        }
        else
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully update the details!'
        }
        
        Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#ffcc00,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc+'</h4></div></div>', showCancelButton: !0, showConfirmButton: !0, cancelButtonClass: "btn btn-danger w-xs mb-1", confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", cancelButtonText: "Cancel", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0
            }).then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlReturningdetails',
                        type: 'GET',
                        dataType: "json",
                        data: 
                        {
                            check : true,
                            branch : '$branch',
                            programregId : '$programregId',
                            convoregId : '$convoregId',
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
                            alert('Error');
                        }
                    });
                } 
            });
    });
});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'ProgramRegId']); ?>
    <div class="card-body">
        <div class="row">

            <h4 class="mb-3">RETURNING STUDENT DETAILS</h4>

            <div class="col-md-4 mb-2">
                <h6>Name</h6>
                <?= $data[0]['StudName']; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>NRIC/Passport No.</h6>
                <?= $data[0]['StudNRICPassportNo']; ?>
            </div>
            
            <div class="col-md-4 mb-2">
                <h6>Student No.</h6>
                <?= $data[0]['StudentNo']; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Program</h6>
                <?= $data[0]['ProgramCode'] . ' - ' . $data[0]['ProgramName']; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Status</h6>
                <?= $data[0]['StatusName']; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Convocation Year</h6>
                <?= $dataConvo->ConvoYear; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Alumni Registration</h6>
                <?= $data[0]['AlumniStatus']; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Tracer Study</h6>
                <?= $data[0]['TracerStudy']; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Attendance</h6>
                <?= $form->field($model, 'ConvoAttend')->dropDownList(['1' => 'Attend', '2' => 'Not Attend'], ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-12 mb-4">
                <h6>Remarks</h6>
                <?= $form->field($model, 'Remarks')->textarea(['rows' => 4, 'class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><?php if(!isset($model->ConvoRegId)){ ?>Register<?php }else{ ?>Update<?php } ?></button>
            </div>

            <?php ActiveForm::end(); ?>
        </div>