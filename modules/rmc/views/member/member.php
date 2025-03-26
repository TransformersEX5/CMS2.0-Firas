<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tblrmcstatus;

?>

<?php

$RMCId = base64_decode(Yii::$app->request->get('RMCId'));

$module = '/' . Yii::$app->controller->module->id;

$urlCreate = Url::base() . $module . '/member/create';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {
    $("#RMCMemberId").submit(function(event) 
    {
        event.preventDefault();

        var RMCId = '$RMCId';
        var formData = $('#RMCMemberId').serializeArray();

        if(RMCMemberId)
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully udpate the project title!'
        }
        else
        {
            desc = 'Are you sure to submit?';
            desc2 = 'You have successfully submit the project title!'
        }
        
        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlCreate',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            RMCId : RMCId,
                            formData : JSON.stringify(formData),
                            _csrf : '$_csrf',
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                            .then(function(t) 
                            {

                            });
                        },
                        error: function(xhr, status, error) 
                        {
                            alert('Please contact the programmer for more details!');
                        }
                    });
                } 
            });
    });


    $(document).on('change', '.group1 input[type="checkbox"]', function() {
        $('.group1 input[type="checkbox"]').not(this).prop('checked', false);
    });

    $(document).on('change', '.group2 input[type="checkbox"]', function() {
        $('.group2 input[type="checkbox"]').not(this).prop('checked', false);
    });

    $(".StatusServiceDate").on("change", function () {

        var labelText = $("label[for='" + $(this).attr("id") + "']").text().trim();
        var allUnchecked = $(".StatusServiceDate:checked").length === 0;
        
        if (allUnchecked)
        {
            $("#txtAppointmentDate").hide();
            $("#txtExpiryDate").hide();
        }
        else
        {
            if ($(this).is(":checked") && labelText  === "Permanent")
            {
                $("#txtAppointmentDate").show();
                $("#txtExpiryDate").hide();
            }
            else
            {
                $("#txtAppointmentDate").hide();
                $("#txtExpiryDate").show();
            }   
        }
    });
});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'RMCMemberId']); ?>
    <div class="card-body mt-0">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h6>Name</h6>
                <?= $form->field($model, 'RMCMemberName')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-3 mb-4">
                <h6>Mykad No./Passport No.</h6>
                <?= $form->field($model, 'RMCPassportNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-3 mb-4">
                <h6>Staff No.</h6>
                <?= $form->field($model, 'RMCStaffNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-6 mb-4">
                <h6>Academic Qualification (PhD/Master/Degree)</h6>
                <?= $form->field($model, 'RMCAcademicQualification')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-6 mb-2">
                <h6>Designation (Please tick [✓])</h6>

                <div class="row group1">
                    <?php foreach ($checkboxItems as $rows) { ?>
                        <div class="col-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="firstCheck<?= $rows['RMCDesignationId'] ?>"
                                    name="tblrmcdesignation[RMCDesignationId][]"
                                    value="<?= $rows['RMCDesignationId'] ?>">
                                <label for="firstCheck<?= $rows['RMCDesignationId'] ?>"><?= $rows['RMCDesignation'] ?></label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-8 mb-4">
                <h6>Faculty/Institute/Centre/Academy (Please provide full address)</h6>
                <?= $form->field($model, 'RMCFaculty')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-4 mb-4">
                <h6>Mobile Phone No.</h6>
                <?= $form->field($model, 'RMCMobileNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-4 mb-4">
                <h6>E-mail Address</h6>
                <?= $form->field($model, 'RMCEmailAddress')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-5 mb-4">
                <h6>Status of Service (Please tick [✓])</h6>

                <div class="row group2">
                    <?php foreach ($checkboxItems2 as $rows) { ?>
                        <div class="col-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input StatusServiceDate" type="checkbox"
                                    id="secondCheck<?= $rows['RMCServiceStatusId'] ?>"
                                    name="tblrmcservice[RMCServiceStatusId][]"
                                    value="<?= $rows['RMCServiceStatusId'] ?>">
                                <label for="secondCheck<?= $rows['RMCServiceStatusId'] ?>"><?= $rows['RMCServiceStatus'] ?></label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-3 mb-4" id="txtAppointmentDate" style="display: none;">
                <h6>Date of Appointment</h6>
                <?= $form->field($model, 'RMCAppointmentDate')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date'])->label(false) ?>
            </div>

            <div class="col-md-3 mb-4" id="txtExpiryDate" style="display: none;">
                <h6>Contract Expiry Date</h6>
                <?= $form->field($model, 'RMCContractExpiryDate')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date'])->label(false) ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>
    </div> <?php ActiveForm::end(); ?>
</div>