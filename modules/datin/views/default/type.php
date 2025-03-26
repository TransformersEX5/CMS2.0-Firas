<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\Tbldatinproperty;
use app\models\Tblstatusai;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$typeId = $model->TypeId ?? 0;

$urlRedirect = Url::base() . $module . '/default';
$urlTypedetails = Url::base() . $module . '/default/typedetails';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {

    $("#TypeId").submit(function(event) 
    {
        event.preventDefault();

        var formData = $('#TypeId').serializeArray();

        if(($typeId == 0))
        {
            desc = 'Are you sure to register?';
            desc2 = 'You have successfully register the details!'
        }
        else
        {
            desc = 'Are you sure to update?';
            desc2 = 'You have successfully update the details!'
        }
        
        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
            .then(function(t) 
            {
                if (t.value) {
                    $.ajax({
                        url: '$urlTypedetails',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            typeId : '$typeId',
                            _csrf : '$_csrf',
                            formData : JSON.stringify(formData)
                        },
                        success: function(response) 
                        {
                            t.value&&Swal.fire({title:desc2,icon:"success",confirmButtonColor:"#34c38f",confirmButtonText:"Confirm"})
                            .then(function(t) 
                            {
                                window.location.href = '$urlRedirect';
                            });
                        },
                        error: function(xhr, status, error) 
                        {
                            Swal.fire({title:"Error!",text:"Please make sure there is no duplicate!",icon:"error"})                        
                        }
                    });
                } 
            });
    });
});
JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'TypeId']); ?>
    <div class="card-body mt-0">
        <div class="row">

            <h4 class="mb-3">TYPE DETAILS</h4>

            <div class="col-md-6 mb-2">
                <h6>Item</h6>
                <?= $form->field($model, 'TypeName')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><?php if (!isset($model->TypeId)) { ?>Register New Type<?php } else { ?>Update<?php } ?></button>
            </div>
        </div>
    </div> <?php ActiveForm::end(); ?>
</div>