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
        'id' => 'Programfeegroup',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>




    <?= 'Prog Fee Code' ?>
    <h3><?= $model->ProgFeeCode ?></h3>


    <?= $form->field($model, 'ProgFeeCatTitle')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <div class="row">

        <div class="col-4 mt-2">
            <?= $form->field($model, 'ProgEdition')->textInput(['maxlength' => true, 'id' => 'ProgEdition', 'value' => ($model->ProgFeeCode) ? $model->ProgEdition : date("Ym")]) ?>
        </div>


        

        <div class="col-4 mt-2">
            <?= $form->field($model, 'ProgramTypeId')->dropDownList(Yii::$app->common->getProgramType(), [
                'prompt' => '- for Program Type   -',
                'class' => 'form-select mb-2',
                'id' => 'ProgramTypeId'
            ]) ?>
        </div>



        <div class="col-4 mt-2">
            <?= $form->field($model, 'ResidencyId')->dropDownList(Yii::$app->common->getResidency(), [
                'prompt' => '- Residency   -',
                'class' => 'form-select mb-2',
                'id' => 'ResidencyId'
            ]) ?>
        </div>


    </div>

    <!-- <?= Yii::$app->common->getRandomCodeProgramFee();  ?> -->
    <div class="row">



        <div class="col-4 mt-2">
            <?= $form->field($model, 'ProgFeePackageId')->dropDownList(Yii::$app->common->getProgFeePackage(), [
                'prompt' => '- Package Discount   -',
                'class' => 'form-select mb-2',
                'id' => 'ProgFeePackageId'
            ]) ?>
        </div>

        <div class="col-4 mt-2">
            <?= $form->field($model, 'TermTypeId')->dropDownList(Yii::$app->common->getTermType(), [
                'prompt' => '- Term Type -',
                'class' => 'form-select mb-2',
                'id' => 'TermTypeId'
            ]) ?>
        </div>

        <div class="col-4 mt-2">
            <?= $form->field($model, 'FeeStructureId')->dropDownList(Yii::$app->common->getFeeStructure(), [
                'prompt' => '- Fee Structure -',
                'class' => 'form-select mb-2',
                'id' => 'FeeStructureId'
            ]) ?>
        </div>

        

    </div>


    <!-- <input type="hidden" id="ProgramTypeText"> -->
    <input type="hidden" id="ResidencyText">

    <input type="hidden" id="ProgFeePackageText" name="ProgFeePackageText">
    <!-- <input type="hidden" id="FeeStructurerText"> -->
    <input type="hidden" id="SessionText">
    <!-- <div class="row">--->

    <div class="row">

        <div class="col-4 mt-2">
            <?= $form->field($model, 'TotalPublishFee')->textInput(['maxlength' => true, 'id' => 'TotalPublishFee']) ?>
        </div>


        <div class="col-4 mt-2">
            <?= $form->field($model, 'TotalPromoFee')->textInput(['maxlength' => true, 'id' => 'TotalPromoFee']) ?>
        </div>


    </div>


    <div class="row">

        <div class="col-4 mt-2">
            <?= $form->field($model, 'TotalSem')->textInput(['maxlength' => true, 'id' => 'TotalSem']) ?>
        </div>


        <div class="col-4 mt-2">
            <?= $form->field($model, 'SessionId')->dropDownList(Yii::$app->common->getSession(), [
                'prompt' => '- Session -',
                'class' => 'form-select mb-2',
                'id' => 'SessionId'
            ]) ?>
        </div>

        <div class="col-4 mt-2">
            <?= $form->field($model, 'StatusId')->dropDownList(Yii::$app->common->getStatus(), [
                'prompt' => '- Status -',
                'class' => 'form-select mb-2',
                'id' => 'StatusId'
            ]) ?>
        </div>


    </div>







    <input type="hidden" id="TotalFeeText">
    <input type="hidden" id="TotalSemText">

    <div class="row">




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

    
    var value0 = $('#ProgEdition').val();
    var value1 = $('#ResidencyId option:selected').text();
    var value2 = $('#ProgFeePackageId option:selected').text();
    var value3 = $('#TotalPublishFee').val();
    var value4 = $('#TotalPromoFee').val();
    var value5 = $('#TotalSem').val()+ ' SEM';
    var value6 = $('#SessionId option:selected').text();
    var value7 = $('#TermTypeId option:selected').text();
    var value8 = $('#FeeStructureId option:selected').text();
    


    var concatenatedValue = value0 +'->'+value1 +'->'+ value2+'->'+ value3+'->'+ value4 +'->'+ value5+'->'+ value6+'->'+ value7+'->'+ value8;
   

    // alert(concatenatedValue);
    $('#tblprogramfeecategory-progfeecattitle').val(concatenatedValue);

    
}




