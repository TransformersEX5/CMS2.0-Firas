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
                <?= Html::label('Staff Name', ['class' => 'control-label']) ?>
            </div>
            <div class="col-12">
                <?php
                    $options = [];
                    foreach ($data as $row) {
                        $options[$row['UserId']] = $row['FullName'];
                    }

                    echo Html::dropDownList('dropdownStaff', null, $options, [
                        'class' => 'form-control',
                        'prompt' => 'Please Select',
                        'id' => 'dropdownStaff',
                    ]);
                ?>
            </div>
            <div class="form-group mt-3 d-flex justify-content-end">
                <?php
                    echo Html::button('Close', ['id' => 'closeButton', 'class' => 'btn btn-warning', 'data-bs-dismiss' => 'modal']);
                    echo '&nbsp';
                    if ($pageUrl != 'view') {
                        echo Html::submitButton(Yii::t('app', 'Confirm'), ['class' => 'btn btn-success generateStaffhours']);
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
    $(document).on('click', '.generateStaffhours', function() {
        var UserId = document.getElementById('dropdownStaff').value;

        window.open('staffhours?UserId='+UserId);
    });
});

JS;
$this->registerJs($script);
?>