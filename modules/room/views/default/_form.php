<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblworkingstatus $model */
/** @var yii\widgets\ActiveForm $form */
$backindex = '/room';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>

<div class="tblroom-form">


<?php $form = ActiveForm::begin([
    'id' => 'room-create',
    //'enableAjaxValidation' => true,
]); ?>


    <div class="row">
        <div class="col-md-8 mt-2">
            <?= $form->field($model, 'RoomCode')->textInput(['maxlength' => true]) ?>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-8 mt-2">
            <?= $form->field($model, 'RoomName')->textInput(['maxlength' => true]) ?>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-3 mt-2">
            <?= $form->field($model, 'RoomCapacity')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3 mt-2">
            <?= $form->field($model, 'ExamCapacity')->textInput(['maxlength' => true]) ?>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-8 mt-2">
            <?= $form->field($model, 'RoomTypeId')->dropDownList(Yii::$app->common->getRoomType(), [
                'prompt' => '- Room Type -',
                'class' => 'form-select mb-2',
                'id' => 'txtRoomTypeId'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mt-2">
            <?= $form->field($model, 'RoomStatus')->dropDownList(Yii::$app->common->getStatus(), [
                'prompt' => '- Status -',
                'class' => 'form-select mb-2',
                'id' => 'txtStatusId'
            ]) ?>
        </div>
    </div>
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

    <?php ActiveForm::end(); ?>

</div>



<?php
$js = <<< JS

$(document).ready(function () {

    $('#btnApply').click(function(){
        var form = $('#room-create');
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
                        var hasErrorSpan = $('.field-tblroom-' + field.toLowerCase());
                        var errorSpan = $(':input[name="Tblroom[' + field + ']"]').closest('.form-group').find('.help-block');
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