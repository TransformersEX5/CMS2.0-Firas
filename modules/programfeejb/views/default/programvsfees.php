<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramfeecategory $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/programfeecategory';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>

<div class="Programvsfees-form">

    <?php $form = ActiveForm::begin([
        'id' => 'programfees',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?php
    echo $_GET['ProgramIntId'];
    echo '<p>';
    echo $_GET['ProgramId'];
    echo '<p>';
    echo $_GET['ResidencyId'];
    echo '<p>';
    echo $_GET['FeeStructureId'];
    echo '<p>';
    echo $_GET['ProgramTypeId'];
    ?>
    <!-- list of program -->
    <div class="col-md-12">
        <div class="row">
            <div class='col-6 col-sm-8'>
                <div class="box-body">
                    <label for="cbo_programfee">Select a program fee code:</label>
                   
                    <select id="cbo_programfee" name="cbo_programfee" class=" form-select mb-6">
                    
                    </select>
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
                echo  '<button id="Save" class="btn btn-success " type="button"> Apply <i  class="icon-file"></i></button>';
            }

            ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

    <!-- ************************************************************************************************** -->


    <?php

    $ProgramIntId = $_GET['ProgramIntId'];
    $ProgramId = $_GET['ProgramId'];
    $ResidencyId = $_GET['ResidencyId'];
    $FeeStructureId = $_GET['FeeStructureId'];
    $ProgramTypeId = $_GET['ProgramTypeId'];

    $urlprogram = Url::toRoute(['/programfeejb/default/saveprogramfee']);

    $url_combobox_programfeegroup = Url::toRoute(['/programfeejb/default/get_combobox_programfeegroup']);

    $script = <<<JS


  $(document).ready(function () {

            $.ajax({
            url: '$url_combobox_programfeegroup',
            type: "GET",
            data: { ProgramIntId:'$ProgramIntId',
            ProgramId:'$ProgramId',
            ResidencyId:'$ResidencyId',
            FeeStructureId:'$FeeStructureId',
            ProgramTypeId:'$ProgramTypeId',
            cbo_programfee:$('#cbo_programfee').val(),
        },
                    success: function(data) {
                        $("#cbo_programfee").empty();
                        
                          $.each(data, function(key, value) {                            
                            $("#cbo_programfee").append("<option value=" + value.id + ">" + value.name + "</option>");
                        });

          


                    }
                });
            
            });

//======================================================================================


// $('#create-form').on('beforeSubmit', function () {
    $('#Save').click(function () {
    
    event.preventDefault(); // stopping submitting
    var form = $('#programfees'); //form id
    $.ajax({
        url: '$urlprogram',
        type: form.attr('method'),    
        dataType: 'json',
        cache: false,     
        data:{
            form:form.serialize(),         
            ProgramIntId:'$ProgramIntId',
            ProgramId:'$ProgramId',
            ResidencyId:'$ResidencyId',
            FeeStructureId:'$FeeStructureId',
            ProgramTypeId:'$ProgramTypeId',
            cbo_programfee:$('#cbo_programfee').val(),

        } ,
        
        beforeSend: function() { },

        success: function (response) {
         
           
            // console.log(response.message);
            if (response.status==1) {                     
                //console.log(response.message);
               toastr.options.timeOut = 1000; // 1.5s 
               toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "preventDuplicates": true,               
               }

              toastr.success(response.message,"Success"); 
               //toastr.success("I do not think that means what you think it means.", "makan ");
              
               $('#closeButton').click();

            } else {

                // $.each(response, function (field, errors) {
                //     var hasErrorSpan = $('.field-tbldepartment-' + field.toLowerCase());
                //     var errorSpan = $(':input[name="tbldepartment[' + field + ']"]').closest('.form-group').find('.help-block');
                //     errorSpan.text(errors.join(' '));
                //     hasErrorSpan.addClass('has-error');
                //     });
                toastr.warning(response.message,"Success"); 
                $('#closeButton').click();

                }

            // if (response.status==2) {    
            //     toastr.warning(response.message,"Error");      
             


                      
            //     //alert('Error creating resource: ' + response.data);
            // }
        },
        complete: function() {

        },

        error: function () {
           // toastr.error("There may a error on uploading. Try again later","Error");    

             
        }
    });
    return false;
});


JS;
    $this->registerJs($script);
    ?>