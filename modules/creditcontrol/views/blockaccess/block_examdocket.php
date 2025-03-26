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
    'id' => 'blockaccessexamdocket',
    //'enableAjaxValidation' => true,
]); ?>


<div class="form-group mb-3">

    <div class="row">
        <div class="col-md-6 mt-2">
        <?= $form->field($model, 'BlockOnOff')->dropDownList(['1' => 'Open Access', '2' => 'Close Access'],['prompt'=>'Select Option', 'class' => 'form-select mb-2','id' => 'cboBlockOnOff']); ?>

           

        </div>
    </div>
</div>

<?= $form->field($model, 'Remarks')->textarea(['rows' => 4, 'id' => 'txtRemarks']) ?>

</div>
This remarks can be seen by everyone

<div class="form-group mt-3">

    <?php
    if ($pageUrl == 'view') {
        echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
    } else {
        echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning me-2', 'data-bs-dismiss' => 'modal']);
        echo Html::Button('Submit', ['class' => 'btn btn-success', 'id' => 'btnApply']);
    }
    ?>

</div>


<?php ActiveForm::end(); ?>


<?php

$js = <<< JS

// 1=Open Access; 2=Close Access

 $(document).ready(function () {

    $("#cboBlockOnOff").change(function(){
        // alert(document.getElementById("cboBlockOnOff").value);
        
        if(document.getElementById("cboBlockOnOff").value==1){
            $('#txtRemarks').val("Info, your access for Exam Docket open for 7 days. Please make balance payment. "); 

        } else {
                       
            $('#txtRemarks').val("Sorry, your access for Exam Docket has been block, Please check your outstanding payment or you can refer to Bursary Unit for more info."); 
        };
     });


$('#btnApply').click(function()

    {
        var form = $('#blockaccessexamdocket');
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
                    // alert('yes');
                    toastr.success('Your group has been successfully created');

                //close modal after success
                   $('#closeButton').click();
                }

                else
                {
                    // alert('no');

                    $('.help-block').text('');
                    $('.has-error').removeClass('has-error');
                    
                    $.each(response, function (field, errors) {
                     //   alert(field+errors);

                        var hasErrorSpan = $('.field-tblblockaccessstud-' + field.toLowerCase());
                        var errorSpan = $(':input[name="Tblblockaccessstud[' + field + ']"]').closest('.form-group').find('.help-block');
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