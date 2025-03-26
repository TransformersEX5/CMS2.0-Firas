<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;
$UserId = base64_decode(Yii::$app->request->get('UserId'));

$urlApplication = Url::base() . $module . '/default/submitapplication';
$_csrf = Yii::$app->request->getCsrfToken();

$mode = Yii::$app->request->get('mode') ?? '';
$urlbase = Url::base() . '/web/';

$AgentApplicationStatusId = $model->AgentApplicationStatusId;

$script = <<<JS

$(document).ready(function() 
{
    var mode = '$mode';

    if(mode != 'view')
    {
        var AgentApplicationStatusId = '$AgentApplicationStatusId';
        if (AgentApplicationStatusId != 3)
        {
            desc = 'Sorry. You are not allowed to edit anymore!';

            Swal.fire({ html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>'+desc+'</h4></div></div>', allowOutsideClick: !1, showConfirmButton: !0, confirmButtonClass: "btn btn-primary w-xs mb-1 me-2", confirmButtonText: "Confirm", buttonsStyling: !1 })
            .then(function(t) 
            { 
                if (t.value)
                {
                    self.close();
                }
            });
        }
    }

    $('input[name="formRadios"]').change(function(){
        if($(this).attr('id') === 'formRadios1' && $(this).is(':checked')) {
            $('#eventNum').show();
        } else {
            $('#eventNum').hide();
        }
    });

    $('#btnSubmit').click(function()
    {
        event.preventDefault();

        var UserId = '$UserId';
        var form = $('#AgentApplicationId');
        var formData = new FormData(form[0]);

        if(mode != 'view')
        {
            desc = 'Are you sure to submit?';
            desc2 = 'You have successfully submit the details!'
        }
        else
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully update the details!'
        }

        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
        .then(function(t) 
        {

            // console.log([...formData]);
            $.ajax({
                url: '$urlApplication?UserId='+UserId,
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) 
                {
                    if(response.success)
                    {
                        t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                        .then(function(t) 
                        { 
                            if (t.value)
                            {
                                window.close();
                            }
                        });
                    }
                    else
                    {
                        $.each(response, function (field, errors) {

                        var hasErrorSpan = $('.field-tblusertest-' + field.toLowerCase());
                        var errorSpan = $(':input[name="Tblusertest[' + field + ']"]').closest('.form-group').find('.help-block');
                        errorSpan.text(errors.join(' '));
                        hasErrorSpan.addClass('text-danger');
                        });
                        
                        alert('Please make sure to fill in all the blanks!');
                    }
                },
                error: function () 
                {

                }
            });
        });
    });

    $(document).on('click', '.downloadDoc', function() 
    {
        var urlbase = '$urlbase';
        var AgentDocName = urlbase+($(this).data('agentdocname'));
        var AgentDocNameArray = AgentDocName.split(',');

        var downloadLink = document.createElement('a');
        downloadLink.setAttribute('href', AgentDocNameArray[0]);
        downloadLink.setAttribute('download', AgentDocNameArray[1]);
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });

});

JS;
$this->registerJs($script);

?>

<style>
    #cmstable1 tr td {
        font-family: 95%/1.1em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
        margin: 0.5em;
        padding: 0.5em;
        border-style: 1px solid #000;
        color: #333;
        vertical-align: middle;
    }
</style>

