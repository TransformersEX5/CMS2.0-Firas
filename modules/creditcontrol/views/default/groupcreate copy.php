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
<?php

$form = ActiveForm::begin([
    'id' => 'group-create',
    'enableAjaxValidation' => true,
    'options' => ['class' => 'form-horizontal'],
])
?>



<?= $form->field($model, 'DebtGroupName') ?>




<div class="form-group mt-3">

    <?php
        if ($pageUrl == 'view') {
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
        } else {
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning me-2', 'data-bs-dismiss' => 'modal']);
            echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']);
        }
    ?>

</div>




<?php ActiveForm::end() ?>


<?php

$script = <<<JS




// $(document).ready(function () {
// $('#group-create').on('beforeSubmit', function (e) {
    
    
//     var form = $(this);

//     $.ajax({
//         url: form.attr('action'),
//         type: 'post',
//         data: form.serialize(),
//         success: function(data) {
//             if (data.success) {
//                 // Handle successful form submission
//             } else {
//                 form.yiiActiveForm('updateMessages', data.errors, true);
//             }
//         }
//     });
//     return false;
// });

// });
// $(document).ready(function () {
// $('group-create').on('beforeSubmit', function(e) {
//     e.preventDefault();
//     var form = $(this);
//     $.post(
//         form.attr("action"), // serialize Yii2 form 
//         form.serialize()
//     )
//     .done(function(result) {
//         alert(result);
//         console.log(result);
        
//         if(result ==true) {
//             // do something on success, for example, redirect
//             alert('success');
//         } else {
//             alert(result);
//             // process errors for each field
//             form.yiiActiveForm('updateMessages', result.errors, true); // updates error messages
//         }
//     }).fail(function() {
//         alert('failaaa');
//         console.log("server error");
//     });
//     console.log(result);
//     //return false; // prevent default form submission
// });
// });

// $(document).ready(function () {
//     $('#group-create').on('beforeSubmit', function (e) {
//         e.preventDefault();
//         var form = $(this);
//         var formData = new FormData(form[0]);
//         $.ajax({
//             url: form.attr('action'),
//             type: 'POST',
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function (data) {
              


//               if(data.success==1){
                
//                 // data is the response from the server
//                 toastr.success('Your group has been successfully created');

//                 //close modal after success
//                 $('#closeButton').click();

//                 // Optionally reset the form or redirect the user
//                 // form[0].reset();
//                 // window.location.href = 'view?id=' + data.id; // Redirect to view if needed
//             }else{

//                           $.each(data, function (field, errors) {
//                     var hasErrorSpan = $('.field-tbldebtgroup-' + field.toLowerCase());
//                     var errorSpan = $(':input[name="Tbldebtgroup[' + field + ']"]').closest('.form-group').find('.help-block');
//                     errorSpan.text(errors.join(' '));
//                     hasErrorSpan.addClass('has-error');
//                     });
//             }}        ,
//             error: function () {
//                 toastr.error('Error occurred during form submission');
//             }
//         });
//         return false; // Prevent form from submitting normally
//     });
// });

JS;
$this->registerJs($script);


?>