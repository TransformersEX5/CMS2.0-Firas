<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\tblprogram $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/program';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');



?>
<style>
    .modal-header-success {
        color: #fff;
        padding: 9px 15px;
        border-bottom: 1px solid #eee;
        background-color: #5cb85c;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .modal-header {
        color: #fff;
        padding: 9px 15px;
        background-color: #f0ad4e;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;

    }


    .modal-footer {
        color: #fff;
        padding: 9px 15px;
        background-color: #f0ad4e;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;

    }

    .modal-header-danger {
        color: #fff;
        padding: 9px 15px;
        border-bottom: 1px solid #eee;
        background-color: #d9534f;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .modal-header-info {
        color: #fff;
        padding: 9px 15px;
        border-bottom: 1px solid #eee;
        background-color: #5bc0de;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .modal-header-primary {
        color: #fff;
        padding: 9px 15px;
        border-bottom: 1px solid #eee;
        background-color: #428bca;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .modal-footer {
        background-color: #428bca;
    }




    /* 
    .modal-overlay {
        display: none;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .5);
        opacity: 0;
        transition: opacity .2s ease;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-overlay.visible {
        opacity: 1;
    }

    .modal-container {
        flex-basis: 50%;
        padding: 1rem;
        background-color: #fff;
        border-radius: 3px;
    }

    .modal-header {
        display: flex;
        font-weight: bold;
    }

    .modal-close {
        margin-left: auto;
        color: inherit;
        text-decoration: none;
        margin-top: -.5rem;
        font-size: 2rem;
    }

    .modal-content {
        max-height: 600px;
        overflow: auto;
        padding: 20px
    } */
</style>
<div class="tblprogram-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <div class="mb-2">
                <?= $form->field($model, 'ProgramCode')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-8">
            <div class="mb-3">
                <?= $form->field($model, 'ProgramName')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <!-- end col -->

    </div>


    <div class="row">
        <div class="col-md-2">
            <div class="mb-2">
                <?= $form->field($model, 'ProgramCode2')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-8">
            <div class="mb-3">
                <?= $form->field($model, 'ProgramName2')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <!-- end col -->

    </div>



    <div class="row">
        <div class="col-md-2">
            <div class="mb-2">
                <?= $form->field($model, 'ProgramCode3')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-8">
            <div class="mb-3">
                <?= $form->field($model, 'ProgramName3')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <!-- end col -->

    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <?= $form->field($model, 'FacultyId')->textInput() ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <?= $form->field($model, 'SchoolId')->textInput() ?>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <?= $form->field($model, 'ProgramType')->textInput() ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <?= $form->field($model, 'ProgramType')->textInput() ?>
            </div>
        </div>
    </div>


    <!-- ************************************************************************************************** -->

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

<!-- ************************************************************************************************** -->

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
             //   alert(response.message);   
                $('#cmstable1').DataTable().ajax.reload();
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