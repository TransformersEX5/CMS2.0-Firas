<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tbltrainingprovider $model */
/** @var yii\widgets\ActiveForm $form */


$backindex = '/trainingprovider';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');



?>

<div class="tbltrainingprovider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TrainingCompanyName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TrainingContactName')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'TrainingAddress')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'TrainingAddress')->textarea(['rows' => '3']) ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'TrainingEmailAddress')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'TrainingHpno')->textInput(['maxlength' => true]) ?>

    </div>
</div> <!-- end row -->


    <!-- <?= $form->field($model, 'TrainingProviderCategoryId')->textInput() ?> -->

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'TrainingProviderStatusId')->dropDownList(Yii::$app->training->getTrainingProviderStatus(), [
                'prompt' => '- Provider Status -',
                'class' => 'form-select mb-2'
            ]) ?>

        </div>


    <div class="col-md-4">
        <?= $form->field($model, 'StatusId')->dropDownList(Yii::$app->common->getStatus(), [
            'prompt' => '- Status -',
            'class' => 'form-select mb-2'
        ]) ?>

    </div>
</div> <!-- end row -->


    <?= $form->field($model, 'TrainingTag')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'Remarks')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'Remarks')->textarea(['rows' => '2']) ?>



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