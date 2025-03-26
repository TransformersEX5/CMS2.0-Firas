<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

// use app\models\tbldatinpropertytype;
// use app\models\Tblstatusai;

?>

<?php

$module = '/' . Yii::$app->controller->module->id;

$urlUpload = Url::base() . $module . '/default/uploadexcel';
$download = Url::base() . $module . '/default/download';
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
                event.preventDefault();

                var form = $('#EMGSId');
                var formData = new FormData(form[0]);

                desc = 'Are you sure to upload?';
                desc2 = 'You have successfully upload the excel!'

                Swal.fire({title:desc,icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:"Confirm"})
                .then(function(t) 
                {
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
                                        // window.close();
                                        btnClose.click();
                                    }
                                });
                            }
                            else
                            {
                                alert("Please make sure that you're following the provided template format!");
                            }
                        },
                        error: function () 
                        {

                        }
                    });
                });
            }
            
        });
        
        $(document).on('click', '.download', function() {
            window.location.href = '$download';
        });

    });

JS;
$this->registerJs($script);

$qqq = Url::base() . $module . '/views/default';
?>

<div class="col-12"><?php $form = ActiveForm::begin(['id' => 'EMGSId', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row mb-1">
                <div class="col-md-3 d-flex align-items-center">
                    Notes:
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex align-items-center">
                    <ol>
                        <!-- <li>Click <a class="download" style="color: blue;" href="#">here</a> to download the template.</li>
                        <li>It is advisable to use the template provided to make sure the data can be entered correctly.</li> -->
                        <li style="font-size:18px;">Please make sure that you uploaded the excel with the format <b>.xlsx</b>. Other format could lead to failure in uploading.</li>
                        <li>For the "Student Pass Expiry Date" column, make sure to set it to "N/A" if the date is not available.</li>
                        <li>The data uploaded will be reflected in report F59 - Payment Enroll by Year.</li>
                        <li>Make sure to inform the IMO team after uploading the new data.</li>
                    </ol>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-12 d-flex align-items-center">
                    Upload Excel
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <?= $form->field($model, 'StudNRICPassportNo')->fileInput(['multiple' => false])->label(false) ?>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button id="btnClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="btnUpload" class="btn btn-primary">Upload</button>
        </div>
    </div> <?php ActiveForm::end(); ?>
</div>