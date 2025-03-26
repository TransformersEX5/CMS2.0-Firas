<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;

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
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'options' => ['class' => 'ajax-form', 'enctype' => 'multipart/form-data'],

        // 'validateOnBlur' => true,
        // 'validateOnChange' => true,
        // 'validateOnSubmit' => true,
    ]); ?>




    <div class="col-md-8">
        <div class="mb-2">
            <?= $form->field($model, 'DepartmentDesc')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'StatusId')->dropDownList(Yii::$app->common->getStatus(), [
            'prompt' => '- Status -',
            'class' => 'form-select mb-2'
        ]) ?>
    </div>


    <div class="col-md-4">
        <?= $form->field($model, 'DeptCatId')->dropDownList(Yii::$app->common->getDepartmentcategory(), [
            'prompt' => '- Category -',
            'class' => 'form-select mb-2'
        ]) ?>

    </div>

    <div class="col-md-4">
        <div class="mb-2">
            <?= $form->field($model, 'HODUserId')->textInput() ?>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-2">
            <?= $form->field($model, 'Department_iso')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <!-- ********************************************************************************************* -->


    <div class="form-group mt-3">

        <?php
        if ($pageUrl == 'view') {
            //echo Html::a(' Close ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
        } else {
            // echo Html::a(' Cancel ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
            echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']); 
            echo '&nbsp';
            // echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
            echo  '<button id="Save" class="btn btn-success " type="button"> Apply <i  class="icon-file"></i></button>';
            echo '&nbsp';
            // echo  '<button id="myBtn2" class="btn btn-success " type="button"> custom-close <i class="icon-file" data-dismiss="modal"></i>cccccccccccc</button>';

            // echo  '<button type="button" id ="editModal" class="btn btn-primary" data-dismiss="modal">Close</button>';
        }


        ?>
    </div>





    <?php ActiveForm::end(); ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<?php
$script = <<<JS

// $("#myBtn2").click(function(){
//     alert("xx");
    
//     $("#modal").modal("hide")
//   });


//   $("#editModal").click(function() {
//     alert("xx");
// // $(this).closest('.modal').modal('toggle');
// $(".modal:visible").modal('toggle');

// });



// $('#create-form').on('beforeSubmit', function () {
$('#Save').click(function () {
    
    event.preventDefault(); // stopping submitting
    var form = $('#department'); //form id
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),    
        dataType: 'json',
        cache: false,     
        data: form.serialize(),         
        beforeSend: function() {
         
        },
        success: function (response) {
          // console.log(response.message);
            if (response.status==1) {                     
                //console.log(response.message);
                  
            var modalId = $('.modal').attr('id');
            //alert(modalId);

              //  alert(response.message);
            
                // $('.modal').removeClass('show');
                // $('body').removeAttr("style");
                // $('.modal-backdrop').remove();

               
                //$(".modal").removeAttr("style");
                
             

                            
               toastr.options.timeOut = 1000; // 1.5s 
               toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "preventDuplicates": true,
               // "positionClass": "toast-top-full-width",
               }

              toastr.success(response.message,"Success"); 
               //toastr.success("I do not think that means what you think it means.", "makan ");
              
            } 

            if (response.status==2) {    
                toastr.warning(response.message,"Error");      
                      
                //alert('Error creating resource: ' + response.data);
            }
        },
        complete: function() {
            $('#closeButton').click();
           //  var modalId = $('.modal').attr('id');
            // alert(modalId);
            // console.log('Modal ID:', modalId);
             //var modal = new bootstrap.Modal('#modal-lg');
             //modal.hide();
            //$('#modal').modal('hide');
            //$('#modal').modal('hide');

          
           
         
                   },

        error: function () {
            toastr.error("There may a error on uploading. Try again later","Error");    
        }
    });
    return false;
});



// $('#create-form').on('beforeSubmit', function () {
//     var form = $(this);
//     $.ajax({
//         url: form.attr('action'),
//         type: form.attr('method'),
//         data: form.serialize(),
//         dataType: 'json',
//         success: function (response) {
//           // console.log(response.message);

//             if (response.status) {
                     
//                 console.log(response.message);
//                 alert(response.message);   
              
//                // alert('Resource created successfully!');           
//                // $('#create-form').modal('hide');
//                // $(this).closest('.create-form').modal('toggle');
//                 ///$('#create-form:visible').modal('toggle');
                

               
//             } else {
//                 alert('Error creating resource: ' + response.data);
//             }
//         }
//     });
//     return false;
// });



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