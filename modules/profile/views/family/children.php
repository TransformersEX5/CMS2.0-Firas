<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Tbldepartment $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/department';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>

<div class="tbldepartment-form">

    <?php $form = ActiveForm::begin([
        'id' => 'department', 
    ]); ?>



    <div class="form-group mt-3">

       <?php
        if ($pageUrl == 'view') {
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
        } else {
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning me-2', 'data-bs-dismiss' => 'modal']);
            echo Html::Button('Submit', ['class' => 'btn btn-success', 'id'=>'btnApply']);
        }
    ?>
    </div>
    </div>





    <?php ActiveForm::end(); ?>

</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script> -->
<?php
$js = <<< JS

$(document).ready(function () {
    $('#btnApply').click(function(){
        var form = $('#department');
        var formData = new FormData(form[0]);
        $.ajax({
            url: form.attr('action'),
            type: 'POST', dataType: 'json',
            data: formData, contentType: false,
            processData: false,
            success: function (response) {
                if (response.status==1){
                    toastr.success(response.message,"success");
                    $('#closeButton').click();                
                } else {
                    toastr.warning(response.message,"error");
                    $('.help-block').text('');
                    $('.has-error').removeClass('has-error');                    
                    $.each(response, function (field, errors) {
                        //   alert(field+errors);
                        var hasErrorSpan = $('.field-tbldepartment-' + field.toLowerCase());
                        var errorSpan = $(':input[name="Tbldepartment[' + field + ']"]').closest('.form-group').find('.help-block');
                        errorSpan.text(errors.join(' '));
                        hasErrorSpan.addClass('has-error');
                    });
                }
            },
            complete: function() { 
                //stop loding     
                
            },
            error: function () {
                toastr.error(response.message,"error");
                // $('#closeButton').click();
            },
        });
    });
});

JS;
$this->registerJs($js);
?>