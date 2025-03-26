<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\tblconvocationrobe;

?>

<?php

$urlStuddetails = Url::base() . '/admin/studdetails';
$urlRedirect = Url::base() . '/admin/student';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function() 
{
    $("#ConvoRegId").submit(function(event) 
    {
        event.preventDefault();

        var formData = $('#ConvoRegId').serializeArray();
        
        Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#ffcc00,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Are you sure to update?</h4></div></div>', showCancelButton: !0, showConfirmButton: !0, cancelButtonClass: "btn btn-danger w-xs mb-1", confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", cancelButtonText: "Cancel", confirmButtonText: "Confirm", buttonsStyling: !1, showCloseButton: 0
            }).then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlStuddetails',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            convoRegId : '$convoRegId',
                            _csrf : '$_csrf',
                            formData : JSON.stringify(formData)
                        },
                        success: function(response) 
                        {
                            Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>You have successfully update the details!</h4></div></div>', allowOutsideClick: !1, showConfirmButton: !0, confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1 })
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
                            // alert('Please make sure there is only one active status!');
                        }
                    });
                } 
            });
    });
});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'ConvoRegId']); ?>
    <div class="card-body">
        <div class="row">

            <h4 class="mb-3">STUDENT DETAILS</h4>

            <div class="col-md-4 mb-2">
            <h6>Name</h6>
            <?= $model->StudName; ?>
            </div>

            <div class="col-md-4 mb-2">
            <h6>NRIC/Passport No.</h6>
            <?= $model->StudNRICPassportNo; ?>
            </div>

            <div class="col-md-4 mb-2">
            <h6>Student No.</h6>
            <?= $model->StudentNo; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Convocation Year</h6>
                <?= $model->ConvoGraduateYear; ?>
            </div>

            <div class="col-md-4 mb-2">
                <h6>Attendance:</h6>
                <?= $form->field($model, 'ConvoAttend')->dropDownList(['1' => 'Attend', '2' => 'Not Attend'], ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-4 mb-4">
                <h6>Robe Size:</h6>
                <?= $form->field($model, 'RobeId')->dropDownList(ArrayHelper::map(tblconvocationrobe::find()->asArray()->all(), 'RobeId', 'Robesize'), ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>