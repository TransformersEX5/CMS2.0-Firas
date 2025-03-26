<!-- views/site/upload.php -->
<?= \yii\helpers\Html::cssFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css') ?>
<?= \yii\helpers\Html::jsFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js') ?>

<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;

?>



<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'upload-form',
        'enctype' => 'multipart/form-data',
    ],
]); ?>


Upload with ajax..


<?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ;?>

<?= $form->field($model, 'eventImage')->fileInput();?>

<?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>



<?php
$script = <<<JS

$('#upload-form').on('beforeSubmit', function (e) {
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: new FormData(this),
            // processData: false,
            // contentType: false,
            dataType: 'json',
        cache: false,     
        data: form.serialize(),         
        beforeSend: function() { },

            success: function (response) {
                if (response.success) {
                    toastr.success(response.message, 'Success');
                } else {
                    toastr.error(response.message, 'Error');
                }
        },
        complete: function() { },

        error: function () {
            toastr.error("There may a error on uploading. Try again later","Error");    
        }
    });
    return false;
});


JS;
$this->registerJs($script);
?>