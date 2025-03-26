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


<div class="tbltraining-param">
    <div class="col-12">
        <div class="row">
            <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'options' => ['enctype' => 'multipart/form-data', 'onsubmit' => 'return false;']
            ]); ?>
            <div class="col-12">
                <?= Html::label('Training Year', ['class' => 'control-label']) ?>
            </div>
            <div class="col-3">
                <?= Html::textInput('textBoxName', null, ['id' => 'textBoxId', 'class' => 'form-control']) ?>
            </div>
            <div class="form-group mt-3 d-flex justify-content-end">

                <?php

                // echo Html::a(' Cancel ', [$backindex], ['class' => 'btn btn-warning col-md-2 col-sm-3 col-xs-3 ']);
                echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
                echo '&nbsp';
                if ($pageUrl != 'view') {
                    echo Html::submitButton(Yii::t('app', 'Confirm'), ['class' => 'btn btn-success generateTraininghours']);
                }

                ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php
$script = <<<JS

$( document ).ready(function() {
    $(document).on('click', '.generateTraininghours', function() {
        var year = document.getElementById('textBoxId').value;

        window.open('traininghours?year='+year);
    });
});

JS;
$this->registerJs($script);
?>