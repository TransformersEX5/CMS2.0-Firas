<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\Tbldatinproperty;
use app\models\Tblstatusai;

?>

<?php

$itemId = $model->ItemId ?? 0;
$typeId = $data[0]['TypeId'];
$statusId = $model->StatusId ?? 0;

$urlRedirect = Url::base() . '/datinproperty';
$urlItemdetails = Url::base() . '/datinproperty/itemdetails';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function () {
    if($statusId != 2)
    {
        $('.inactiveRemarks').hide();
    }

    $('.statusDropdown').change(function () {
        var selectedValue = $(this).val();
        if (selectedValue == 2) {
            $('.inactiveRemarks').show();
        } else {
            $('.inactiveRemarks').hide();
        }
    });

    $("#ItemDetailId").submit(function(event) 
    {
        event.preventDefault();

        var formData = $('#ItemDetailId').serializeArray();

        if(($itemId == 0))
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
                        url: '$urlItemdetails',
                        type: 'POST',
                        dataType: "json",
                        data: 
                        {
                            itemId : '$itemId',
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

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'ItemDetailId']); ?>
    <div class="card-body mt-0">
        <div class="row">

            <h4 class="mb-3">ITEM DETAILS</h4>

            <div class="col-md-6 mb-2">
                <h6>Type</h6>
                <?= $data[0]['TypeName']; ?>
            </div>

            <div class="col-md-6 mb-2">
                <h6>Name</h6>
                <?= $form->field($model, 'ItemName')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-6 mb-2">
                <h6>Due Date</h6>
                <?= $form->field($model, 'DueDate')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'date', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-6 mb-2">
                <h6>Status</h6>
                <?= $form->field($model, 'StatusId')->dropDownList(['1' => 'Active', '2' => 'Inactive'], ['prompt' => 'Please Select', 'class' => 'form-select text-dark border-dark statusDropdown', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-6 mb-2">
                <h6>Person In Charge</h6>
                <?= $form->field($model, 'PersonInCharge')->textarea(['rows' => 4, 'class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-6 mb-2">
                <h6>Remarks</h6>
                <?= $form->field($model, 'Remarks')->textarea(['rows' => 4, 'class' => 'form-control text-dark border-dark'])->label(false); ?>
            </div>

            <div class="col-md-12 mb-4 inactiveRemarks">
                <h6>Inactive Remarks</h6>
                <?= $form->field($model, 'InactiveRemarks')->textarea(['rows' => 4, 'class' => 'form-control text-dark border-dark'])->label(false); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><?php if (!isset($model->ItemId)) { ?>Register<?php } else { ?>Update<?php } ?></button>
            </div>

        </div>
    </div> <?php ActiveForm::end(); ?>
</div>