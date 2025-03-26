<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tblrmcstatus;
use app\models\tblrmcdocument;
use app\models\Tblrmcsummary

?>

<?php

$RMCSummaryId = Yii::$app->request->get('RMCSummaryId');
$RMCId = Yii::$app->request->get('RMCId');

$module = '/' . Yii::$app->controller->module->id;

$urlCreate = Url::base() . $module . '/executive/edit';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$(document).ready(function () {
    $("#RMCSummaryId").submit(function(event) 
    {
        event.preventDefault();
        

        var RMCSummaryId = '$RMCSummaryId';
        var formData = $('#RMCSummaryId').serializeArray();
        var RMCId = '$RMCId';
// alert(RMCId);
        if(RMCId)
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully update the project title!'
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
                            RMCSummaryId : RMCSummaryId,
                            RMCId : RMCId,
                            formData : JSON.stringify(formData),
                            _csrf : '$_csrf',
                        },
                        success: function(response) 
                        {
                            Swal.fire({title: desc2,icon: "success",confirmButtonColor: "#34c38f",confirmButtonText: "Confirm"})
                            .then(function() {
                                // Refresh the executive details after success
                                $("#refreshexecutive").load(location.href + " #refreshexecutive");
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

    // Refresh executive details when the modal is closed
    $('.modal').on('hidden.bs.modal', function () {
        $("#refreshexecutive").load(location.href + " #refreshexecutive");
    });
});

JS;
$this->registerJs($script);

?>

<div class="col-12">
    <?php
    $form = ActiveForm::begin(['id' => 'RMCSummaryId']);
    ?>

    <div class="card-body mt-0">
        <div class="row">
            <?= $form->field($model, 'RMCSummaryBackground')->textarea([
                'rows' => 2, // Adjust height
                'id' => 'Field',
                'required' => true,
                'style' => 'width: 97%;' // Adjust width (100% means full width of the container)
            ])->label('Research background including Hypothesis/Research Questions and Literature Reviews') ?>
            <?= $form->field($model, 'RMCSummaryResearchObjective')->textarea([
                'rows' => 2, // Adjust the height
                'id' => 'Field',
                'required' => true,
                'style' => 'width: 97%;' // Adjust width (100% means full width of the container)
            ])->label('<br>Research Objective(s): <br> The general objective of this study is to') ?>
            <p><br>The specific objectives are:</p>
            <div class="row">
                <div class="mb-3 d-flex align-items-center">
                    <label class="me-2">1)</label>
                    <?= $form->field($model, 'RMCSummarySpecificObjective1', ['options' => ['class' => 'flex-grow-1']])
                        ->textInput(['maxlength' => true, 'required' => true])
                        ->label(false) ?>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label class="me-2">2)</label>
                    <?= $form->field($model, 'RMCSummarySpecificObjective2', ['options' => ['class' => 'flex-grow-1']])
                        ->textInput(['maxlength' => true, 'required' => true])
                        ->label(false) ?>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label class="me-2">3)</label>
                    <?= $form->field($model, 'RMCSummarySpecificObjective3', ['options' => ['class' => 'flex-grow-1']])
                        ->textInput(['maxlength' => true, 'required' => true])
                        ->label(false) ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'RMCSummaryReseachPublication')->textInput([
                        'maxlength' => true,
                        'type' => 'text',
                        'id' => 'Field',
                        'required' => true,
                        'style' => 'width: 100%;'
                    ])->label('Research Publications (Please state expected date of publication in journals):') ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'RMCSummaryFinding')->textInput([
                        'maxlength' => true,
                        'type' => 'text',
                        'id' => 'Field',
                        'required' => true,
                        'style' => 'width: 100%; margin-top: 20px;'
                    ])->label('Novel theories/New findings/Knowledge:') ?>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <?= $form->field($model, 'RMCSummaryPotentialApplication')->textInput([
                        'maxlength' => true,
                        'type' => 'text',
                        'id' => 'Field',
                        'required' => true,
                        'style' => 'width: 100%;'
                    ])->label('<br><br>Potential Application:') ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'RMCSummaryNoOfGraduate')->textInput([
                        'maxlength' => true,
                        'type' => 'text',
                        'id' => 'Field',
                        'required' => true,
                        'style' => 'width: 100%;'
                    ])->label('<br>Number of PhD and Masters (by research) graduated:') ?>
                </div>
                <p><br>Research Methodology (Please state Description of Methodology, Flow Chart of Research Activities (as
                Appendix), Gantt Chart of Research Activities, Milestones and Dates)(Please include attachments if
                necessary)</p>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <?php if ($RMCSummaryId) { ?>Update<?php } else { ?>Update<?php } ?>
                </button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>