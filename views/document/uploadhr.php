<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Tbltraining $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/training';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>


<div class="tbldocument-form">

    <?php $form = ActiveForm::begin([
        'id' => 'upload-form',
        'options' => ['class' => 'ajax-form', 'enctype' => 'multipart/form-data'],

    ]); ?>



    <div class="row">
        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'DocTypeId')->dropDownList(Yii::$app->common->getDocumentCategoryhr(), [
                'prompt' => '- Document Type -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'eventimage')->fileInput() ?>
        </div>
    </div> <!-- end row -->



    <div class="form-group mt-3">

        <?php
        if ($pageUrl == 'view') {
            //echo Html::a(' Close ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
        } else {
            // echo Html::a(' Cancel ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
            echo '&nbsp';
            echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
            echo Html::submitButton('Upload', ['class' => 'btn btn-primary']);

            // echo  '<button id="Save" class="btn btn-success " type="button"> Apply <i  class="icon-file"></i></button>';
        }

        ?>
    </div>



    <?php ActiveForm::end(); ?>




    <?php

    $create = Url::toRoute(['/document/uploadhr']);
    $script = <<<JS



$('#upload-form').on('beforeSubmit', function (e) {

    alert("upload-form");
    
        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
          // console.log(response.message);

            if (response.status==1) {                     
                //console.log(response.message);
               toastr.options.timeOut = 1000; // 1.5s 
               toastr.options = {"closeButton": true,"newestOnTop": true,"preventDuplicates": true }

              toastr.success(response.message,"Success"); 
               
              //clode model form
               $('#closeButton').click();
            } 

            if (response.status==2) {    
                toastr.warning(response.message,"Error");      
            }
        },
            error: function (xhr, status, error) {
                // Handle error
                console.error('Error: ' + error);
            }
        });

        return false;
    });




JS;
    $this->registerJs($script);
    ?>