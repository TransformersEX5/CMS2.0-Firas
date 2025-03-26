<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div class="col-12"><?php $form = ActiveForm::begin(['Id' => 'group']); ?>

    <div class="row">
        <div class="col-md-6 mt-2">
            <?= $form->field($model, 'DebtGroupId')->dropDownList(Yii::$app->creditcontrol->getDebtGroupList(), [
                'prompt' => '- Action/Follow-Up -',
                'class' => 'form-select mb-2'
            ]) ?>

        </div>

     


    
        <?php ActiveForm::end(); ?>