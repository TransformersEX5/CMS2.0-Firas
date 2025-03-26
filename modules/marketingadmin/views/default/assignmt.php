<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\db\Expression;

use app\models\tbluser;
use app\modules\marketingadmin\models\Tblmarketingteam;
use app\modules\marketingadmin\models\Tblsalary;

?>

<?php

$UserId = $model->UserId;
$module = '/' . Yii::$app->controller->module->id;

$url = Url::base() . $module . '/default/assign';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {

    $('#tbluser-targetno').on('input', function() {
        var inputValue = $(this).val();
        if (inputValue.length > 2) {
            $(this).val(inputValue.slice(0, 2)); // Limit input to first two characters
        }
    });

$("#AssignMTId").submit(function(event) 
{
    event.preventDefault();

    var formData = $('#AssignMTId').serializeArray();

    desc = 'Are you sure to update?';
    desc2 = 'You have successfully update the details!'

    Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
        .then(function(t) 
        {
            if (t.value) {
                $.ajax({
                    url: '$url',
                    type: 'POST',
                    dataType: "json",
                    data: 
                    {
                        UserId : '$UserId',
                        _csrf : '$_csrf',
                        formData : JSON.stringify(formData)
                    },
                    success: function(response) 
                    {
                        t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                        .then(function(t) 
                            { 
                                if (t.value)
                                {

                                    btnClose.click();
                                }
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
});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['Id' => 'AssignMTId']); ?>
    <div class="card-body mt-0">
        <div class='col-12 mb-3'>
            <h3><?= $model->FullName; ?></h3>
            <br>

            <div class="row">
                <div class='col-3 mb-3 d-flex align-items-end'>
                    <h6>Individual Target</h6>
                </div>
                <div class='col-3 mb-3'>
                    <?php
                    echo $form->field($model, 'TargetNo')
                        ->textInput([
                            'type' => 'number',
                            'class' => 'form-control text-dark border-dark', // Changed class names as appropriate
                            'required' => 'required',
                            'placeholder' => 'Please Enter', // Optional, but helpful for UX
                        ])
                        ->label(false);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class='col-3 mb-3 d-flex align-items-end'>
                    <h6>Marketing Team</h6>
                </div>
                <div class='col-9 mb-3'>
                    <?php
                    echo $form->field($model, 'MarketingTeamId')->dropDownList(
                        ArrayHelper::map(
                            tblmarketingteam::find()
                                ->select(['MarketingTeamId', 'MarketingTeam'])
                                ->where(['StatusId' => 1])
                                ->orderBy(['MarketingTeam' => SORT_ASC])
                                ->asArray()
                                ->all(),
                            'MarketingTeamId',
                            'MarketingTeam'
                        ),
                        ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required']
                    )->label(false);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class='col-3 mb-3 d-flex align-items-end'>
                    <h6>Salary Range</h6>
                </div>
                <div class='col-9 mb-3'>
                    <?php
                    echo $form->field($model, 'SalaryId')->dropDownList(
                        ArrayHelper::map(
                            tblsalary::find()
                                ->select(['SalaryId', new Expression("CONCAT(SalaryCode, ' - ', SalaryRange) AS SalaryRange")])
                                ->orderBy(['SalaryId' => SORT_ASC])
                                ->asArray()
                                ->all(),
                            'SalaryId',
                            'SalaryRange'
                        ),
                        ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required']
                    )->label(false);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class='col-12 mb-3'>
        <div class="modal-footer">
            <button id="btnClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div> <?php ActiveForm::end(); ?>
</div>