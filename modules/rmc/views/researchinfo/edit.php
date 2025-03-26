<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tblrmcstatus;
use app\models\tblrmcinformation;

?>

<?php

$RMCInformationId = Yii::$app->request->get('RMCInformationId');
$RMCId = Yii::$app->request->get('RMCId');

$module = '/' . Yii::$app->controller->module->id;

$urlCreate = Url::base() . $module . '/researchinfo/edit';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$(document).ready(function () {
    $("#RMCInformationId").submit(function(event) {
        event.preventDefault();
        
        var RMCInformationId = '$RMCInformationId';
        var formData = $('#RMCInformationId').serializeArray();
        var RMCId = '$RMCId';

        if(RMCId) {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully updated the project title!';
        } else {
            desc = 'Are you sure to submit?';
            desc2 = 'You have successfully submitted the project title!';
        }
        
        Swal.fire({title: desc,icon: "warning",showCancelButton: true,confirmButtonColor: "#34c38f",cancelButtonColor: "#f46a6a",confirmButtonText: "Confirm"})
            .then(function(t)
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlCreate',
                        type: 'POST',
                        dataType: "json",
                        data:
                        {
                            RMCInformationId: RMCInformationId,
                            RMCId: RMCId,
                            formData: JSON.stringify(formData),
                            _csrf: '$_csrf',
                        },
                        success: function(response)
                        {
                            Swal.fire({title: desc2,icon: "success",confirmButtonColor: "#34c38f",confirmButtonText: "Confirm"})
                            .then(function() {
                                // Refresh the research details after success
                                $("#refreshresearch").load(location.href + " #refreshresearch");
                            });
                        },
                        error: function(xhr, status, error) {
                            alert('Please contact the programmer for more details!');
                    }
                });
            } 
        });
    });

    // Refresh research details when the modal is closed
    $('.modal').on('hidden.bs.modal', function () {
        $("#refreshresearch").load(location.href + " #refreshresearch");
    });
});


JS;
$this->registerJs($script);

?>

<div class="col-12">
    <?php
    $form = ActiveForm::begin(['id' => 'RMCInformationId']);
    ?>

    <div class="card-body mt-0">
        <div class="row">
            <!-- Cluster Selection -->
            <div class="mb-3">
                <?= $form->field($model, 'RMCClusterId')->dropDownList(
                    $clusters, // This now contains ['RMCClusterId' => 'RMCCluster Name']
                    ['class' => 'form-control', 'prompt' => 'Select Cluster', 'required' => true]
                )->label('Cluster of Research:') ?>
            </div>

            <!-- Field of Research -->
            <div class="mb-3">
                <?= $form->field($model, 'RMCInformationFieldOfResearch')->textInput(['maxlength' => true, 'type' => 'text', 'id' => 'Field', 'required' => true])->label('Field of Research:') ?>
            </div>

            <!-- Duration -->
            <div class="mb-3 row align-items-center">
                <?= $form->field($model, 'RMCInformationResearchDuration')->textInput(['maxlength' => true, 'type' => 'text', 'id' => 'Duration', 'required' => true])->label('Duration of Research:') ?>
            </div>

            <!-- Start & End Date -->
            <div class="mb-3 row">
                <div class="col-md-6">
                    <?= $form->field($model, 'RMCInformationStartDate')->textInput(['maxlength' => true, 'type' => 'date', 'id' => 'StartDate', 'required' => true])->label('Start Date:') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'RMCInformationEndDate')->textInput(['maxlength' => true, 'type' => 'date', 'id' => 'EndDate', 'required' => true])->label('End Date:') ?>
                </div>
            </div>

            <!-- Location -->
            <div class="mb-3">
                <?= $form->field($model, 'RMCInformationResearchLocation')->textInput(['maxlength' => true, 'type' => 'text', 'id' => 'Location', 'required' => true])->label('Information Research Location:') ?>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <?php if ($RMCInformationId) { ?>Update<?php } else { ?>Update<?php } ?>
                </button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>