<div class="col-12">
    <div class="card"><?php $form = ActiveForm::begin(['id' => 'AgentApplicationId', 'options' => ['onsubmit' => 'return false;', 'enctype' => 'multipart/form-data']]); ?>
        <div class="card-body">
            <div class="col-12 mb-3">
                <img src="<?= Url::base() ?>/image/city_logo_white.png" style="display:block; margin:0 auto; width:20%; height:auto;">

                <h3 style="text-align:center;"><b>AGENT APPLICATION FORM</b></h3>
                <br>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Registered Business Name</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'FullName')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Nature of Business</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentNatureOfBusiness')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Company Registration Number</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'ICPassportNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Business Address</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentBusinessAddress')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Business Contact Number</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'HandSetNo')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Business Email Address</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'EmailAddress')->textInput(['class' => 'form-control text-dark border-dark', 'readonly' => true])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Website/Social Media Account</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentSocialMedia')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Person in Charge</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentPIC')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Number of years in Business</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentYearsInBusiness')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Number of staff/Reps</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentNumberOfStaffs')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Recruitment Branches (if any)</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentRecruitmentBranch')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Which Country(s) you prefer</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentPreferredCountry')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Focused Country</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentFocusedCountry')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Any Specific Interested Program</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentInterestedProgram')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Does your company organize student recruitment events?</h6>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <input class="form-check-input" type="radio" name="formRadios" id="formRadios1" <?php if ($model->AgentNumberOfEvent != '') { ?>checked<?php } ?> required>
                                    <label class="form-check-label" for="formRadios1">
                                        YES
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-check-input" type="radio" name="formRadios" id="formRadios2" required>
                                    <label class="form-check-label" for="formRadios2">
                                        NO
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="eventNum" class="col-md-12 mb-3" <?php if ($model->AgentNumberOfEvent == '') { ?>style="display: none;" <?php } ?>>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Please specify number of events per annum and to attach upcoming proposed events (if any)</h6>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <?= $form->field($model, 'AgentNumberOfEvent')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required'])->label(false); ?>
                        </div>

                        <?php if ($mode != 'view') { ?>
                            <div class="col-md-6 d-flex align-items-center">
                                <?= $form->field($model2, 'AgentDocName[]')->fileInput(['id' => 'event', 'multiple' => true])->label(false) ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h3 class="mt-5">BANK ACCOUNT DETAILS</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Bank Name</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentBankName')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Account Number</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentBankAccountNumber')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Branch</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentBankBranch')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Country</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentBankCountry')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-5">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <h6>Swift Code</h6>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'AgentBankSwiftCode')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
                        </div>
                    </div>
                </div>

                <?php if ($mode != 'view') { ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8 d-flex align-items-center">
                                <h6>Please provide us other information that you may find relevant and helpful to proceed with Application/Agreement/Contract/ Marketing plan etc.</h6>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 mb-5">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <?= $form->field($model2, 'AgentDocName[]')->fileInput(['id' => 'support', 'multiple' => true])->label(false) ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php
            if ($mode == 'view') {

                $sql = "SELECT
                UserId, AgentDocName, SUBSTRING_INDEX(AgentDocName, '/', -1) AS DocName                    
                FROM tblagentdocument
                WHERE UserId = " . $UserId;

                $data = \Yii::$app->db->createCommand($sql)->queryAll();


                if (!empty($data)) {
                    $i = 1;
            ?>
                    <div class="col-md-12 mb-5">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="cmstable1" border="1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center;">No.</th>
                                                    <th>Document</th>
                                                    <th style="text-align:center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data as $row) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align:center;"><?= $i; ?></td>
                                                        <td><?= $row['DocName']; ?></td>
                                                        <td style="text-align:center;"><button type="button" class="btn btn-primary downloadDoc" data-agentdocname="<?= $row['AgentDocName'] . ',' . $row['DocName']; ?>">Download</button></td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                            <h6>Application Status</h6>
                        </div>
                    <div class="col-md-2">
                    <?= $form->field($model, 'AgentApplicationStatusId')->dropDownList(['1' => 'Accept', '2' => 'Rejected', '3' => 'Waiting for Approval'], ['class' => 'form-control text-dark border-dark', 'prompt' => 'Please Select', 'required' => 'required'])->label(false); ?>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8 d-flex justify-content-end">
                        <button type="button" id="btnSubmit" class="btn btn-primary"><?php if ($mode != 'view') { ?>Submit<?php } else { ?>Update<?php } ?></button>
                    </div>
                </div>
            </div>

        </div><?php ActiveForm::end(); ?>
    </div>
</div>