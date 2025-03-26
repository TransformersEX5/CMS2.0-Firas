<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblprogramfeecategory $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/programfeecategory';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>

<div class="tblprogramfeecategory-form">
    

<?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'ProgFeeCatTitle')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <!-- <?= $form->field($model, 'ProgFeeCatCode')->textInput(['maxlength' => true]) ?> -->

    <input type="hidden" id="ProgramTypeText">
    <input type="hidden" id="ResidencyText">


    <div class="row">

        <div class="col-4 mt-2">
            <?= $form->field($model, 'ProgramTypeId')->dropDownList(Yii::$app->common->getProgramType(), [
                'prompt' => '- ProgramType -',
                'class' => 'form-select mb-2',
                'id' => 'ProgramTypeId'
            ]) ?>
        </div>

        <div class="col-4 mt-2">
            <?= $form->field($model, 'ResidencyId')->dropDownList(Yii::$app->common->getResidency(), [
                'prompt' => '- Residency Fee   -',
                'class' => 'form-select mb-2',
                'id' => 'ResidencyId'
            ]) ?>
        </div>

    </div>


    <input type="hidden" id="FeeStructurerText">
    <input type="hidden" id="SessionText">
    <div class="row">

        <div class="col-4 mt-2">
            <?= $form->field($model, 'FeeStructurerId')->dropDownList(Yii::$app->common->getFeeStructure(), [
                'prompt' => '- Fee Structurer -',
                'class' => 'form-select mb-2',
                'id' => 'FeeStructurerId'

            ]) ?>
        </div>


        <div class="col-4 mt-2">
            <?= $form->field($model, 'SessionId')->dropDownList(Yii::$app->common->getSession(), [
                'prompt' => '- Session -',
                'class' => 'form-select mb-2',
                'id' => 'SessionId'
            ]) ?>
        </div>

    </div>


    <input type="hidden" id="TotalFeeText">
    <input type="hidden" id="TotalSemText">

    <div class="row">

        <div class="col-4 mt-2">
            <?= $form->field($model, 'TotalFee')->textInput(['maxlength' => true, 'id' => 'TotalFee']) ?>
        </div>


        <div class="col-4 mt-2">
            <?= $form->field($model, 'TotalSem')->textInput(['maxlength' => true, 'id' => 'TotalSem']) ?>
        </div>

    </div>


    <input type="hidden" id="IntakeStartText">
    <input type="hidden" id="IntakeEndText">

    <div class="row">

        <div class="col-4 mt-2">
            <?= $form->field($model, 'IntakeStart')->dropDownList(Yii::$app->common->getIntakeStart(), [
                'prompt' => '- Intake Start -',
                'class' => 'form-select mb-2',
                'id' => 'IntakeStart'
            ]) ?>
        </div>


        <div class="col-4 mt-2">
            <?= $form->field($model, 'IntakeEnd')->dropDownList(Yii::$app->common->getIntakeEnd(), [
                'prompt' => '- Intake End -',
                'class' => 'form-select mb-2',
                'id' => 'IntakeEnd'
            ]) ?>
        </div>

    </div>




    <?= $form->field($model, 'ProgFeeCatRemarks')->textarea(['rows' => '3']) ?>


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

