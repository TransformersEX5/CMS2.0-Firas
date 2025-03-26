<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AuthItemChild $model */
/** @var yii\widgets\ActiveForm $form */
$backindex = '/auth-item-child';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');
?>

<div class="auth-item-child-form">

<?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="col-md-6 mt-2">
        <div class="mt-2">
            <?= $form->field($model, 'parent')->dropDownList(Yii::$app->common->getAuthRole(), [
                'prompt' => '- Role -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->



    
    <div class="col-md-6 mt-2">
        <div class="mt-2">
            <?= $form->field($model, 'child')->dropDownList(Yii::$app->common->getAuthPermission(), [
                'prompt' => '- Permission -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end col -->



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
        }

        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<<JS


$('#create-form').on('beforeSubmit', function () {
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success: function (response) {
          // console.log(response.message);

            if (response.status) {
                     
                console.log(response.message);
                alert(response.message);   
              
               // alert('Resource created successfully!');           
               // $('#create-form').modal('hide');
               // $(this).closest('.create-form').modal('toggle');
                ///$('#create-form:visible').modal('toggle');
                

               
            } else {
                alert('Error creating resource: ' + response.data);
            }
        }
    });
    return false;
});



// $(document).ready(function () {
        
//         alert("ddd");
//             $('body').on('beforeSubmit', 'form#frmprogram', function () {
//                 var form = $(this);
//                 $.ajax({
//                 url    : form.attr('action'),
//                 type   : 'POST',
//                 data   : form.serialize(),
//                 success: function (data) 
//                 {
//                     console.log(data);
//                    if(response==1){
//                              alert("success Update");
//                          console.log();
//                         }
//                         error  : function () 
//                         {
//                             console.log('internal server error');
//                         }
//                 }    
//             });
    
//                 return false;
//              });
//     });


/*88888888888888888888888888888888888888888888888888888888888888*/


// $('form#{model->formName()}').on('beforeSubmit', function(e)
// {

  
// var \$form =$(this);
// $.post(
//     \$form.attr("action"),
//     \$form.serialize() 	
// )

//   .done(function(result){
  
//     if(result ==1)
// 	{ 
// 		$(\$form).trigger("reset");

// 	}else {
      
// 		 $("#message").html(result.message);
//  	 }

// 	}).fail(function())

// 	{
// 	   console.log("server error");
// 	});



// return false;
// });






JS;
$this->registerJs($script);
?>