$(document).ready(function () {

       //==============ProgramTypeId=================================================
    
        // var selectedValue = $('#ProgramTypeId').val();
    
        // Update the displayed value when the dropdown changes
    //     $('#ProgramTypeId').on('change', function() {
    //        // selectedDisplayedValue = $(this).find('option:selected').text();
    //      //   $('#ProgramTypeText').text(selectedDisplayedValue);       
            
    //         gettitle();
    //  });


                 
          //==============ResidencyId===================================================

          var selectedValue = $('#FeeStructureId').val();
    
    var selectedDisplayedValue = $('#FeeStructureId option:selected').text();
    // Update the displayed value when the dropdown changes
    $('#FeeStructureId').on('change', function() {
       // selectedDisplayedValue = $(this).find('option:selected').text();
      //  $('#ProgFeePackageText').val(selectedDisplayedValue);

        
        gettitle();
    });


                   
          //==============ResidencyId===================================================

    var selectedValue = $('#ProgFeePackageId').val();
    
    var selectedDisplayedValue = $('#ProgFeePackageId option:selected').text();
    // Update the displayed value when the dropdown changes
    $('#ProgFeePackageId').on('change', function() {
        selectedDisplayedValue = $(this).find('option:selected').text();
        $('#ProgFeePackageText').val(selectedDisplayedValue);

        
        gettitle();
    });



                       
          //==============ResidencyId===================================================

        var selectedValue = $('#ResidencyId').val();
    
        var selectedDisplayedValue = $('#ResidencyId option:selected').text();
        // Update the displayed value when the dropdown changes
        $('#ResidencyId').on('change', function() {
           // selectedDisplayedValue = $(this).find('option:selected').text();
           // $('#ResidencyText').val(selectedDisplayedValue);

            
            gettitle();
        });


    //==============TermTypeId===================================================

    var selectedValue = $('#TermTypeId').val();
    
    var selectedDisplayedValue = $('#TermTypeId option:selected').text();
    // Update the displayed value when the dropdown changes
    $('#TermTypeId').on('change', function() {
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



    //==============ProgEdition===================================================

    $('#ProgEdition').keydown(function(event) {
           gettitle();
        });

        $('#ProgEdition').keyup(function(event) {
            gettitle();
     });



     //==============TotalPromoFee===================================================

     $('#TotalPromoFee').keydown(function(event) {
           gettitle();
        });

        $('#TotalPromoFee').keyup(function(event) {
            gettitle();
     });


     
     //==============TotalPublishFee===================================================

     $('#TotalPublishFee').keydown(function(event) {
           gettitle();
        });

        $('#TotalPublishFee').keyup(function(event) {
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

    // var selectedValue = $('#IntakeStart').val();
    
    // var selectedDisplayedValue = $('#IntakeStart option:selected').text();
    // // Update the displayed value when the dropdown changes
    // $('#IntakeStart').on('change', function() {
    //    // selectedDisplayedValue = $(this).find('option:selected').text();
    //    // $('#IntakeStartText').text(selectedDisplayedValue);
    //     gettitle();
    // });
 



    //==============IntakeEnd===================================================

    // var selectedValue = $('#IntakeEnd').val();
    
    // var selectedDisplayedValue = $('#IntakeEnd option:selected').text();
    // // Update the displayed value when the dropdown changes
    // $('#IntakeEnd').on('change', function() {
    //    // selectedDisplayedValue = $(this).find('option:selected').text();
    //    // $('#IntakeStartText').text(selectedDisplayedValue);
    //     gettitle();
    // });
 


    //=========================================================================

        
});


        

JS;
$this->registerJs($script);


?>