<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\models\Tblrmcdocument;
?>

<?php

$RMCDocumentId = Yii::$app->request->get('RMCDocumentId');
$RMCId = Yii::$app->request->get('RMCId');

$module = '/' . Yii::$app->controller->module->id;

$urlCreate = Url::base() . $module . '/upload/upload';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS

$(document).ready(function () {
    $("#RMCDocumentId").submit(function(event) 
    {
        event.preventDefault();
        
        var RMCDocumentId = '$RMCDocumentId';
        var formData = new FormData(this); // Use FormData to include file data
        var RMCId = '$RMCId';

        formData.append('RMCDocumentId', RMCDocumentId);
        formData.append('RMCId', RMCId);
        formData.append('_csrf', '$_csrf');

        if(RMCDocumentId)
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
                        data: formData,
                        processData: false, // Prevent jQuery from processing the data
                        contentType: false, // Prevent jQuery from setting the content type
                        success: function(response) 
                        {
                                Swal.fire({title: desc2,icon: "success",confirmButtonColor: "#34c38f",confirmButtonText: "Confirm"})
                                .then(function() {
                                    // Reload the whole page
                                    location.reload();
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

<div class="col-12">
    <?php
    $form = ActiveForm::begin(['id' => 'RMCDocumentId']);
    ?>

    <div class="card-body mt-0">
        <div class="row">
        <div class="mb-3">
                <?= $form->field($model, 'RMCDocumentTypeId')->dropDownList(
                    $doctype, // This now contains ['RMCDocumentTypeId' => 'RMCDocument']
                    ['class' => 'form-control', 'prompt' => 'Select Document Type', 'required' => true]
                )->label('Document Category:') ?>
            </div>
            <div class="col-12">
            <?= $form->field($model, 'RMCDocument')->fileInput(['id' => 'file-input', 'required' => true])->label(false) ?><br>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <?php if ($RMCDocumentId) { ?>Update<?php } else { ?>Submit<?php } ?>
                </button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
