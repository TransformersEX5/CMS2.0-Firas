<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\Models\AuthItem $model */
/** @var yii\widgets\ActiveForm $form */
// $backindex = '/auth-item';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>

<?php $form = ActiveForm::begin([
    'id' => 'group-create',
    //'enableAjaxValidation' => true,
]); ?>


<div class="form-group mb-3">

<?= $form->field($model, 'ProgRegRemarks')->textarea(['rows' =>12, 'id' => 'txtRemarks']) ?>

</div>
This remarks can be seen by everyone

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






<?php


$js = <<< JS



 $(document).ready(function () {
$('#btnApply').click(function()

    {
        var form = $('#group-create');
        var formData = new FormData(form[0]);
    
        // $('#btnApply').button('loading');
        

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) 
            {
                if(response.success)
                {
                    toastr.success('Your group has been successfully created');

                //close modal after success
                   $('#closeButton').click();
                }

                else
                {
                    $('.help-block').text('');
                    $('.has-error').removeClass('has-error');
                    
                    $.each(response, function (field, errors) {
                     //   alert(field+errors);

                        var hasErrorSpan = $('.field-tbldebtgroup-' + field.toLowerCase());
                        var errorSpan = $(':input[name="Tbldebtgroup[' + field + ']"]').closest('.form-group').find('.help-block');
                        errorSpan.text(errors.join(' '));
                        hasErrorSpan.addClass('has-error');
                    });
                }
            },
            error: function () 
            {
                //alert('hehe');
               /// window.location.reload();
            }
        });

    });
});

JS;
$this->registerJs($js);

?>
