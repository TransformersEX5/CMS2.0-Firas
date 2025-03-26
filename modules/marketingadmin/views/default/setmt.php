<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\modules\marketingadmin\models\tblstatusai;

?>

<?php

$MarketingTeamId = $model->MarketingTeamId;
$module = '/' . Yii::$app->controller->module->id;

$url = Url::base() . $module . '/default/set';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {

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
                        MarketingTeamId : '$MarketingTeamId',
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
            <h3><?= $model->MarketingTeam; ?></h3>
            <br>

            <div class="row">
                <div class='col-3 mb-3 d-flex align-items-end'>
                    <h6>Team Target</h6>
                </div>
                <div class='col-3 mb-3'>
                    <?php
                    echo $form->field($model, 'TeamTarget')
                        ->textInput([
                            'type' => 'number',
                            'class' => 'form-control text-dark border-dark', // Changed class names as appropriate
                            'required' => 'required',
                            'placeholder' => 'Please Enter' // Optional, but helpful for UX
                        ])
                        ->label(false);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class='col-3 mb-3 d-flex align-items-end'>
                    <h6>Marketing Team</h6>
                </div>
                <div class='col-3 mb-3 align-items-center'>
                    <?php
                    echo $form->field($model, 'StatusId')->dropDownList(
                        ArrayHelper::map(
                            tblstatusai::find()
                                ->select(['StatusId', 'Status'])
                                ->orderBy(['StatusId' => SORT_ASC])
                                ->asArray()
                                ->all(),
                            'StatusId',
                            'Status'
                        ),
                        ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required']
                    )->label(false);
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
    </div> <?php ActiveForm::end(); ?>
</div>