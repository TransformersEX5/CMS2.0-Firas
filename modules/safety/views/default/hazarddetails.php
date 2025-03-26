<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\modules\datin\models\tblsafety;
// use app\models\Tblstatusai;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;
$safetyId = Yii::$app->request->get('safetyId');

$urlCreate = Url::base() . $module . '/default/create?safetyId=';

$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function() 
{
    $('#btnSubmit').click(function()
    {
        var safetyId = '$safetyId';
        var uploadFile = $('input[type=file]').get(0).files[0];;

        event.preventDefault();

        var form = $('#HazardId');
        var formData = new FormData(form[0]);

        desc = 'Are you sure to upload?';
        desc2 = 'You have successfully upload the document!'

        Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
        .then(function(t) 
        {
            if (t.isConfirmed) {
                $.ajax({
                    url: '$urlCreate'+safetyId,
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
                                    btnClose.click();
                                }
                            });
                        }
                        else
                        {
                            $.each(response, function (field, errors) {
                            var hasErrorSpan = $('.field-tblsafety-' + field.toLowerCase());
                            var fieldModified =  (field == 'file_name') ? '[' + field + '][]' :  '[' + field + ']';
                            var errorSpan = $(':input[name="Tblsafety' + fieldModified + '"]').closest('.form-group').find('.help-block');
                            errorSpan.text(errors.join(' '));
                            hasErrorSpan.addClass('text-danger');
                            });

                            $.each(response, function (field, errors) {
                            var hasErrorSpan = $('.field-tblsafetyimage-' + field.toLowerCase());
                            var fieldModified =  (field == 'file_name') ? '[' + field + '][]' :  '[' + field + ']';
                            var errorSpan = $(':input[name="Tblsafetyimage' + fieldModified + '"]').closest('.form-group').find('.help-block');
                            errorSpan.text(errors.join(' '));
                            hasErrorSpan.addClass('text-danger');
                            });
                        }
                    },
                    error: function () 
                    {
                    }
                });
            } 
            else 
            {
            }
        });
    });
});


JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'HazardId']); ?>
    <div class="card-body mt-0">
        <div class="row">
            <div class="col-md-12 mb-3 form-group">
                <h6>Description Of The Hazard</h6>
                <?= $form->field($model, 'SafetyDesc')->textarea(['rows' => 4, 'class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-12 mb-3 form-group">
                <h6>Specific Location</h6>
                <?= $form->field($model, 'SafetyLocation')->textInput(['class' => 'form-control text-dark border-dark', 'required' => 'required'])->label(false); ?>
            </div>

            <div class="col-md-12 mb-3">
                <h6>*JPEG, JPG, and PNG formats only</h6>
            </div>

            <div class="col-md-12 mb-1 form-group">
                <h6>Upload Pictures</h6>
                <?= $form->field($model2, 'file_name[]')->fileInput(['multiple' => true, 'accept' => 'image/jpeg, image/jpg, image/png'])->label(false) ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary"><?php if (!isset($model->SafetyId)) { ?>Submit<?php } else { ?>Update<?php } ?></button>
            </div>
        </div>
    </div> <?php ActiveForm::end(); ?>
</div>