<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Tbltrainingduration;

/** @var yii\web\View $this */
/** @var app\models\Tbltraining $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/training';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>



<div class="tbltraining-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data'],
        'id' => 'trainingduration',
    ]); ?>

    <?= $form->field($model, 'TrainingTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TrainingVenue')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-8 mt-2">
            <?= $form->field($model, 'TrainerName')->textInput() ?>

        </div>

        <div class="col-md-4 mt-2">
            <?= $form->field($model, 'TrainerHpNo')->textInput() ?>
        </div>

        <div class="col-md-4 mt-2">
            <?= $form->field($model, 'TrainingId')->textInput(['id' => 'txtTrainingId']) ?>
        </div>
    </div> <!-- end row -->

    <hr>

    <div class="row">
        <div class="col-md-3 mt-2">

            <b>Training Date</b>
            <?= Html::input('text', '','' , $options = ['class' => 'form-control', 'type' => 'date', 'id' => 'txttrainingdate']) ?>

        </div>

        <div class="col-md-3 mt-2">
            <b>Time Start</b>
            <?= Html::input('text', '', '09:00:00', $options = ['class' => 'form-control', 'type' => 'text', 'id' => 'txttimestart']) ?>
        </div>

        <div class="col-md-3 mt-2">
            <b>Time End</b>
            <?= Html::input('text', '', '17:00:00', $options = ['class' => 'form-control', 'type' => 'text', 'id' => 'txttimeend']) ?>
        </div>

        <div class="col-md-2 mt-2">
            <b>.</b>
            <button type="button" class="btn btn-primary w-100" id="btn_apply"> <i class="ri-equalizer-fill mt-1 align-bottom"></i>Apply</button>

        </div>

    </div> <!-- end row -->





    <!-- to show training duration -->
    <div id="listdaytime"></div>



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
        }

        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$TrainingId = $_GET['TrainingId'];
$result = Url::toRoute(['/training/trainingtimetablelist']);
$duration_create = Url::toRoute(['/trainingduration/create']);
$duration_delete = Url::toRoute(['/trainingduration/delete']);

$script = <<<JS


$( document ).ready(function() {

    /* refresh table*/
    GetTrainingDuration();


    /* delete and refresh table */

    // $(document).on('click', '.DurationDelete', function () {

        $(document).off('click', '.DurationDelete').on('click', '.DurationDelete', function () {

        var TrainingDurationId = $(this).attr('value'); 
        $.ajax({           
           type: 'POST',
           url: '$duration_delete',
           // dataType: 'json',
           data: {
            TrainingDurationId: TrainingDurationId,                                               
                   },
           success: function(data) {

            GetTrainingDuration();
                   
               
           }
       }); 

    

    });



    /* Get table value */
    function GetTrainingDuration(){

        $.ajax({           
           type: 'GET',
           url: '$result',
           // dataType: 'json',
           data: {
            TrainingId:$("#txtTrainingId").val(),                                      
                   },
           success: function(data) {

               $('#listdaytime').html(data);
                   
               
           }
       });
        
    }
 

/* Insert new training duration  */

        $('#btn_apply').click( function () {


        if($('#txttrainingdate').val() == ''){
            alert('Please keyin Training Date');
            return false;
        }

        if($('#txttimestart').val() == ''){
            alert('Please keyin Training Start Time');
            return false;
        }


        if($('#txttimeend').val() == ''){
            alert('Please keyin Training End Time');
            return false;
        }



            //var form = $(this);
            var form = $('#trainingduration');
            $.ajax({
                url: '$duration_create', //form.attr('action'),
                type: 'POST',
                //data: form.serialize(),
                data:   {
                        txttrainingdate:$("#txttrainingdate").val(),
                        txttimestart:$("#txttimestart").val(),
                        txttimeend:$("#txttimeend").val(),
                        TrainingId:$("#txtTrainingId").val(),
                        },
                // dataType: 'json',
                success: function (response) {
                // console.log(response.message);

                GetTrainingDuration();
            
                }
            });            
            
            //return false;
        });
});



JS;
$this->registerJs($script);
?>


