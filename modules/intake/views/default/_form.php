<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\intake\models\tblintake $model */
/** @var yii\widgets\ActiveForm $form */

$backindex = '/intake';
$pageUrl = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

?>

<div class="tblintake-form">

<?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>


    <?= $form->field($model, 'IntakeYrMo')->textInput() ?>   

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
