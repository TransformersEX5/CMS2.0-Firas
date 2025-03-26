<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tblworkingstatus $model */
/** @var yii\widgets\ActiveForm $form */
$backindex = '/working-status';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>

<div class="tblworkingstatus-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>



    <?= $form->field($model, 'WorkingStatusDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WorkingRemarks')->textInput(['maxlength' => true]) ?>



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