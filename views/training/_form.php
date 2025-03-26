<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'TrainingTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TrainingObjective')->textarea(['rows' => '4']) ?>

    <?= $form->field($model, 'TrainingVenue')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-8 mt-2">
            <?= $form->field($model, 'TrainerName')->textInput() ?>

        </div>

        <div class="col-md-4 mt-2">
            <?= $form->field($model, 'TrainerHpNo')->textInput() ?>
        </div>
    </div> <!-- end row -->



    <div class="row">
        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'TrainingCategoryId')->dropDownList(Yii::$app->training->getTrainingCategory(), [
                'prompt' => '- Training Claim -',
                'class' => 'form-select mb-2'
            ]) ?>

        </div>

        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'TrainingClaimId')->dropDownList(Yii::$app->training->getTrainingClaimHRDF(), [
                'prompt' => '- Training Claim -',
                'class' => 'form-select mb-2'
            ]) ?>
        </div>
    </div> <!-- end row -->





    <div class="row">
        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'TrainingGroupId')->dropDownList(Yii::$app->training->getTrainingGroup(), [
                'prompt' => '- Training Group -',
                'class' => 'form-select mb-2'
            ]) ?>

        </div>

        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'TrainingVenueId')->dropDownList(Yii::$app->training->getTrainingVenue(), [
                'prompt' => '- Training Location -',
                'class' => 'form-select mb-2'
            ]) ?>

        </div>
    </div> <!-- end row -->


    <div class="row">
        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'Remarks')->textarea(['rows' => '3']) ?>
        </div>

        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'TrainingCost')->textInput(['type' => 'number']) ?>
        </div>
    </div>

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


JS;
$this->registerJs($script);
?>