<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\tblrmcstatus;

?>

<?php

$RMCId = Yii::$app->request->get('RMCId');

$module = '/' . Yii::$app->controller->module->id;

$urlCreate = Url::base() . $module . '/default/create';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {
    $("#RMCId").submit(function(event) 
    {
        event.preventDefault();
        

        var RMCId = '$RMCId';
        var formData = $('#RMCId').serializeArray();

        if(RMCId)
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
});

JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'RMCId']); ?>
    <div class="card-body mt-0">
        <div class="row">
            <div class="col-md-9 mb-2">
                <h6>Research Project Title</h6>
                <?= $form->field($model, 'RMCTitle')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-3 mb-2">
                <h6>Status</h6>
                <?= $form->field($model, 'StatusId')->dropDownList(ArrayHelper::map(tblrmcstatus::find()->orderBy(['Status' => SORT_ASC])->asArray()->all(), 'StatusId', 'Status'), ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><?php if($RMCId){ ?>Update<?php }else{ ?>Submit<?php } ?></button>
            </div>

        </div>
    </div> <?php ActiveForm::end(); ?>
</div>