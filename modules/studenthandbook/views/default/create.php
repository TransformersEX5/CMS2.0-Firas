<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

// use app\models\tbldatinpropertytype;
// use app\models\Tblstatusai;

?>

<?php

$space = "";

for ($i = 0; $i <= 53; $i++) {
    $space .= '&nbsp;';
}

$module = '/' . Yii::$app->controller->module->id;

$urlRedirect = Url::base() . $module . '/default';
$urlUpload = Url::base() . $module . '/default/upload';
$_csrf = Yii::$app->request->getCsrfToken();

$script = <<< JS

$(document).ready(function() 
{
    $('#btnUpload').click(function()
    {
        if ($('input[type=file]').get(0).files.length === 0) {
            // Prevent form submission and display an alert or take any other action
            alert('Please choose a file to upload.');
            event.preventDefault();
        }
        else
        {
            var uploadFile = $('input[type=file]').get(0).files[0];;
            if (uploadFile) {
            var fileName = uploadFile.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();

            if (fileExtension !== 'pdf') {
            // Display an error message or take appropriate action
            alert('Please select a PDF file.');
            }
            else
            {
                event.preventDefault();

                var form = $('#StudentHandbookId');
                var formData = new FormData(form[0]);

                desc = 'Are you sure to upload?';
                desc2 = 'You have successfully upload the document!'

                Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
                .then(function(t) 
                {
                    if (t.isConfirmed) {
                        $.ajax({
                            url: '$urlUpload',
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

                                    var hasErrorSpan = $('.field-tbluploaddocument-' + field.toLowerCase());
                                    var errorSpan = $(':input[name="Tbluploaddocument[' + field + ']"]').closest('.form-group').find('.help-block');
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
                    } else {

                    }
                });
            }
        }}
    });
});


JS;
$this->registerJs($script);

?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'StudentHandbookId', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row mb-3">
                <div class="col-md-3 d-flex align-items-center">
                    Document Name
                </div>
                <div class="col-md-9">
                    <?= Html::textInput('UploadDocumentName', null, ['class' => 'form-control text-dark border-dark', 'required' => 'required']) ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 d-flex align-items-center">
                    Year
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'Year')->textInput(['class' => 'form-control text-dark border-dark', 'type' => 'number', 'required' => 'required'])->label(false); ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 d-flex align-items-center">
                    Remarks
                </div>
                <div class="col-md-9">
                    <?= $form->field($model, 'Remarks')->textarea(['class' => 'form-control text-dark border-dark', 'rows' => 3, 'maxlength' => 250])->label(false); ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 d-flex align-items-center">
                    Upload
                </div>
                <div class="col-md-9">
                    <?= $form->field($model, 'UploadDocument[]')->fileInput(['multiple' => false, 'accept' => '.pdf'])->label(false) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 d-flex align-items-center">
                    Note:
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <ol type="i">
                        <li>File must be in pdf format.</li>
                        <li>File name should be like this: "CITYU_LOCAL_STUDENT_HANDBOOK"
                        <br> <?= $space; ?>"CITYU_INTERNATIONAL_STUDENT_HANDBOOK"
                        <br> <?= $space; ?>"CITYU_POSTGRADUATE_STUDENT_HANDBOOK"</li>
                        <!-- <li>Please be noted that these files will be displayed at both Student Portal and Lecturer Portal.</li> -->
                    </ol>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button id="btnClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="submit" class="btn btn-primary">Upload</button> -->
            <button type="button" id="btnUpload" class="btn btn-primary">Upload</button>

        </div>
    </div> <?php ActiveForm::end(); ?>
</div>