function gettitle(){
   
    var value1 = $('#ProgramTypeId option:selected').text();
    var value2 = $('#ResidencyId option:selected').text();
    var value3 = $('#IntakeStart option:selected').text();
    var value4 = $('#IntakeEnd option:selected').text();
    var value5 = $('#FeeStructurerId option:selected').text();
    var value6 = $('#SessionId option:selected').text();
    var value7 = $('#TotalFee').val();
    var value8 = $('#TotalSem').val()+ ' SEM';



    // var selectedDisplayedValue = $('#ProgramTypeId option:selected').text();
    // alert(selectedDisplayedValue);
    // var selectedDisplayedValue2 = $('#ResidencyId option:selected').text();
    // alert(selectedDisplayedValue2);
    // var selectedDisplayedValue3 = $('#FeeStructurerId option:selected').text();
    // alert(selectedDisplayedValue3);
    // var selectedDisplayedValue4 = $('#SessionId option:selected').text();
    // alert(selectedDisplayedValue4);
    // var selectedDisplayedValue5 = $('#IntakeStart option:selected').text();
    // alert(selectedDisplayedValue5);
    // var value5 = $('#TotalFee').val();
    // alert(value5);
    // var value6 = $('#TotalSem').val()+ ' SEM';
    // alert(value6);


    
    var concatenatedValue = value1 +'->'+ value2 +'->'+ value3+'-To-'+ value4+'->'+ value5+'->'+value7+'->'+value8 ;

    // alert(concatenatedValue);
    $('#tblprogramfeecategory-progfeecattitle').val(concatenatedValue);

    
}




$(document).ready(function () {

       //==============ProgramTypeId=================================================
    
        // var selectedValue = $('#ProgramTypeId').val();
    
        // Update the displayed value when the dropdown changes
        $('#ProgramTypeId').on('change', function() {
           // selectedDisplayedValue = $(this).find('option:selected').text();
         //   $('#ProgramTypeText').text(selectedDisplayedValue);       
            
            gettitle();
     });


                       
          //==============ResidencyId===================================================

        var selectedValue = $('#ResidencyId').val();
    
        var selectedDisplayedValue = $('#ResidencyId option:selected').text();
        // Update the displayed value when the dropdown changes
        $('#ResidencyId').on('change', function() {
           // selectedDisplayedValue = $(this).find('option:selected').text();
           // $('#ResidencyText').text(selectedDisplayedValue);

            
            gettitle();
        });


    //==============FeeStructurerId===================================================

    var selectedValue = $('#FeeStructurerId').val();
    
    var selectedDisplayedValue = $('#FeeStructurerId option:selected').text();
    // Update the displayed value when the dropdown changes
    $('#FeeStructurerId').on('change', function() {
      //  selectedDisplayedValue = $(this).find('option:selected').text();
       // $('#FeeStructurerText').text(selectedDisplayedValue);
        gettitle();
    });


     //==============SessionId===================================================

     var selectedValue = $('#SessionId').val();
    
    var selectedDisplayedValue = $('#SessionId option:selected').text();
    // Update the displayed value when the dropdown changes
    $('#SessionId').on('change', function() {
       // selectedDisplayedValue = $(this).find('option:selected').text();
      //  $('#SessionText').text(selectedDisplayedValue);
        gettitle();
    });


     //==============TotalFee===================================================

     $('#TotalFee').keydown(function(event) {
           gettitle();
        });

        $('#TotalFee').keyup(function(event) {
            gettitle();
     });

     
     //==============TotalSem===================================================

     $('#TotalSem').keydown(function(event) {
            gettitle();
        });

        $('#TotalSem').keyup(function(event) {
            gettitle();
     });


         //==============IntakeStart===================================================

    var selectedValue = $('#IntakeStart').val();
    
    var selectedDisplayedValue = $('#IntakeStart option:selected').text();
    // Update the displayed value when the dropdown changes
    $('#IntakeStart').on('change', function() {
       // selectedDisplayedValue = $(this).find('option:selected').text();
       // $('#IntakeStartText').text(selectedDisplayedValue);
        gettitle();
    });
 



    //==============IntakeEnd===================================================

    var selectedValue = $('#IntakeEnd').val();
    
    var selectedDisplayedValue = $('#IntakeEnd option:selected').text();
    // Update the displayed value when the dropdown changes
    $('#IntakeEnd').on('change', function() {
       // selectedDisplayedValue = $(this).find('option:selected').text();
       // $('#IntakeStartText').text(selectedDisplayedValue);
        gettitle();
    });
 


    //=========================================================================

        
});


        

JS;
$this->registerJs($script);


?>